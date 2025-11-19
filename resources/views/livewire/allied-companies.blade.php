<div class="min-h-screen ">
    <div class="mx-auto sm:px-6 lg:px-8 max-w-7xl">
        <!-- Header con diseño mejorado -->
        <div class="text-center mb-6">
            <div
                class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-primary to-secondary rounded-2xl mb-2 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h4a1 1 0 011 1v5m-6 0V9a1 1 0 011-1h4a1 1 0 011 1v11.02">
                    </path>
                </svg>
            </div>
            <h1
                class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-ink via-secondary to-ink bg-clip-text text-transparent mb-2 leading-tight">
                Directorio de Comercios
            </h1>
            <p class="text-lg lg:text-xl text-ink max-w-2xl mx-auto leading-relaxed">
                Descubre comercios y empresas de toda la región. Filtra por categoría, ubicación y encuentra exactamente
                lo que buscas.
            </p>
        </div>

        <!-- Filtros mejorados con diseño de tarjeta moderna -->
        <div
            class="bg-white rounded-lg shadow-md shadow-ink border border-primary/20 p-4 lg:p-6 mb-6 md:mb-8 hover:shadow-lg transition-all duration-300">
            <!-- Header de filtros -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
                <h2 class="text-xl lg:text-2xl font-bold text-primary flex items-center">
                    <div
                        class="w-8 h-8 bg-gradient-to-r from-primary to-premium rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4">
                            </path>
                        </svg>
                    </div>
                    Filtros de Búsqueda
                </h2>

                <flux:button wire:click="clearFilters" icon="arrow-path" variant="primary">Limpiar Filtros</flux:button>
            </div>

            <!-- Campo de búsqueda principal -->
            <div class="mb-6 relative">
                <input type="text" id="search" wire:model.live.debounce.300ms="search"
                    class="block w-full ps-10 pr-15 bg-white border border-primary/50 text-primary text-sm rounded-lg focus:outline-1 focus:outline-primary focus:bg-white  py-2 px-2.5"
                    placeholder="Buscar empresa por nombre.">

                <div class=" absolute left-0.5 top-0 px-3 py-2 text-primary">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <!-- Filtros en grid responsivo -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 md:gap-4">

                <!-- Filtro de Categoría -->
                <x-select wire:model.live="selectedCategory" label="Categoría:" for="selectedCategory"
                    placeholder="Todas las categorías..." :options="$categories" required />

                <!-- Filtro de Tipo de Tienda -->
                <!-- Filtro de Tipo de Tienda -->
                <div class="relative mb-5">
                    <label for="store_type" class="block mb-2 text-sm font-medium text-primary">
                        Tipo de tienda
                    </label>
                    <select wire:model.live="selectedStoreType" id="store_type"
                        class="block w-full bg-neutral-50/50 appearance-none border border-gray-300 text-primary text-sm rounded-lg focus:outline-1 focus:outline-primary focus:bg-white p-2.5 cursor-pointer">
                        <option value="">Todos los tipos</option>
                        @foreach ($storeTypes as $storeType)
                            <option value="{{ $storeType->id }}">{{ __($storeType->name) }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-5 top-8 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <!-- País -->
                <x-select wire:model.live="selectedCountry" label="País:" for="selectedCountry"
                    placeholder="Seleccione un país..." :options="$countries" required />

                <!-- Departamento -->
                @if (count($departments) > 0)
                    <x-select wire:model.live="selectedDepartment" label="Departamento:" for="selectedDepartment"
                        placeholder="Todos los deptos..." :options="$departments" />
                @endif


                <!-- Ciudad -->
                @if (count($cities) > 0)
                    <div class="relative mb-5">
                        <label for="Ciudad" class="block mb-2 text-sm font-medium text-primary">
                            Ciudad
                        </label>
                        <select wire:model.live="selectedCity" id="Ciudad"
                            class="block w-full bg-neutral-50/50 appearance-none border border-gray-300 text-primary text-sm rounded-lg 
                    focus:outline-1 focus:outline-primary focus:bg-white p-2.5 cursor-pointer">
                            <option value="">Todas las ciudades</option>
                            {{-- CORREGIDO: Usamos el nombre de la ciudad como valor --}}
                            @foreach ($cities as $city)
                                <option value="{{ $city->city }}">{{ $city->city }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-5 top-8 flex items-center pointer-events-none">
                            {{-- ... ícono svg ... --}}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Resultados con diseño moderno -->
        <div
            class="hidden md:block bg-white backdrop-blur-sm rounded-xl shadow-md shadow-ink border border-primary/20 overflow-hidden">

            <!-- Vista de Escritorio/Tablet -->
            <div class="">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gradient-to-r from-secondary to-primary">
                            <tr class="text-xs font-bold text-white uppercase tracking-wider">
                                <th scope="col" class="px-4 py-3 text-left">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        Nombre
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-2 text-left">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                        </svg>
                                        Ciudad
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 text-left">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                            </path>
                                        </svg>
                                        Teléfono
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 text-left">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Dirección
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 text-left">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h4a1 1 0 011 1v5m-6 0V9a1 1 0 011-1h4a1 1 0 011 1v11.02">
                                            </path>
                                        </svg>
                                        Tipo
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 text-left">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                            </path>
                                        </svg>
                                        Web
                                    </div>
                                </th>
                                <th scope="col" class="px-4 py-3 text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-300">
                            @forelse ($businessData as $data)
                                <tr class="hover:bg-slate-100 transition-colors duration-200 group">
                                    <th scope="row" class="px-4 py-2 text-ink min-w-50">
                                        <div class="grid grid-cols-3 gap-4 w-full items-center">
                                            <!-- Col 1: Imagen -->
                                            <div class="col-span-1">
                                                @if ($data->business->latestLogo)
                                                    <img src="{{ asset('storage/' . $data->business->latestLogo->path) }}"
                                                        alt="{{ $data->business->name }}"
                                                        class="h-10 w-full object-contain mb-2">
                                                @endif
                                            </div>

                                            <!-- Col 2: Texto -->
                                            <div class="col-span-2 text-left">
                                                <div class="font-semibold">
                                                    {{ $data->business->name ?? 'N/A' }}
                                                </div>
                                            </div>
                                        </div>
                                    </th>

                                    <td class="px-4 py-2">{{ $data->city }}</td>
                                    <td class="px-4 py-2">
                                        @if ($data->phone)
                                            <a href="tel:{{ $data->phone }}"
                                                class="text-primary hover:text-secondary font-medium">
                                                {{ $data->phone }}
                                            </a>
                                        @else
                                            <span class="">No disponible</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2 max-w-xs">{{ $data->address }}</td>
                                    <td class="px-4 py-2">
                                        <div class="flex flex-wrap gap-1">
                                            @forelse ($data->storeTypes as $storeType)
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary/5 text-primary whitespace-nowrap">
                                                    {{ __($storeType->name) }}
                                                </span>
                                            @empty
                                                <span class="text-xs text-gray-500">No especificado</span>
                                            @endforelse
                                        </div>
                                    </td>

                                    <td class="px-4 py-2">
                                        @if ($data->website_url)
                                            <a href="{{ $data->website_url }}" target="_blank"
                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-primary bg-primary/10 rounded-lg hover:bg-primary/20 transition-colors">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                    </path>
                                                </svg>
                                                Visitar
                                            </a>
                                        @else
                                            <span class=" text-sm">No disponible</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('companies.show', $data) }}" class="">
                                            <div
                                                class=" bg-danger/2 text-danger border border-danger/4 hover:bg-primary/12 hover:text-primary  hover:border-primary/15 py-1 px-2 rounded-lg">

                                                <div class="text-center">
                                                    <i class="far fa-eye"></i>
                                                </div>
                                                <p class=" text-center text-sm font-bold whitespace-nowrap">
                                                    Más Info
                                                </p>
                                            </div>

                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div
                                                class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-slate-400" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-semibold text-ink mb-2">No se encontraron
                                                comercios</h3>
                                            <p class="text-slate-500">Intenta cambiar los filtros o limpiarlos para ver
                                                más resultados.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Vista Móvil -->
        <div class="md:hidden">
            <div class="space-y-4">
                @forelse ($businessData as $data)
                    <div
                        class="bg-white border border-neutral-400 rounded-2xl shadow-sm hover:shadow-lg shadow-ink transition-all duration-200 overflow-hidden">
                        <!-- Header de la tarjeta -->
                        <div
                            class=" flex justify-between bg-gradient-to-r from-neutral-200 to-neutral-50 p-4 border-b border-slate-200">
                            <div>
                                <h3 class="font-bold text-slate-900 text-lg mb-2">{{ $data->business->name ?? 'N/A' }}
                                </h3>

                                @if ($data->city || $data->city_id)
                                @endif
                                <div class="flex items-center text-sm text-primary">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>

                                    @if (!empty($data->city))
                                        {{ $data->city }}
                                    @else
                                        {{ $data->city_id }}
                                    @endif

                                </div>
                            </div>
                            <div class=" flex items-center">
                                @if ($data->business->latestLogo)
                                    <img src="{{ asset('storage/' . $data->business->latestLogo->path) }}"
                                        alt="{{ $data->business->name }}" class="h-15 w-20 object-contain mb-2">
                                @endif
                            </div>
                        </div>

                        <!-- Contenido de la tarjeta -->
                        <div class="p-4 space-y-3">
                            <!-- Teléfono -->
                            @if ($data->phone)
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-primary mr-3" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    <a href="tel:{{ $data->phone }}"
                                        class="text-secondary hover:text-primary font-medium">
                                        {{ $data->phone }}
                                    </a>
                                </div>
                            @endif

                            <!-- Dirección -->

                            @if (!empty($data->address))
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-primary mr-3 mt-0.5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span
                                        class="text-secondary hover:text-primary font-medium">{{ $data->address }}</span>
                                </div>
                            @endif

                            <!-- Tipo de tienda -->
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-primary mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    {{-- Icono de etiqueta --}}
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                    </path>
                                </svg>
                                {{-- 6. ¡CAMBIO CLAVE! Mostrar los tipos de tienda desde la relación en móvil --}}
                                <div class="flex flex-wrap gap-1">
                                    @forelse ($data->storeTypes as $storeType)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary/10 text-primary">
                                            {{ __($storeType->name) }}
                                        </span>
                                    @empty
                                        <span class="text-xs text-gray-500">No especificado</span>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Acciones -->
                            <div class="flex items-center justify-between pt-3 border-t border-premium/30">
                                @if ($data->website_url)
                                    <a href="{{ $data->website_url }}" target="_blank"
                                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-primary to-secondary rounded-xl hover:from-primary hover:to-secondary transition-all duration-200 shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                            </path>
                                        </svg>
                                        Visitar Web
                                    </a>
                                @else
                                    <div></div>
                                @endif

                                <a href="{{ route('companies.show', $data) }}"
                                    class="text-danger hover:text-primary transition-colors p-2 rounded-lg bg-danger/3 border border-danger/10 hover:border-primary/15 hover:bg-primary/10 font-bold px-6">
                                    <p>Más Inf</p>
                                    <p class=" text-center"><i class=" text-center far fa-eye"></i></p>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 mb-2">No se encontraron comercios</h3>
                        <p class="text-slate-500 px-4">Intenta cambiar los filtros o limpiarlos para ver más
                            resultados.</p>
                    </div>
                @endforelse
            </div>
        </div>



        <!-- Paginación mejorada -->
        @if ($businessData->hasPages())
            <div
                class="shadow-md shadow-ink bg-gradient-to-r from-secondary/20 to-secondary/2 md:from-secondary/3 md:to-primary/3 rounded-xl p-4 mt-2 md:mt-4">
                {{ $businessData->links() }}
            </div>
        @endif

        <!-- Footer estadísticas -->
        <div class="mt-4 md:mt-12 text-center">
            <div
                class="inline-flex items-center px-6 py-3 bg-white backdrop-blur-sm rounded-2xl border border-primary/10 shadow-lg">
                <svg class="w-5 h-5 text-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                <span class="text-slate-700 font-medium">
                    @if ($businessData->total() > 0)
                        {{ $businessData->total() }} comercios encontrados
                    @else
                        Directorio de comercios disponible
                    @endif
                </span>
            </div>
        </div>
    </div>

    <!-- Back to top button -->
    <button id="backToTop"
        class="fixed cursor-pointer bottom-6 right-6 bg-secondary text-white w-12 h-12 rounded-full flex items-center justify-center shadow-md shadow-ink  hover:bg-primary transition duration-300"
        onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Estilos CSS integrados -->
    <style>
        /* Estilos personalizados para mejorar la paginación */
        .pagination-wrapper .pagination {
            @apply flex items-center space-x-1;
        }

        .pagination-wrapper .page-link {
            @apply px-3 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 hover:text-slate-800 transition-colors;
        }

        .pagination-wrapper .page-item.active .page-link {
            @apply bg-blue-600 text-white border-blue-600 hover:bg-blue-700;
        }

        .pagination-wrapper .page-item.disabled .page-link {
            @apply text-slate-400 cursor-not-allowed hover:bg-white hover:text-slate-400;
        }

        /* Animaciones adicionales */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        /* Mejoras en inputs para móvil */
        @media (max-width: 768px) {

            input,
            select {
                font-size: 16px;
                /* Previene zoom en iOS */
            }
        }

        /* Scrollbar personalizado */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>

    <script>
        // Mostrar/ocultar botón de volver arriba
        window.addEventListener('scroll', function() {
            var backToTopButton = document.getElementById('backToTop');
            if (window.pageYOffset > 300) {
                backToTopButton.style.display = 'flex';
            } else {
                backToTopButton.style.display = 'none';
            }
        });

        // Iniciar con el botón oculto
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('backToTop').style.display = 'none';
        });
    </script>
</div>
