<div>
    <!-- Contenedor principal con filtros laterales y productos -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Sidebar con filtros (desktop) -->
        <div class="hidden lg:block lg:w-1/3 xl:w-1/4 2xl:w-1/5">
            <div
                class="bg-white rounded-lg shadow-md shadow-ink border border-neutral-300 px-4 py-2 divide-y divide-neutral-400 sticky top-4">
                <!-- Navegación de categorías -->
                <div class="py-4">
                    @livewire('product.category-listing')
                </div>
                <!-- Filtro de marcas -->
                <div class="py-4">
                    <flux:radio.group wire:model.live="selectedBrand" label="Marcas">
                        @foreach ($brands as $brand)
                            <flux:radio value="{{ $brand->id }}" label="{{ $brand->name }}" />
                        @endforeach
                    </flux:radio.group>
                </div>

                <!-- Filtro de precio -->
                <div class="py-4">
                    <flux:label>Precio</flux:label>
                    <div class="grid grid-cols-2 gap-2 mt-2">
                        <flux:input wire:model.live.debounce.500ms="priceMin" type="number" size="sm"
                            label="Mínimo" min="0" />
                        <flux:input wire:model.live.debounce.500ms="priceMax" type="number" size="sm"
                            label="Máximo" min="0" />
                    </div>
                </div>

                <!-- Filtro de disponibilidad -->
                <div class="py-4">
                    <flux:radio.group wire:model.live="inStock" label="Disponibilidad">
                        <flux:radio value="1" label="En stock" />
                        <flux:radio value="0" label="Agotado" />
                        <flux:radio value="all" label="Todos" checked />
                    </flux:radio.group>
                </div>

                <!-- Filtro de tipo de producto-->
                <div class="py-4">
                    <flux:radio.group wire:model.live="isPhysical" label="Tipo de producto">
                        <flux:radio value="1" label="Producto físico" />
                        <flux:radio value="0" label="Producto digital" />
                        <flux:radio value="all" label="Todos" checked />
                    </flux:radio.group>
                </div>
            </div>
        </div>

        <!-- Sección de productos -->
        <div class="flex-1">
            <!-- Cabecera con título y barra de búsqueda -->
            <div class=" bg-white rounded-lg border border-neutral-400 shadow-md  p-4 lg:px-8 mb-6 ">
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-4 md:col-span-2">
                        <!-- Contenedor flexible para controles -->
                        <div class="flex flex-col md:flex-row md:items-center md:gap-4">
                            <!-- Dropdown de categorías (solo móvil) -->
                            <div x-data="{ open: $wire.entangle('showDropdown') }" class="md:hidden relative mb-2">
                                <flux:button x-on:click="open = true" class="w-full">Categorías</flux:button>
                                <div x-show="open" x-on:click.outside="open = false"
                                    class="absolute mt-2 left-0 w-full p-4 z-50 bg-white border border-gray-300 rounded-lg shadow-md shadow-neutral-600">
                                    @livewire('product.category-listing')
                                </div>
                            </div>

                            <!-- Barra de búsqueda (ancho completo en móvil) -->
                            <div class="w-full md:w-80 mb-2 md:mb-0 relative">
                                <input type="text" wire:model.live.debounce.300ms="search"
                                    class="block w-full ps-10 pr-15 bg-white border border-primary/50 text-primary text-sm rounded-lg focus:outline-1 focus:outline-primary focus:bg-white  py-2 px-2.5"
                                    placeholder="Buscar productos...">

                                <div class=" absolute left-0.5 top-0 px-3 py-2 text-primary">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>

                            <!-- Botón de limpiar filtros -->
                            <div class="hidden md:block ml-auto">
                                @if ($filter === true)
                                    <flux:button variant="primary" wire:click="clearFilters" class="w-full md:w-auto">
                                        Limpiar filtros
                                    </flux:button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-span-4 md:col-span-1 hidden md:block ">
                        <!-- Selector de ordenamiento -->
                        <div class="relative">
                            <select wire:model.live="sortBy"
                                class="block w-full  bg-neutral-50/50 appearance-none border border-gray-300 text-primary text-sm rounded-lg focus:outline-1 focus:outline-primary focus:bg-white py-2 px-2.5 cursor-pointer">
                                <option selected>Ordenar por</option>
                                <option value="newest">Más recientes</option>
                                <option value="price_asc">Precio: menor a mayor</option>
                                <option value="price_desc">Precio: mayor a menor</option>
                                <option value="name_asc">Nombre: A-Z</option>
                                <option value="name_desc">Nombre: Z-A</option>
                            </select>
                            <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                    </div>
                    <div class="col-span-4 md:col-span-1 hidden md:block">
                        <!-- Selector de productos por página -->
                        <div class="relative">
                            <select wire:model.live="perPage"
                                class="block w-full bg-neutral-50/50 appearance-none border border-gray-300 text-primary text-sm rounded-lg focus:outline-1 focus:outline-primary focus:bg-white py-2 px-2.5 cursor-pointer">
                                <option selected disabled>Productos por página</option>
                                <option value="12">12 por página</option>
                                <option value="24">24 por página</option>
                                <option value="36">36 por página</option>
                                <option value="48">48 por página</option>
                            </select>
                            <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- Filtros móviles -->
            <div class="grid grid-cols-2 sm:grid-cols-6 gap-2 mt-3 lg:hidden">
                <div class="col-span-1 sm:col-span-2">
                    <flux:modal.trigger name="filters">
                        <flux:button icon-trailing="chevron-down" class="w-full">Filtrar</flux:button>
                    </flux:modal.trigger>
                </div>

                <!-- Selector de ordenamiento -->
                <div class="col-span-1 sm:col-span-2 relative w-full">
                    <select wire:model.live="sortBy"
                        class="block w-full bg-neutral-50/50 appearance-none border border-gray-300 text-primary text-sm rounded-lg focus:outline-1 focus:outline-primary focus:bg-white p-2.5 cursor-pointer">
                        <option selected>Ordenar por</option>
                        <option value="newest">Más recientes</option>
                        <option value="price_asc">Precio: menor a mayor</option>
                        <option value="price_desc">Precio: mayor a menor</option>
                        <option value="name_asc">Nombre: A-Z</option>
                        <option value="name_desc">Nombre: Z-A</option>
                    </select>
                    <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <!-- Limpiar filtros móvil -->
                <div class="col-span-2 sm:col-span-2">
                    @if ($filter === true)
                        <flux:button variant="primary" wire:click="clearFilters" class="w-full">Limpiar filtros
                        </flux:button>
                    @endif
                </div>


                <flux:modal name="filters" variant="flyout" class="w-80">
                    <div class="divide-y divide-neutral-300 {{-- sticky --}} ">
                        <!-- Filtro de marcas -->
                        <div class="pb-4">
                            <flux:radio.group wire:model.live="selectedBrand" label="Marcas">
                                @foreach ($brands as $brand)
                                    <flux:radio value="{{ $brand->id }}" label="{{ $brand->name }}" />
                                @endforeach
                            </flux:radio.group>
                        </div>

                        <!-- Filtro de precio -->
                        <div class="py-4">
                            <flux:label>Precio</flux:label>
                            <div class="grid grid-cols-2 gap-2 mt-2">
                                <flux:input wire:model.live.debounce.500ms="priceMin" type="number" size="sm"
                                    label="Mínimo" min="0" />
                                <flux:input wire:model.live.debounce.500ms="priceMax" type="number" size="sm"
                                    label="Máximo" min="0" />
                            </div>
                        </div>

                        <!-- Filtro de disponibilidad -->
                        <div class="py-4">
                            <flux:radio.group wire:model.live="inStock" label="Disponibilidad">
                                <flux:radio value="1" label="En stock" />
                                <flux:radio value="0" label="Agotado" />
                                <flux:radio value="all" label="Todos" checked />
                            </flux:radio.group>
                        </div>

                        <!-- Filtro de tipo de producto-->
                        <div class="py-4">
                            <flux:radio.group wire:model.live="isPhysical" label="Tipo de producto">
                                <flux:radio value="1" label="Producto físico" />
                                <flux:radio value="0" label="Producto digital" />
                                <flux:radio value="all" label="Todos" checked />
                            </flux:radio.group>
                        </div>

                        <div class=" pt-4 flex space-x-2 justify-end">
                            @if ($filter === true)
                                <flux:button variant="primary" wire:click="clearFilters">Limpiar filtros</flux:button>
                            @endif
                            <flux:button x-on:click="$flux.modal('filters').close()">
                                Cerrar
                            </flux:button>
                        </div>
                    </div>
                </flux:modal>
            </div>
            {{-- <span class="text-primary">Mostrando {{ $products->count() }} de {{ $products->total() }}
                    productos</span> --}}
            <!-- Contenido de productos -->
            <div>
                @if ($products->count() == 0)
                    <div class="bg-white rounded-lg shadow-lg p-8 text-center">
                        <h3 class="text-xl font-bold text-gray-700 mb-2">No se encontraron productos</h3>
                        <p class="text-gray-600 mb-4">Intenta con otros filtros o términos de búsqueda.</p>
                        <flux:button wire:click="clearFilters">Limpiar filtros</flux:button>
                    </div>
                @else
                    <!-- Grid responsivo de productos -->
                    <div
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
                        @foreach ($products as $product)
                            <div wire:key="{{ $product->id }}"
                                class="bg-white rounded-xl shadow-md shadow-ink/50 border border-neutral-200 overflow-hidden group flex flex-col">

                                <!-- Contenedor de imagen -->
                                <div
                                    class="h-48 sm:h-56 bg-white relative overflow-hidden flex items-center justify-center p-2">
                                    <div
                                        class="absolute inset-0 group-hover:bg-neutral-100/10 transition-all duration-300 z-10">
                                    </div>

                                    @if ($product->latestImage)
                                        <img src="{{ asset('storage/' . $product->latestImage->path) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-contain transition duration-500 group-hover:scale-110">
                                    @else
                                        <img src="{{ asset('images/default.png') }}" alt="Default Image"
                                            class="w-full h-full object-contain transition duration-500 group-hover:scale-110">
                                    @endif

                                    <!-- Etiquetas -->
                                    <div class="absolute top-3 right-3 flex flex-col gap-2 z-20">
                                        @if ($product->stock == 0 && !$product->allow_backorder)
                                            <div
                                                class="bg-danger text-white px-3 py-1 rounded-md text-xs font-medium shadow-sm">
                                                Agotado
                                            </div>
                                        @endif
                                    </div>

                                    <div class="absolute top-3 left-3 z-20">
                                        @if (!$product->is_physical)
                                            <div
                                                class="bg-primary text-white px-3 py-1 rounded-md text-xs font-medium shadow-sm">
                                                Digital
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Barra separadora -->
                                <div class="h-px bg-gradient-to-r from-transparent via-neutral-600 to-transparent">
                                </div>

                                <!-- Contenido del producto -->
                                <div class="p-4 bg-secondary/6 flex flex-col flex-grow">
                                    <!-- Marca y precio -->
                                    <div class="mb-2">
                                        @if ($product->brand)
                                            <span
                                                class="text-xs text-primary font-semibold tracking-wide uppercase block">
                                                {{ $product->brand->name }}
                                            </span>
                                        @endif
                                        <h3 class="font-bold text-primary text-base sm:text-lg truncate">
                                            <a href="{{ route('products.show', $product->slug) }}">
                                                {{ Str::limit($product->name, 40) }}
                                            </a>
                                        </h3>
                                    </div>

                                    <!-- Descripción -->
                                    <p class="text-ink text-xs sm:text-sm mb-4 line-clamp-2 leading-relaxed">
                                        {!! Str::limit($product->description, 100) !!}
                                    </p>

                                    <!-- Categoría, precio y botón -->
                                    <div class="mt-auto flex justify-between items-center">
                                        @if ($product->category)
                                            <span
                                                class="text-xs bg-premium/5 text-premium px-2 sm:px-3 py-1 rounded-lg font-medium">
                                                Pts_base: {{ $product->pts_base }}
                                            </span>
                                        @endif

                                        <div class="flex flex-col items-end">
                                            <span class="font-bold text-secondary text-lg">
                                                <span class="font-bold text-secondary text-lg">
                                                    ${{ format_price_with_tax($product->price, $product->tax_percent) }}
                                                </span>
                                            </span>

                                            <a href="{{ route('products.show', $product) }}">
                                                <flux:button type="button" icon="shopping-cart" variant="primary"
                                                    size="sm">
                                                    Detalle
                                                </flux:button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                    <!-- Paginación -->
                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
