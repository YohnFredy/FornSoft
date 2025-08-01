<div class="">
    <h1 class="text-2xl font-bold text-primary sm:mb-4">Datos compra</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 sm:gap-8">
        {{-- Datos del envío --}}
        <div class="lg:col-span-2">
            <div class="sm:bg-white rounded-lg sm:shadow-md sm:border border-neutral-200 sm:p-6 mb-6">
                <h2 class="text-lg font-semibold text-primary mb-4 hidden sm:block">Datos de entrega</h2>

                {{-- Nombre y Teléfono --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                    <div>
                        <x-input wire:model.blur="name" label="Nombre completo:" type="text" for="name" required
                            autofocus autocomplete="name" placeholder="Nombre de quien recibirá" />
                    </div>

                    <div>
                        <x-input wire:model.blur="phone" label="Teléfono de contacto:" type="tel" for="phone"
                            required placeholder="Ej: +57 300 123 4567" />
                    </div>
                    <div>
                        <x-input wire:model.blur="dni" label="Número de documento:" type="text" for="dni"
                            required placeholder="Número de documento" />
                    </div>
                    <div>
                        <x-input wire:model.blur="email" label="Correo electrónico:" type="email" for="email"
                            required autocomplete="email" placeholder="Correo electrónico:" />
                    </div>
                </div>

                {{-- Ubicación --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                    <div>
                        <x-select wire:model.live="selectedCountry" label="País:" for="selectedCountry"
                            placeholder="Seleccione un país..." :options="$countries" required />
                    </div>

                    @if ($selectedCountry)
                        <div>
                            <x-select wire:model.live="selectedDepartment" label="Departamento/Provincia:"
                                for="selectedDepartment" placeholder="Seleccione un departamento..." :options="$departments"
                                required />
                        </div>

                        @if ($selectedDepartment)
                            <div>
                                @if (count($cities) > 0)
                                    <x-select wire:model.live="selectedCity" label="Ciudad:" for="selectedCity"
                                        placeholder="Seleccione una ciudad..." :options="$cities" required />
                                @else
                                    <x-input wire:model="city" id="city" label="Ciudad:" type="text"
                                        for="city" required autocomplete="city" placeholder="Nombre de la ciudad" />
                                @endif
                            </div>
                        @endif
                    @endif
                </div>

                {{-- Dirección --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                    <div>
                        <x-input wire:model="address" label="Dirección:" type="text" for="address" required
                            placeholder="Calle, número, barrio" />
                    </div>

                    <div>
                        <x-input wire:model="additionalAddress" label="Referencia adicional:" type="text"
                            for="nota" placeholder="Edificio, apartamento, indicaciones, etc." />
                    </div>
                </div>

                {{-- Información Envío --}}
                <div class="bg-secondary/5 border border-secondary/30 rounded-lg p-3 sm:p-5 sm:mt-6">
                    <h3 class="font-semibold text-danger mb-2">Información importante sobre el envío</h3>

                    <ul class="space-y-2 text-sm text-gray-700">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>El costo del envío se pagará contra entrega directamente al repartidor.</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <span>Solo necesitas pagar ahora el valor del producto a través de nuestra pasarela
                                segura.</span>
                        </li>
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary mr-2 flex-shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>Para cualquier consulta, escríbenos a <span
                                    class="font-medium">info@fornuvi.com</span></span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Resumen de la orden --}}
        <div class="lg:col-span-1">
            <div class="sticky top-6">
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
                                            <div
                                                class="flex justify-between items-center pt-2 border-t border-gray-200">
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

                        {{-- Términos y Botón de compra --}}
                        <div class="bg-white rounded-lg shadow-md border border-neutral-200 px-3 py-6 sm:p-6">
                            <div class="flex items-center">
                                <flux:checkbox wire:model="terms" required id="terms" class="mt-1" />
                                <div class="ml-3">
                                    @livewire('purchase-policy-and-conditions')
                                </div>
                            </div>

                            @error('terms')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror

                            <flux:button variant="primary" wire:click="create_order" class="w-full mt-4">
                                Continuar con la compra
                            </flux:button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
