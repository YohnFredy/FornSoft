<div>
    <div class="grid grid-cols-1 lg:grid-cols-3 sm:gap-8">
        <div class="lg:col-span-2">
            <div class="sm:bg-white rounded-lg sm:shadow-md shadow-ink sm:border border-neutral-200 sm:p-6 mb-6">

                <h1 class=" text-xl font-bold text-primary mb-2">Datos de Facturación</h1>
                <div class="px-4 py-2 border-l-6 border-primary bg-secondary/4 shadow shadow-ink  rounded-lg mb-5">
                    <div class="flex items-center">
                        <div class=" mr-4 text-xl">
                            ⚠️
                        </div>
                        <p class=" text-sm text-primary">Asegúrate de ingresar los <strong>datos reales de
                                facturación</strong>
                            (nombre, documento, correo). La factura electrónica se genera con esta información.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                    <div>
                        <x-input wire:model.blur="name" label="Nombre completo / Razón social:" type="text"
                            for="name" required autofocus autocomplete="name"
                            placeholder="Nombre a quien se le factura" />
                    </div>
                    <div class="mb-5">

                        <x-select-l wire:model.blur="document_type" label="Tipo de documento" for="document_type">
                            @foreach ($documentTypes as $doc)
                                <div wire:key="{{ $doc->id }}">
                                    <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                                </div>
                            @endforeach
                        </x-select-l>
                    </div>
                    <div>
                        <x-input wire:model.blur="document" label="Número de documento:" type="text" for="document"
                            required placeholder="Número de documento" />
                    </div>

                    <div>
                        <x-input wire:model.blur="email" label="Correo electrónico:" type="email" for="email"
                            required autocomplete="email" placeholder="Correo electrónico:" />
                    </div>
                    <div>
                        <x-input wire:model.blur="phone" label="Teléfono de contacto:" type="tel" for="phone"
                            required placeholder="Ej: +57 300 123 4567" />
                    </div>

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

                    <div>
                        <x-input wire:model.blur="address" label="Dirección:" type="text" for="address" required
                            placeholder="Calle, número, barrio" />
                    </div>
                </div>
            </div>

            <div class="md:hidden border-b border-gray-400  mb-5">
            </div>

            <div class="sm:bg-white rounded-lg sm:shadow-md shadow-ink sm:border border-neutral-200 sm:p-6 mb-6">
                <div x-data="{ expanded: false }">

                    <label class="flex items-center cursor-pointer">
                        <input wire:model.live="shippingDifferent" type="checkbox" x-model="expanded"
                            class=" h-5 w-5 text-blue cursor-pointer">
                        <div class="ml-3 flex-1">
                            <div class="flex items-center justify-between">
                                <p class=" text-xl font-bold text-primary">Datos del destinatario</p>
                                <i class="fas fa-info-circle text-gray-400"></i>
                            </div>
                            <p class="text-ink text-sm ">
                                Seleccione esta opción si la persona que recibirá el pedido es diferente a la que figura
                                en la factura.
                            </p>
                        </div>
                    </label>

                    <div x-show="expanded" x-transition class=" mt-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                            <div>
                                <x-input wire:model.blur="shipping_name" label="Nombre completo:" type="text"
                                    for="shipping_name" required autofocus autocomplete="shipping_name"
                                    placeholder="Nombre de quien recibirá" />
                            </div>
                            <div class=" mb-5">

                                <x-select-l wire:model.blur="shipping_document_type" label="Tipo de documento"
                                    for="shipping_document_type">
                                    @foreach ($documentTypes as $doc)
                                        <div wire:key="{{ $doc->id }}">
                                            <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                                        </div>
                                    @endforeach
                                </x-select-l>
                            </div>
                            <div>
                                <x-input wire:model.blur="shipping_document" label="Número de documento:" type="text"
                                    for="shipping_document" required placeholder="Número de documento" />
                            </div>
                            <div>
                                <x-input wire:model.blur="shipping_phone" label="Teléfono de contacto:" type="tel"
                                    for="shipping_phone" required placeholder="Ej: +57 300 123 4567" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:hidden border-b border-gray-400 mt-5 mb-8">
            </div>

            <div class="sm:bg-white rounded-lg sm:shadow-md shadow-ink sm:border border-neutral-200 sm:p-6 mb-6">
                <h1 class="text-xl font-bold text-premium mb-2">Dirección de entrega</h1>
                <div class="px-4 py-2 border-l-6 border-premium bg-premium/4 shadow shadow-ink  rounded-lg mb-5">
                    <div class="flex items-center">
                        <div class=" mr-4 text-xl">
                            ⚠️
                        </div>
                        <p class="  text-ink">Confirma que los datos sean correctos y que en la dirección haya alguien
                            disponible para recibir tu pedido.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                    <div>
                        <x-select wire:model.live="shipping_selectedCountry" label="País:"
                            for="shipping_selectedCountry" placeholder="Seleccione un país..." :options="$countries"
                            required />
                    </div>

                    @if ($shipping_selectedCountry)
                        <div>
                            <x-select wire:model.live="shipping_selectedDepartment" label="Departamento/Provincia:"
                                for="shipping_selectedDepartment" placeholder="Seleccione un departamento..."
                                :options="$shipping_departments" required />
                        </div>

                        @if ($shipping_selectedDepartment)
                            <div>
                                @if (count($shipping_cities) > 0)
                                    <x-select wire:model.live="shipping_selectedCity" label="Ciudad:"
                                        for="shipping_selectedCity" placeholder="Seleccione una ciudad..."
                                        :options="$shipping_cities" required />
                                @else
                                    <x-input wire:model.blur="shipping_city" id="city" label="Ciudad:"
                                        type="text" for="shipping_city" required autocomplete="shipping_city"
                                        placeholder="Nombre de la ciudad" />
                                @endif
                            </div>
                        @endif
                    @endif
                </div>

                {{-- Dirección --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                    <div>
                        <x-input wire:model.blur="shipping_address" label="Dirección:" type="text"
                            for="shipping_address" required placeholder="Calle, número, barrio" />
                    </div>

                    <div>
                        <x-input wire:model.blur="shipping_additional_address" label="Referencia adicional:"
                            type="text" for="shipping_additional_address"
                            placeholder="Edificio, apartamento, indicaciones, etc." />
                    </div>
                </div>
            </div>
        </div>

        {{-- Resumen de la orden --}}
        <div class="lg:col-span-1">
            <div class="sticky top-6">
                <div class="col-span-6 md:col-span-2">
                    <!-- Header -->
                    <div class="mb-4">
                        <h2 class="text-xl font-semibold text-primary">Resumen de la orden</h2>
                        <div class="h-1 w-16 bg-primary rounded-full mt-1"></div>
                    </div>

                    <!-- Order Summary Card -->
                    <div class="bg-white rounded-xl shadow shadow-ink border border-gray-200 overflow-hidden">
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
