<div class="min-h-screen shadow shadow-ink rounded-2xl  py-6 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-primary">Facturas de Empresa</h1>
            <p class="mt-2 text-sm text-ink">Gestiona y revisa las facturas de tus empresas</p>
        </div>

        <!-- Filters Card -->
        <div class="bg-white rounded-lg shadow shadow-ink border border-primary/50 p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Search Input -->
                <div class="md:col-span-1">
                    <label for="search" class="block text-sm font-medium text-primary mb-2">
                        Buscar
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" id="search" wire:model.live.debounce.300ms="search"
                            placeholder="Empresa, NIT o # Factura..."
                            class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-primary mb-2">
                        Estado
                    </label>
                    <select id="status" wire:model.live="status"
                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <option value="">Todos los estados</option>
                        <option value="pending_review">Pendiente de revisión</option>
                        <option value="approved">Aprobado</option>
                        <option value="rejected">Rechazado</option>
                    </select>
                </div>

                <!-- Date Filter -->
                <div>
                    <label for="date" class="block text-sm font-medium text-primary mb-2">
                        Fecha
                    </label>
                    <input type="date" id="date" wire:model.live="date"
                        class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" />
                </div>
            </div>

            <!-- Clear Filters -->
            @if ($search || $status || $date)
                <div class="mt-4 flex justify-end">

                    <flux:button wire:click="clearFilters" icon="x-mark" variant="primary">Limpiar filtros
                    </flux:button>


                </div>
            @endif
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-lg shadow shadow-ink border border-primary/50 overflow-hidden">
            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-400">
                    <thead class="bg-primary">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Fecha
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Empresa
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Factura
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Total
                            </th>

                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Pts
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                Estado
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($invoices as $invoice)
                            <tr class="hover:bg-primary/10 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-ink">
                                        {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-ink">
                                        {{ $invoice->businessData->business->name ?? 'N/A' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-ink">
                                        {{ $invoice->invoice_number }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-ink">
                                        ${{ number_format($invoice->total_amount, 2) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-ink">
                                        {{ $invoice->pts }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a class="text-xs text-primary underline hover:text-secondary"
                                        href="{{ asset('storage/' . $invoice->image_path) }}">
                                        Ver Soporte</a>
                                </td>


                                <td class="px-6 py-4 whitespace-nowrap ">
                                    @php
                                        $statusConfig = [
                                            'pending_review' => [
                                                'label' => 'Pendiente',
                                                'class' => 'bg-premium/10 text-premium',
                                            ],
                                            'approved' => [
                                                'label' => 'Aprobado',
                                                'class' => 'bg-primary/10 text-primary',
                                            ],
                                            'rejected' => [
                                                'label' => 'Rechazado',
                                                'class' => 'bg-danger/10 text-danger',
                                            ],
                                        ];
                                        $config = $statusConfig[$invoice->status] ?? [
                                            'label' => $invoice->status,
                                            'class' => 'bg-ink/10 text-ink',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $config['class'] }}">
                                        {{ $config['label'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-ink" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-ink">No hay facturas</h3>
                                    <p class="mt-1 text-sm text-primary">No se encontraron facturas con los filtros
                                        aplicados.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Cards -->
            <div class="md:hidden">
                @forelse ($invoices as $invoice)
                    <div class="p-4 border-b border-primary/50 hover:bg-primary/5 transition">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-primary">
                                    {{ $invoice->businessData->business->name ?? 'N/A' }}
                                </h3>
                                <p class="text-xs text-ink mt-1">
                                    NIT: {{ $invoice->businessData->business->nit ?? 'N/A' }}
                                </p>
                            </div>
                            @php
                                $statusConfig = [
                                    'pending_review' => [
                                        'label' => 'Pendiente',
                                        'class' => 'bg-premium/10 text-bg-premium',
                                    ],
                                    'approved' => ['label' => 'Aprobado', 'class' => 'bg-primary/10 text-primary'],
                                    'rejected' => ['label' => 'Rechazado', 'class' => 'bg-danger/10 text-danger'],
                                ];
                                $config = $statusConfig[$invoice->status] ?? [
                                    'label' => $invoice->status,
                                    'class' => 'bg-ink/10 text-ink',
                                ];
                            @endphp
                            <span
                                class="px-2.5 py-1 inline-flex text-xs leading-4 font-semibold rounded-full {{ $config['class'] }}">
                                {{ $config['label'] }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div>
                                <p class="text-xs text-ink">Factura</p>
                                <p class="font-medium text-ink/80">{{ $invoice->invoice_number }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-ink">Fecha</p>
                                <p class="font-medium text-ink/80">
                                    {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d/m/Y') }}
                                </p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-ink">Total</p>
                                <p class="text-lg text-ink/80">
                                    ${{ number_format($invoice->total_amount, 2) }}
                                </p>
                            </div>

                            <div class="col-span-2">
                                <p class="text-xs text-ink">Puntos</p>
                                <p class="text-lg  text-ink/80">
                                    {{ $invoice->pts }}
                                </p>
                            </div>

                            <div class="col-span-2">
                                <a class="text-xs text-primary underline hover:text-secondary"
                                    href="{{ asset('storage/' . $invoice->image_path) }}">
                                    Ver Soporte</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-ink">No hay facturas</h3>
                        <p class="mt-1 text-sm text-gray-500">No se encontraron facturas con los filtros aplicados.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($invoices->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $invoices->links() }}
                </div>
            @endif
        </div>

        <!-- Results Summary -->
        <div class="mt-4 text-sm text-gray-600 text-center">
            Mostrando {{ $invoices->firstItem() ?? 0 }} a {{ $invoices->lastItem() ?? 0 }} de
            {{ $invoices->total() }} facturas
        </div>
    </div>
</div>
