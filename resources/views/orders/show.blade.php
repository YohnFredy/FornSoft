<x-layouts.app title="Show">
    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div
            class="flex flex-col sm:flex-row items-center bg-white rounded-lg py-4 sm:py-8 px-6 sm:px-12 border border-neutral-200 shadow-md mb-6 space-y-4 sm:space-y-0 sm:space-x-4">
            <!-- Paso 1: Recibido -->
            <div class="flex flex-col items-center relative sm:flex-1">
                <div
                    class="{{ $order->status >= 2 && $order->status < 6 ? 'bg-primary' : 'bg-neutral-300' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <p class="text-sm mt-2">Recibido</p>
            </div>

            <!-- Línea de progreso -->
            <div
                class="w-full sm:w-auto sm:flex-1 h-1 {{ $order->status >= 2 && $order->status < 6 ? 'bg-primary' : 'bg-neutral-300' }}">
            </div>

            <!-- Paso 2: Enviado -->
            <div class="flex flex-col items-center relative sm:flex-1">
                <div
                    class="{{ $order->status >= 4 && $order->status < 6 ? 'bg-primary' : 'bg-neutral-300' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-truck text-white"></i>
                </div>
                <p class="text-sm mt-2">Enviado</p>
            </div>

            <!-- Línea de progreso -->
            <div
                class="w-full sm:w-auto sm:flex-1 h-1 {{ $order->status >= 4 && $order->status < 6 ? 'bg-primary' : 'bg-neutral-300' }}">
            </div>

            <!-- Paso 3: Entregado -->
            <div class="flex flex-col items-center relative sm:flex-1">
                <div
                    class="{{ $order->status >= 5 && $order->status < 6 ? 'bg-primary' : 'bg-neutral-300' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>
                <p class="text-sm mt-2">Entregado</p>
            </div>
        </div>


        <!-- Order Reference -->
        <div class="bg-white rounded-lg p-6 border border-neutral-200 shadow-md mb-6 text-center">
            <p class="text-lg font-semibold text-primary uppercase">Referencia:
                <span>{{ $order->public_order_number }}</span>
            </p>
        </div>

        <!-- Shipping and Contact Details -->
        <div class="bg-white rounded-lg p-6 border border-neutral-200 shadow-md mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Shipping Details -->
                <div>
                    <p class="text-lg font-semibold  uppercase mb-4">Detalles de Envío</p>
                    @if ($order->envio_type == 1)
                        <p class="">Recogida en tienda:</p>
                        <p class="">Calle 15 #42, Cali, Valle del Cauca</p>
                    @else
                        <p class="font-medium">Dirección:</p>
                        <p class="text-neutral-600">{{ $order->address }} - {{ $order->additional_address }}
                        </p>
                        <p class="text-neutral-600">{{ $order->country->name }} -
                            {{ $order->department->name }} -
                            @if (!$order->city_id == null)
                                {{ $order->city->name }}
                            @else
                                {{ $order->addCity }}
                            @endif
                        </p>
                    @endif
                </div>

                <!-- Contact Details -->
                <div>
                    <p class="text-lg font-semibold text-primary uppercase mb-4">Contacto</p>
                    <p class="">Recibe: {{ $order->contact }}</p>
                    <p class="">Teléfono: {{ $order->phone }}</p>
                </div>
            </div>
        </div>


    </div>

    <!-- Order Summary -->
    <div class="sm:bg-white sm:rounded-lg pt-8  sm:p-6 sm:shadow-md sm:border sm:border-neutral-200">
        <h2 class="text-lg font-semibold text-primary uppercase flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect width="20" height="14" x="2" y="5" rx="2" />
                <line x1="2" x2="22" y1="10" y2="10" />
            </svg>
            Resumen de Pedido
        </h2>
        <div class="overflow-x-auto  sm:mx-0 rounded-lg border border-neutral-200">
            <table class="w-full  text-sm text-left rtl:text-right text-neutral-600">
                <thead class="text-xs bg-primary text-white uppercase">

                    <tr>
                        <th scope="col" class="px-4 sm:px-6 py-3">Producto</th>
                        <th scope="col" class="px-2 sm:px-6 py-3 text-center">Cant</th>
                        <th scope="col" class="px-2 sm:px-6 py-3 text-center">Precio unitario.</th>
                        <th scope="col" class="px-2 sm:px-6 py-3 text-center">Pts unitario</th>
                        <th scope="col" class="px-2 sm:px-6 py-3 text-center">Descuento</th>
                        <th scope="col" class="px-2 sm:px-6 py-3 text-center">Iva</th>
                        <th scope="col" class="px-2 sm:px-6 py-3 text-center">%</th>
                        <th scope="col" class="px-2 sm:px-6 py-3 text-center">Precio unitario venta</th>

                    </tr>
                </thead>
                <tbody>


                    @foreach ($order->items as $item)
                        <tr class="border-b border-neutral-200 hover:bg-neutral-50">
                            <th scope="row"
                                class="flex items-center px-4 sm:px-6 py-3 font-medium text-neutral-900 whitespace-nowrap">
                                @if ($item->product->latestImage)
                                    <img src="{{ asset('storage/' . $item->product->latestImage->path) }}"
                                        alt="{{ $item->product->name }}" class="w-10 h-10 rounded-md object-cover">
                                @else
                                    <img src="{{ asset('images/default.png') }}" alt="{{ $item->product->name }}"
                                        class="w-10 h-10 rounded-md object-cover">
                                @endif
                                <div class="ps-3 max-w-[180px] sm:max-w-none">
                                    <div class="text-xs sm:text-sm font-semibold truncate">{{ $item->name }}
                                    </div>
                                </div>
                            </th>
                            <td class="px-2 sm:px-6 py-3 text-center">{{ $item->quantity }}</td>
                            <td class="px-2 sm:px-6 py-3 text-center">${{ formatear_precio($item->unit_price) }}
                            </td>
                            <td class="px-2 sm:px-6 py-3 text-center">{{ formatear_precio($item->pts) }}</td>
                            <td class="px-2 sm:px-6 py-3 text-center">${{ formatear_precio($item->discount) }}
                            </td>
                            <td class="px-2 sm:px-6 py-3 text-center">${{ formatear_precio($item->tax_amount) }}
                            </td>

                            <td class="px-2 sm:px-6 py-3 text-center">{{ formatear_precio($item->tax_percent) }}
                            </td>
                            <td class="px-2 sm:px-6 py-3 text-center">
                                ${{ formatear_precio($item->unit_sales_price) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class=" sm:flex justify-end">
            <div class="mt-4 sm:w-1/2">

                <!-- Order Summary Card -->
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <!-- Order Details -->
                    <div class="px-2 sm:px-6 py-1">
                        <ul class="space-y-1">
                            <!-- Subtotal -->
                            <li class="flex justify-between items-center py-1">
                                <span class="text-sm text-gray-600">Subtotal</span>
                                <span class="text-sm font-medium text-gray-900">
                                    ${{ formatear_precio($order->subtotal) }}
                                </span>
                            </li>

                            <!-- Descuento -->
                            @if ($order->discount > 0)
                                <li class="flex justify-between items-center py-1">
                                    <span class="text-sm text-gray-600">Descuento</span>
                                    <span class="text-sm font-medium text-premium">
                                        -${{ formatear_precio($order->discount) }}
                                    </span>
                                </li>
                            @endif


                            <!-- Total Bruto -->
                            <li class="flex justify-between items-center py-1 border-t border-gray-100 pt-3">
                                <span class="text-sm font-medium text-gray-700">Total Bruto</span>
                                <span class="text-sm font-semibold text-gray-900">
                                    ${{ formatear_precio($order->subtotal - $order->discount) }}
                                </span>
                            </li>

                            <!-- Impuestos -->
                            @if ($order->tax_amount > 0)
                                <li class="bg-gray-50 -mx-6 px-6 py-1">
                                    <div class="space-y-2">
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">IVA</span>
                                            <span class="text-sm text-gray-700">
                                                ${{ formatear_precio($order->tax_amount) }}
                                            </span>
                                        </div>
                                        <div class="flex justify-between items-center">
                                            <span class="text-sm text-gray-600">Otros impuestos</span>
                                            <span class="text-sm text-gray-700">$0</span>
                                        </div>
                                        <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                                            <span class="text-sm font-medium text-gray-700">Total impuestos</span>
                                            <span class="text-sm font-semibold text-gray-900">
                                                ${{ formatear_precio($order->tax_amount) }}
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>

                    <!-- Total Final -->
                    <div class="bg-primary/5 border-t border-primary/20 px-2 sm:px-6 py-2">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-gray-900">Total a pagar</span>
                            <span class="font-bold text-primary">
                                ${{ formatear_precio($order->total) }}
                            </span>
                        </div>

                        @if (isset($order->total_pts) && $order->total_pts > 0)
                            <div class="mt-2 text-center">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-premium/5 text-premium">
                                    ⭐ Total {{ formatear_precio($order->total_pts) }} puntos
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Incluir el archivo JavaScript separado -->
    <script src="{{ asset('js/boldCheckout.js') }}"></script>

</x-layouts.app>
