<x-layouts.app title="Dashboard">
    <div class="max-w-6xl mx-auto py-10 px-6">
        <!-- Título -->
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Detalle de la Factura</h1>
            <p class="text-gray-500 text-sm">Visualiza el soporte de la factura que subiste.</p>
        </div>

        <!-- Contenedor principal -->
        <div
            class="bg-white dark:bg-zinc-900 shadow-xl rounded-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-8 p-6 transition duration-300 ease-in-out border border-gray-200 dark:border-zinc-800">
            
            <!-- Lado Izquierdo: Detalles -->
            <div class="space-y-5">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Información de la Empresa</h2>
                    <p class="text-gray-600 dark:text-gray-400"><span class="font-medium">Empresa:</span> {{ $invoice->company_name }}</p>
                    <p class="text-gray-600 dark:text-gray-400"><span class="font-medium">NIT:</span> {{ $invoice->nit ?? 'No especificado' }}</p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Detalles de Factura</h2>
                    <p class="text-gray-600 dark:text-gray-400"><span class="font-medium">Número:</span> {{ $invoice->invoice_number ?? 'Sin número' }}</p>
                    <p class="text-gray-600 dark:text-gray-400"><span class="font-medium">Fecha:</span> {{ $invoice->invoice_date?->format('d/m/Y') ?? 'No registrada' }}</p>
                    <p class="text-gray-600 dark:text-gray-400"><span class="font-medium">Moneda:</span> {{ $invoice->currency ?? 'COP' }}</p>
                    <p class="text-gray-600 dark:text-gray-400"><span class="font-medium">Total:</span> ${{ number_format($invoice->total_amount, 2, ',', '.') }}</p>
                    <p class="text-gray-600 dark:text-gray-400"><span class="font-medium">Puntos:</span> {{ number_format($invoice->pts, 2) }}</p>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2">Estado de Revisión</h2>

                    @php
                        $statusColors = [
                            'pending_review' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                            'approved' => 'bg-green-100 text-green-800 border-green-300',
                            'rejected' => 'bg-red-100 text-red-800 border-red-300',
                            'ocr_failed' => 'bg-gray-100 text-gray-800 border-gray-300',
                        ];
                    @endphp

                    <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full border {{ $statusColors[$invoice->status] ?? 'bg-gray-100 text-gray-700 border-gray-300' }}">
                        {{ ucfirst(str_replace('_', ' ', $invoice->status)) }}
                    </span>

                    @if ($invoice->review_notes)
                        <div class="mt-3 bg-gray-50 dark:bg-zinc-800 rounded-xl p-3 border border-gray-200 dark:border-zinc-700">
                            <p class="text-gray-600 dark:text-gray-300 text-sm"><span class="font-medium">Notas:</span> {{ $invoice->review_notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Lado Derecho: Imagen de Soporte -->
            <div class="flex flex-col items-center justify-center">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">Soporte de Factura</h2>

                <div class="relative group">
                    <img src="{{ asset('storage/' . $invoice->image_path) }}"
                        alt="Soporte de Factura"
                        class="rounded-2xl shadow-lg max-h-[500px] object-contain border border-gray-200 dark:border-zinc-700 transition-transform duration-300 group-hover:scale-105">
                    <a href="{{ asset('storage/' . $invoice->image_path) }}" target="_blank"
                        class="absolute bottom-3 right-3 bg-white/90 dark:bg-zinc-800/90 text-sm text-gray-800 dark:text-gray-100 px-3 py-1 rounded-lg shadow-md hover:bg-primary hover:text-white transition">
                        Ver en tamaño completo
                    </a>
                </div>
            </div>
        </div>

        <!-- Botón volver -->
        <div class="mt-10 text-center">
            <a href="{{ route('add-invoice') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 dark:bg-gray-100 text-white dark:text-gray-900 rounded-xl hover:bg-gray-700 dark:hover:bg-gray-200 transition-all">
                <x-icon name="arrow-left" class="w-4 h-4" />
                Volver
            </a>
        </div>
    </div>
</x-layouts.app>
