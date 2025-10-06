<div>
    <div class="bg-white rounded-lg shadow-md shadow-ink p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Gestión de Órdenes</h2>

            <!-- Botón global para subir puntos -->
            @if ($approvedOrdersCount > 0)
                <flux:button wire:click="uploadAllPoints" variant="primary">
                    Subir puntos para todas ({{ $approvedOrdersCount }})
                </flux:button>
            @endif
        </div>

        <!-- Filtro por estado -->
        <x-select-l wire:model.live="selectedStatus" label="Filtrar por estado:" for="status-filter">
            <option value="">Todos los estados</option>
            @foreach ($orderStatuses as $value => $label)
                <option value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </x-select-l>


        <!-- Tabla de órdenes -->
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-neutral-500">
                <thead class="text-xs text-ink uppercase bg-neutral-50">
                    <tr>
                        <th scope="col" class="py-3 px-6">Número</th>
                        <th scope="col" class="py-3 px-6">Fecha</th>
                        <th scope="col" class="py-3 px-6">Contacto</th>
                        <th scope="col" class="py-3 px-6">Tipo de Envío</th>
                        <th scope="col" class="py-3 px-6">Total</th>
                        <th scope="col" class="py-3 px-6">Estado</th>
                        <th scope="col" class="py-3 px-6">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <div wire:key="{{ $order->id }}">
                            <tr class="bg-white border-b hover:bg-neutral-50">
                                <td class="py-4 px-6 font-medium text-neutral-900">{{ $order->public_order_number }}
                                </td>
                                <td class="py-4 px-6">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-4 px-6">{{ $order->contact }}
                                    {{-- <span class="text-neutral-500 text-xs">{{ $order->phone }}</span> --}}
                                </td>
                                <td class="py-4 px-6">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->shipping_type === 2 ? 'bg-primary/10 text-primary' : 'bg-ink/10 text-ink' }}">
                                        {{ $order->shipping_type === 2 ? 'Envío a domicilio' : 'Retiro en tienda' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6">
                                    ${{ number_format($order->total, 2) }}<br>
                                    <span class="text-neutral-500 text-xs">Puntos:
                                        {{ number_format($order->total_pts, 2) }}</span>
                                </td>
                                <td class="py-4 px-6">
                                    @php
                                        $statusColors = [
                                            1 => 'bg-premium/10 text-premium', // Pendiente
                                            2 => 'bg-primary/10 text-primary', // Aprobada
                                            3 => 'bg-secondary/10 text-secondary', // Puntos Generados
                                            4 => 'bg-ink/10 text-ink', // Enviada
                                            5 => 'bg-primary/10 text-primary', // Entregada
                                            6 => 'bg-danger/10 text-danger', // Rechazada
                                            7 => 'bg-danger/10 text-danger', // Anulación Aprobada
                                            8 => 'bg-danger/10 text-danger', // Anulación Rechazada
                                        ];
                                    @endphp
                                    <span
                                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-neutral-100 text-neutral-800' }}">
                                        {{ $orderStatuses[$order->status] ?? 'Desconocido' }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 ">

                                    <flux:dropdown>
                                        <flux:button icon="chevron-up-down">Opciones</flux:button>
                                        <flux:menu>
                                            @if ($order->status == 1)
                                                <flux:menu.item icon="banknotes"
                                                    wire:click="cashPayment({{ $order->id }})">Pago efectivo
                                                </flux:menu.item>
                                                <flux:menu.item icon="x-mark" variant="danger"
                                                    wire:click="cancellationApproved({{ $order->id }})">Cancelar
                                                </flux:menu.item>
                                                <flux:menu.item icon="archive-box-x-mark" variant="danger"
                                                    wire:click="rejected({{ $order->id }})"> Rechazada
                                                </flux:menu.item>
                                            @endif

                                            @if ($order->status == 2)
                                                <flux:menu.item icon=""
                                                    wire:click="uploadPoints({{ $order->id }})">Subir puntos
                                                </flux:menu.item>
                                                <flux:menu.item icon="x-mark" variant="danger"
                                                    wire:click="cancellationApproved({{ $order->id }})">Cancelar
                                                </flux:menu.item>
                                                <flux:menu.item icon="archive-box-x-mark" variant="danger"
                                                    wire:click="rejected({{ $order->id }})"> Rechazada
                                                </flux:menu.item>
                                            @endif

                                            @if ($order->status == 3)
                                                <flux:menu.item icon="paper-airplane"
                                                    wire:click="sent({{ $order->id }})">
                                                    Enviado
                                                </flux:menu.item>
                                                <flux:menu.item icon="check"
                                                    wire:click="delivered({{ $order->id }})">Entregado
                                                </flux:menu.item>
                                            @endif

                                            @if ($order->status == 4)
                                                <flux:menu.item icon="check"
                                                    wire:click="delivered({{ $order->id }})">Entregado
                                                </flux:menu.item>
                                            @endif

                                            <flux:navmenu.item href="{{ route('orders.show', $order) }}"
                                                icon="eye">Ver</flux:navmenu.item>

                                            <flux:navmenu.item href="{{ route('admin.invoice.show', $order) }}"
                                                icon="eye">Factura</flux:navmenu.item>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>
                            </tr>
                        </div>
                    @empty
                        <tr>
                            <td colspan="8" class="py-6 px-6 text-center text-neutral-500">
                                No se encontraron órdenes con los filtros seleccionados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
