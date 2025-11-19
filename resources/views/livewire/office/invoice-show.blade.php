<div>
    <div class="p-4 sm:p-6 lg:p-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-2xl font-bold leading-6 text-ink">Soportes de Facturas</h1>
                <p class="mt-2 text-sm text-gray-700">Aquí puedes encontrar una lista de todas las facturas que has
                    subido.</p>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    @if ($invoices->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500">Aún no has agregado ninguna factura.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($invoices as $invoice)
                                <div
                                    class="bg-white overflow-hidden shadow-md shadow-ink border rounded-lg transform hover:scale-105 transition-transform duration-300">
                                    <div class="p-5">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm font-medium text-primary">Factura
                                                #{{ $invoice->invoice_number }}</p>
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
    @switch($invoice->status)
        @case('approved')
            bg-primary/5 text-primary
            @break
        @case('rejected')
            bg-danger/10 text-danger
            @break
        @case('ocr_failed')
            bg-yellow-100 text-yellow-800
            @break
        @default {{-- Para 'pending_review' --}}
            bg-gray-100 text-gray-800
    @endswitch
">
                                                @switch($invoice->status)
                                                    @case('approved')
                                                        Aprobado
                                                    @break

                                                    @case('rejected')
                                                        Rechazado
                                                    @break

                                                    @case('ocr_failed')
                                                        Fallo de OCR
                                                    @break

                                                    @default
                                                        Pendiente de Revisión
                                                @endswitch
                                            </span>
                                        </div>
                                        <div class="mt-4">
                                            <p class="text-xl font-bold text-primary">{{ $invoice->business?->name }}
                                            </p>
                                            <p class="text-sm text-gray-500">NIT: {{ $invoice->business->nit ?? 'N/A' }}
                                            </p>
                                        </div>
                                        <div class="mt-6">
                                            <div class="flex justify-between text-sm text-gray-600">
                                                <span>Fecha:</span>
                                                <span>{{ $invoice->invoice_date ? \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') : 'N/A' }}</span>
                                            </div>
                                            <div class="flex justify-between text-sm text-gray-600 mt-2">
                                                <span>Total:</span>
                                                <span class="font-bold">{{ $invoice->currency }}
                                                    {{ number_format($invoice->total_amount, 2) }}</span>
                                            </div>
                                            <div class="flex justify-between text-sm text-gray-600 mt-2">
                                                <span>Puntos (PTS):</span>
                                                <span
                                                    class="font-bold text-primary">{{ number_format($invoice->pts, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($invoice->review_notes)
                                        <div class="border-t border-gray-200 bg-gray-50 px-5 py-3">
                                            <p class="text-xs text-gray-500"><span class="font-bold">Notas de
                                                    revisión:</span> {{ $invoice->review_notes }}</p>
                                        </div>
                                    @endif
                                    <div class="border-t border-gray-200 px-5 py-4">
                                        <a href="{{ asset('storage/' . $invoice->image_path) }}" target="_blank"
                                            class="w-full text-center block bg-primary hover:bg-secondary text-white font-bold py-2 px-4 rounded transition duration-300">
                                            Ver Soporte
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Paginación (si es necesaria en el futuro) -->
                        <div class="mt-8">
                            {{ $invoices->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
