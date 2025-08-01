<?php

namespace App\Services; // Asegúrate que el namespace sea correcto

use Google\Cloud\DocumentAI\V1\Client\DocumentProcessorServiceClient;
use Google\Cloud\DocumentAI\V1\ProcessRequest;
use Google\Cloud\DocumentAI\V1\RawDocument;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DocumentAiService
{
    protected string $projectId;
    protected string $location;
    protected string $processorId;
    protected ?DocumentProcessorServiceClient $client = null; // Permitir que sea null inicialmente

    public function __construct()
    {
        Log::info("DocumentAiService: Constructor initializing...");
        $this->projectId = config('services.google.project_id', env('GOOGLE_CLOUD_PROJECT_ID'));
        $this->location = config('services.google.document_ai_location', env('DOCUMENT_AI_LOCATION'));
        $this->processorId = config('services.google.document_ai_processor_id', env('DOCUMENT_AI_PROCESSOR_ID'));

        // 1. VERIFICAR CONFIGURACIÓN INICIAL
        // dd(
        //     'Project ID:', $this->projectId,
        //     'Location:', $this->location,
        //     'Processor ID:', $this->processorId,
        //     'GOOGLE_APPLICATION_CREDENTIALS:', env('GOOGLE_APPLICATION_CREDENTIALS')
        // );

        if (!$this->projectId || !$this->location || !$this->processorId) {
            Log::error("DocumentAiService: Google Document AI configuration (project_id, location, or processor_id) is incomplete.");
            // En lugar de lanzar una excepción aquí que podría no ser capturada elegantemente,
            // permitiremos que falle al intentar usar el cliente, y processInvoice devolverá null.
            // O podrías lanzar una excepción específica si prefieres.
            return; // Salir del constructor si la configuración es incompleta
        }
        Log::info("DocumentAiService: Configuration loaded.", ['projectId' => $this->projectId, 'location' => $this->location]);


        $clientOptions = [];
        $envCredentialsPath = env('GOOGLE_APPLICATION_CREDENTIALS');

        if ($envCredentialsPath) {
            if (Str::startsWith($envCredentialsPath, '/') || preg_match('/^[a-zA-Z]:\\\\/', $envCredentialsPath)) {
                $credentialsPath = $envCredentialsPath;
            } else {
                $credentialsPath = base_path($envCredentialsPath);
            }
            Log::info("DocumentAiService: Attempting to use credentials file.", ['path' => $credentialsPath]);

            if (file_exists($credentialsPath)) {
                $clientOptions['credentials'] = $credentialsPath;
                Log::info("DocumentAiService: Credentials file found and will be used.", ['path' => $credentialsPath]);
            } else {
                Log::warning("DocumentAiService: Google Cloud credentials file not found at GOOGLE_APPLICATION_CREDENTIALS path: " . $credentialsPath . ". SDK might try Application Default Credentials.");
            }
        } else {
            Log::info("DocumentAiService: GOOGLE_APPLICATION_CREDENTIALS not set. SDK will attempt to use Application Default Credentials (ADC).");
        }

        try {
            // 2. VERIFICAR INICIALIZACIÓN DEL CLIENTE
            Log::info("DocumentAiService: Initializing DocumentProcessorServiceClient...");
            $this->client = new DocumentProcessorServiceClient($clientOptions);
            Log::info("DocumentAiService: DocumentProcessorServiceClient initialized successfully.");
        } catch (\Exception $e) {
            Log::error("DocumentAiService: Failed to initialize DocumentProcessorServiceClient.", [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            // No establecemos $this->client, por lo que permanecerá null.
            // processInvoice() verificará esto.
            // dd('Error inicializando el cliente DocumentProcessorServiceClient:', $e); // DESCOMENTAR PARA DEPURAR ERROR DE CLIENTE
        }
    }

   public function processInvoice(string $filePath, string $mimeType = 'application/pdf'): ?array
   {
       Log::info("DocumentAiService: Attempting to process invoice.", ['filePath' => $filePath, 'mimeType' => $mimeType]);

       // 3. VERIFICAR SI EL CLIENTE SE INICIALIZÓ CORRECTAMENTE
       if (!$this->client) {
           Log::error("DocumentAiService: DocumentProcessorServiceClient is not initialized. Cannot process invoice.");
           // dd("El cliente de Document AI no está inicializado. Revisa el constructor y los logs.");
           return null; // Devolver null si el cliente no está listo
       }

       if (!file_exists($filePath)) {
           Log::error("DocumentAiService: Invoice file not found at path: {$filePath}");
           // dd("Archivo no encontrado en processInvoice:", $filePath);
           return null;
       }
       Log::info("DocumentAiService: File exists at {$filePath}.");

       if (!is_readable($filePath)) {
           Log::error("DocumentAiService: Invoice file is not readable at path: {$filePath}");
           // dd("Archivo no legible en processInvoice:", $filePath);
           return null;
       }
       Log::info("DocumentAiService: File is readable at {$filePath}.");

       try {
           $imageBytes = file_get_contents($filePath);
           if ($imageBytes === false) {
               Log::error("DocumentAiService: Failed to read file content from: {$filePath}");
               // dd("Fallo al leer el contenido del archivo:", $filePath);
               return null;
           }
           Log::info("DocumentAiService: File content read successfully. Size: " . strlen($imageBytes) . " bytes.");

           $name = DocumentProcessorServiceClient::processorName($this->projectId, $this->location, $this->processorId);
           Log::info("DocumentAiService: Processor name to be used: {$name}");
           // dd("Nombre del procesador:", $name); // Para verificar que se construye correctamente

           $rawDocument = (new RawDocument())
               ->setContent($imageBytes)
               ->setMimeType($mimeType);

           $request = (new ProcessRequest())
               ->setName($name)
               ->setRawDocument($rawDocument);
           
           Log::info("DocumentAiService: Sending request to Document AI API...", ['request_name' => $request->getName()]);
           
           // 4. VERIFICAR LA RESPUESTA DE LA API DE GOOGLE DIRECTAMENTE
           $result = $this->client->processDocument($request);
           // dd("Respuesta directa de Google API (result):", $result); // DESCOMENTAR PARA VER RESPUESTA DE GOOGLE
           
           Log::info("DocumentAiService: Received response from Document AI API.");

           $document = $result->getDocument();
           // dd("Objeto Document de Google API:", $document); // DESCOMENTAR PARA VER EL DOCUMENTO PARSEADO POR GOOGLE

           $extractedData = [
               'raw_text' => $document->getText() ?? '', // Asegurar que no sea null
               'entities' => [],
               'full_response_json' => $result->serializeToJsonString() // Esto podría ser muy grande
           ];

           foreach ($document->getEntities() as $entity) {
               // ... (tu lógica de mapeo de entidades que ya tenías) ...
               // Aquí dentro también podrías poner un dd($entity) si quieres ver cada entidad
           }
           Log::info("DocumentAiService: Invoice processing successful. Extracted entity types.", ['types' => array_keys($extractedData['entities'])]);
           return $extractedData; // Si todo va bien, se devuelve el array

       } catch (\Google\ApiCore\ApiException $e) {
           Log::error("DocumentAiService: Google API Exception during invoice processing.", [
               'message' => $e->getMessage(),
               'status' => $e->getStatus(),
               'code' => $e->getCode(),
               'basic_message' => $e->getBasicMessage(),
               // 'metadata' => $e->getMetadata(), // Puede ser muy verboso
               // 'trace' => $e->getTraceAsString() // Muy verboso
           ]);
           // 5. SI HAY UNA EXCEPCIÓN DE LA API DE GOOGLE
           // dd("Google API Exception:", $e->getMessage(), $e->getStatus(), $e->getBasicMessage()); // DESCOMENTAR
           return null; // Devolver null en caso de excepción de API
       } catch (\Exception $e) {
           Log::error("DocumentAiService: Generic Exception during invoice processing.", [
               'message' => $e->getMessage(),
               // 'trace' => $e->getTraceAsString()
           ]);
           // 6. SI HAY UNA EXCEPCIÓN GENERAL
           // dd("Generic Exception:", $e->getMessage()); // DESCOMENTAR
           return null; // Devolver null en caso de excepción general
       }
   }

    // ... (mapExtractedData y __destruct)

    public function mapExtractedData(array $ocrResponse): array
    {
        $entities = $ocrResponse['entities'] ?? [];

        $invoiceData = [
            'invoice_number_ocr' => $entities['invoice_id']['normalized_value'] ?? $entities['invoice_id']['text'] ?? null,
            'total_amount_ocr' => $entities['total_amount']['normalized_value'] ?? null,
            'currency_ocr' => $entities['total_amount_currency'] ?? $entities['currency']['text'] ?? null,
            'invoice_date_ocr' => $entities['invoice_date']['normalized_value'] ?? null,
            'supplier_name_ocr' => $entities['supplier_name']['text'] ?? null,
            'supplier_id_number_ocr' => $entities['supplier_vat_number']['text'] ?? $entities['supplier_tax_id']['text'] ?? null,
            'raw_ocr_response' => $ocrResponse['full_response_json'] ?? json_encode($ocrResponse),
        ];

        if ($invoiceData['total_amount_ocr'] && !is_numeric($invoiceData['total_amount_ocr'])) {
            $invoiceData['total_amount_ocr'] = (float) preg_replace('/[^0-9.]/', '', (string) $invoiceData['total_amount_ocr']);
        }
        if ($invoiceData['invoice_date_ocr']) {
            try {
                $date = new \DateTime($invoiceData['invoice_date_ocr']);
                $invoiceData['invoice_date_ocr'] = $date->format('Y-m-d');
            } catch (\Exception $e) {
                // Si la fecha no es válida, o no está en un formato que DateTime pueda parsear directamente
                // y ya viene como Y-m-d del normalizador, esto no debería fallar.
                // Si falla, es que el normalizador dio algo extraño.
                Log::warning("Could not parse invoice_date_ocr: " . $invoiceData['invoice_date_ocr']);
                $invoiceData['invoice_date_ocr'] = null;
            }
        }

        return $invoiceData;
    }

    // Es buena práctica cerrar el cliente cuando ya no se necesite,
    // especialmente si es un proceso de larga duración o un script de consola.
    // En una aplicación web típica (request/response), el cliente se cerrará
    // cuando el script termine, pero explícitamente es mejor.
    public function __destruct()
    {
        if (isset($this->client)) {
            $this->client->close();
        }
    }
}