<?php

namespace App\Livewire\Admin;

use App\Models\PubAffiliate;
use App\Models\PubControl;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

class PubManager extends Component
{
    use WithPagination;

    // Propiedades para el modal y los datos del formulario
    public $user_id, $total_assigned, $ad_value = 100000, $control_id;
    public $isOpen = 0;

    // Propiedades para la búsqueda de usuarios
    public $searchQuery = '';
    public $searchResults;
    public $selectedUserName = '';

    // Propiedad para controlar qué fila está expandida
    public $expandedRow = null;

    public function mount()
    {
        // Inicializamos searchResults como una colección vacía
        $this->searchResults = collect();
    }

    // Este método se ejecuta automáticamente cada vez que la propiedad $searchQuery cambia
    public function updatedSearchQuery()
    {
        if (strlen($this->searchQuery) >= 2) {
            $searchTerm = '%' . $this->searchQuery . '%';

            $this->searchResults = User::query()
                ->leftJoin('user_data', 'users.id', '=', 'user_data.user_id')
                ->where(function ($query) use ($searchTerm) {
                    $query->where('users.id', 'like', $searchTerm)
                        ->orWhere('users.name', 'like', $searchTerm)
                        ->orWhere('users.last_name', 'like', $searchTerm)
                        ->orWhere('users.username', 'like', $searchTerm)
                        ->orWhere('users.dni', 'like', $searchTerm)
                        ->orWhere('user_data.phone', 'like', $searchTerm);
                })
                // Seleccionamos las columnas necesarias para evitar ambigüedad
                ->select('users.*')
                ->take(5) // Limitamos los resultados para no sobrecargar la vista
                ->get();
        } else {
            $this->searchResults = collect();
        }
    }

    // Método para seleccionar un usuario de los resultados de búsqueda
    public function selectUser($userId, $userName)
    {
        $this->user_id = $userId;
        $this->selectedUserName = $userName;
        $this->searchQuery = ''; // Limpiamos la búsqueda
        $this->searchResults = collect(); // Ocultamos los resultados
    }


    // Método para limpiar la selección de usuario y buscar de nuevo
    public function clearUserSelection()
    {
        $this->user_id = null;
        $this->selectedUserName = '';
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        // Obtiene los controles paginados con la información del usuario
        $controls = PubControl::with('user.userData')->paginate(10);

        // Carga los afiliados solo si una fila está expandida
        $affiliates = collect();
        if ($this->expandedRow) {
            $affiliates = PubAffiliate::with('user.userData')->where('control_id', $this->expandedRow)->get();
        }

        return view('livewire.admin.pub-manager', [
            'controls' => $controls,
            'affiliates' => $affiliates
        ]);
    }

    // Abre el modal para crear un nuevo registro
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    // Abre el modal de formulario
    public function openModal()
    {
        $this->isOpen = true;
    }

    // Cierra el modal de formulario
    public function closeModal()
    {
        $this->isOpen = false;
    }

    // Limpia los campos del formulario
    private function resetInputFields()
    {
        $this->control_id = '';
        $this->ad_value;
        $this->clearUserSelection(); // Usamos el nuevo método para limpiar el usuario
    }

