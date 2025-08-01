<div class="grid grid-cols-6 gap-6">
    <div class=" col-span-6 md:col-span-4 ">
        <h2 class=" text-primary  border-b sm:border-none border-neutral-400 pb-2 sm:pb-0">Carro ({{ $quantity }}
            productos)
        </h2>
        <div class=" sm:bg-white rounded-md sm:shadow-md shadow-ink sm:border border-neutral-300 sm:p-4 mt-2">
            <div class=" grid grid-cols-12 gap-2 mt-2">
                @if ($products)
                    @foreach ($products as $product)
                        <div class="col-span-3 lg:col-span-1 flex items-center justify-center">
                            <img class=" w-16 h-16 rounded-md border border-neutral-300"
                                src="{{ asset('storage/' . $product['path']) }}" alt="{{ $product['name'] }}">
                        </div>
                        <div class="col-span-9 lg:col-span-5 flex items-center">
                            <div class=" text-sm text-primary">
                                <p class=" font-bold">
                                    {{ $product['name'] }}
                                </p>
                                <p class="mt-2 text-justify  line-clamp-3 text-ink">
                                    {!! Str::limit($product['description'], 50) !!}</p>
                            </div>
                        </div>

                        <div class="col-span-4 lg:col-span-2 flex items-center justify-center">
                            <div class="text-sm">
                                <p class=" text-primary">

                                    ${{ format_price_with_tax($product['price'], $product['tax_percent']) }}
                                </p>

                                {{--   <p class=" text-premium mt-2"> Pts_base: {{ $product['pts_base'] }}</p> --}}
                            </div>
                        </div>

                        <div class="col-span-7 lg:col-span-3 flex items-center justify-center">
                            <div>
                                <button wire:click="decrement({{ $product['index'] }})"
                                    class="bg-primary  py-1 px-3 rounded-md hover:bg-secondary  text-neutral-200 hover:text-white ">-</button>
                                <input type="text"
                                    class="text-center p-0 w-10 border-none focus:outline-none focus:ring-0 focus:border-none focus:shadow-none "
                                    wire:model.live="products.{{ $product['index'] }}.quantity"
                                    value="{{ $product['quantity'] }}">
                                <button wire:click="increment({{ $product['index'] }})"
                                    class="bg-primary  py-1 px-3 rounded-md hover:bg-secondary  text-neutral-200 hover:text-white ">+</button>
                            </div>
                        </div>

                        <div wire:click="removeFromCart({{ $product['index'] }})"
                            class="col-span-1 lg:col-span-1 flex items-center justify-center cursor-pointer text-danger hover:text-danger/80">
                            <i class="  text-lg fas fa-trash"></i>
                        </div>

                        <div class="col-span-12">
                            <div class=" my-2 border-b border-neutral-400">
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class=" col-span-12  flex items-center justify-center">

                        <p class=" py-4 text-lg font-bold">No hay productos en el carro</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-span-6 md:col-span-2">
        <!-- Header -->
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-primary">Resumen de la orden</h2>
            <div class="h-1 w-16 bg-primary rounded-full mt-1"></div>
        </div>

        <!-- Order Summary Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
            <!-- Product Count Header -->
            <div class="bg-gray-50 px-2 sm:px-6 py-2 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-600">Productos</span>
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                        {{ $totals['quantity'] }} {{ $totals['quantity'] == 1 ? 'artículo' : 'artículos' }}
                    </span>
                </div>
            </div>

            <!-- Order Details -->
            <div class="px-2 sm:px-6 py-1">
                <ul class="space-y-1">
                    <!-- Subtotal -->
                    <li class="flex justify-between items-center py-1">
                        <span class="text-sm text-gray-600">Subtotal</span>
                        <span class="text-sm font-medium text-gray-900">
                            ${{ formatear_precio($totals['subtotal']) }}
                        </span>
                    </li>

                    <!-- Descuento -->
                    @if ($totals['descuento'] > 0)
                        <li class="flex justify-between items-center py-1">
                            <span class="text-sm text-gray-600">Descuento</span>
                            <span class="text-sm font-medium text-premium">
                                -${{ formatear_precio($totals['descuento']) }}
                            </span>
                        </li>
                    @endif

                    <!-- Total Bruto -->
                    <li class="flex justify-between items-center py-1 border-t border-gray-100 pt-3">
                        <span class="text-sm font-medium text-gray-700">Total Bruto</span>
                        <span class="text-sm font-semibold text-gray-900">
                            ${{ formatear_precio($totals['total_bruto_factura']) }}
                        </span>
                    </li>

                    <!-- Impuestos -->
                    @if ($totals['iva'] > 0)
                        <li class="bg-gray-50 -mx-6 px-6 py-1">
                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">IVA</span>
                                    <span class="text-sm text-gray-700">
                                        ${{ formatear_precio($totals['iva']) }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Otros impuestos</span>
                                    <span class="text-sm text-gray-700">$0</span>
                                </div>
                                <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                                    <span class="text-sm font-medium text-gray-700">Total impuestos</span>
                                    <span class="text-sm font-semibold text-gray-900">
                                        ${{ formatear_precio($totals['iva']) }}
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
                        ${{ formatear_precio($totals['total_factura']) }}
                    </span>
                </div>

                @if (isset($totals['total_pts']) && $totals['total_pts'] > 0)
                    <div class="mt-2 text-center">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-premium/5 text-premium">
                            ⭐ Ganarás {{ formatear_precio($totals['total_pts']) }} puntos
                        </span>
                    </div>
                @endif
            </div>

            <!-- Action Button -->
            <div class="px-2 sm:px-6 py-4">
                @if ($totals['quantity'] < 1)
                    <flux:button variant="primary" disabled class="w-full justify-center py-3 text-base font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Carrito vacío
                    </flux:button>
                @else
                    <a href="{{ route('orders.create') }}" class="block">
                        <flux:button variant="primary"
                            class="w-full justify-center py-3 text-base font-medium hover:shadow-lg transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                            Continuar compra
                        </flux:button>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