    // Guarda un registro nuevo o actualiza uno existente
    public function store()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id', // Validamos que el user_id exista
            'ad_value' => 'required|numeric',
        ]);

        PubControl::updateOrCreate(['id' => $this->control_id], [
            'user_id' => $this->user_id,
            'ad_value' => $this->ad_value,
        ]);

        session()->flash(
            'message',
            $this->control_id ? 'Control actualizado correctamente.' : 'Control creado correctamente.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    // Carga los datos de un registro en el formulario para editarlo
    public function edit($id)
    {
        $control = PubControl::with('user')->findOrFail($id);
        $this->control_id = $id;
        $this->total_assigned = $control->total_assigned;
        $this->ad_value = $control->ad_value;

        // Pre-cargamos el usuario seleccionado
        $this->selectUser($control->user_id, $control->user->name . ' ' . $control->user->last_name);

        $this->openModal();
    }

    // Elimina un registro
    /*  public function delete($id)
    {
        // Asegúrate de que no haya afiliados antes de eliminar si tienes restricciones
        if (PubAffiliate::where('control_id', $id)->exists()) {
            session()->flash('error', 'No se puede eliminar. Este control tiene afiliados asignados.');
            return;
        }
        PubControl::find($id)->delete();
        session()->flash('message', 'Control eliminado correctamente.');
    } */

    // Muestra u oculta la tabla de afiliados para una fila
    public function toggleRow($id)
    {
        if ($this->expandedRow === $id) {
            $this->expandedRow = null;
        } else {
            $this->expandedRow = $id;
        }
    }


    /**
     * Genera un mensaje formateado y lo abre en WhatsApp.
     */
    public function sendWhatsApp($controlId)
    {
        // 1. Obtenemos los datos necesarios. La consulta ya trae la información de 'userData'
        // para el patrocinador y para cada afiliado, lo cual es perfecto.
        $control = PubControl::with('user.userData', 'affiliates.user.userData')->findOrFail($controlId);

        // 2. Verificamos el número de teléfono del patrocinador.
        $phoneNumber = $control->user->userData->phone ?? null;
        if (!$phoneNumber) {
            session()->flash('error', 'El patrocinador no tiene un número de teléfono asignado.');
            return;
        }

        // 3. Obtenemos la ciudad del patrocinador para el saludo.
        $sponsorCity = $control->user->userData->city ?? 'No especificada';

        // 4. Construimos el mensaje.
        $message = "*Resumen de Afiliados - Sistema*\n\n";
        $message .= "Hola *{$control->user->name} {$control->user->last_name}*,\n";
        $message .= "Aquí tienes el resumen de tus afiliados (desde tu ubicación en *{$sponsorCity}*):\n\n";
        $message .= "-----------------------------------\n\n";

        if ($control->affiliates->isNotEmpty()) {
            $message .= "*Tus Afiliados:*\n";

            // --- INICIO DEL CAMBIO PRINCIPAL ---
            // Iteramos sobre cada afiliado para construir su información.
            foreach ($control->affiliates as $index => $affiliate) {
                $affiliateName = $affiliate->user->name . ' ' . $affiliate->user->last_name;
                $affiliatePhone = $affiliate->user->userData->phone ?? 'N/A';

                // *** ¡AQUÍ ESTÁ EL CAMBIO! ***
                // Obtenemos la ciudad de cada afiliado desde su propia relación 'userData'.
                $affiliateCity = $affiliate->user->userData->city ?? 'No especificada';

                $message .= ($index + 1) . ". *{$affiliateName}*\n";
                $message .= "   - Usuario: `{$affiliate->user->username}`\n";
                $message .= "   - Celular: {$affiliatePhone}\n";
                $message .= "   - Ciudad: {$affiliateCity}\n"; // <-- LÍNEA AÑADIDA
                $message .= "   - Lado: " . ucfirst($affiliate->side) . "\n\n";
            }
            // --- FIN DEL CAMBIO PRINCIPAL ---

        } else {
            $message .= "Actualmente no tienes afiliados registrados.\n";
        }

        $message .= "-----------------------------------\n";
        $message .= "¡Gracias por ser parte de nuestro equipo!";

        // 5. Preparamos y enviamos la URL a JavaScript.
        $encodedMessage = urlencode($message);
        $whatsappUrl = "https://wa.me/{$phoneNumber}?text={$encodedMessage}";

        $this->dispatch('open-whatsapp', url: $whatsappUrl);
    }


    /**
     * Exporta los datos a un archivo CSV sin paquetes externos.
     */
    public function export($controlId)
    {
        $control = PubControl::with('user.userData', 'affiliates.user.userData')->findOrFail($controlId);
        $fileName = 'reporte-usuario-' . $control->user->username . '.csv';

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Usuario', 'Nombre', 'Apellido', 'Email', 'Celular', 'Lado (Afiliado)'];

        $callback = function () use ($control, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            fputcsv($file, [
                $control->user->username,
                $control->user->name,
                $control->user->last_name,
                $control->user->email,
                $control->user->userData->phone ?? 'N/A',
                ''
            ]);

            if ($control->affiliates->isNotEmpty()) {
                fputcsv($file, []); // Línea en blanco
                fputcsv($file, ['AFILIADOS']);
                fputcsv($file, $columns);
            }

            foreach ($control->affiliates as $affiliate) {
                fputcsv($file, [
                    $affiliate->user->username,
                    $affiliate->user->name,
                    $affiliate->user->last_name,
                    $affiliate->user->email,
                    $affiliate->user->userData->phone ?? 'N/A',
                    $affiliate->side,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
