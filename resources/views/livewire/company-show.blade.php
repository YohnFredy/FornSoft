<div class="">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- Header con información básica -->
        <div class="bg-white rounded-2xl border-2 shadow-md shadow-ink mb-10">
            <div class="bg-gradient-to-r from-black/3 via-white to-black/3 overflow-hidden">
                <div class="relative p-4 sm:p-8">
                    <div class="relative">
                        <!-- Layout vertical en móviles, horizontal en pantallas grandes -->
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-6 sm:gap-4">

                            <!-- Información textual -->
                            <div class="flex-1">
                                <h1 class="text-2xl sm:text-4xl font-bold mb-2">
                                    {{ $businessData->business->name }}
                                </h1>

                                @if ($businessData->business->nit)
                                    <p class="text-base sm:text-lg mb-2">
                                        <strong>NIT:</strong> {{ $businessData->business->nit }}
                                    </p>
                                @endif

                                @if ($businessData->description)
                                    <div class=" text-justify [&_*]:!text-justify">
                                        {!! $businessData->description !!}
                                    </div>
                                @endif
                            </div>

                            <!-- Logo y tipo de tienda -->
                            <div class="flex flex-col items-center sm:items-center sm:ml-6 text-center">
                                {{-- Logo de la tienda --}}
                                @if ($businessData->business->latestLogo)
                                    <img src="{{ asset('storage/' . $businessData->business->latestLogo->path) }}"
                                        alt="{{ $businessData->business->name }}" class="h-20 w-15 object-contain mb-4">
                                @endif

                                {{-- Badge con ícono y tipos de tienda centrados --}}
                                @if ($businessData->storeTypes->isNotEmpty())
                                    <div class="flex items-center px-4 py-2 rounded-2xl border border-ink/30 text-left">
                                        {{-- Ícono alineado al centro verticalmente --}}
                                        <i class="fas fa-store text-xl text-primary mr-3"></i>

                                        {{-- Tipos de tienda uno debajo del otro, centrados verticalmente --}}
                                        <div class="flex flex-col justify-center">
                                            @foreach ($businessData->storeTypes as $type)
                                                <span class="capitalize font-medium text-xs text-ink text-center">
                                                    {{ __($type->name) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Galería de imágenes de la empresa -->
        @php
            $images = $businessData->business->images
                ->map(function ($image) use ($businessData) {
                    return [
                        'url' => asset('storage/' . $image->path),
                        'alt' => $businessData->business->name,
                        'is_primary' => false, // puedes cambiar esto si defines una imagen destacada
                    ];
                })
                ->toArray();

            shuffle($images);
            $displayImages = array_slice($images, 0, 3);
        @endphp

        @if (count($displayImages) > 0)
            <div class="bg-white rounded-2xl sm:shadow-lg shadow-ink sm:border overflow-hidden mb-8">
                <div class="sm:p-6">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 min-w-12 bg-gradient-to-br from-primary to-ink rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-images text-white text-lg"></i>
                        </div>
                        <h2 class="text-xl sm:text-2xl font-bold text-secondary"><strong class=" text-primary">Galería
                                de:</strong> {{ $businessData->business->name }}
                        </h2>
                    </div>



                    @if (count($displayImages) == 1)
                        <!-- Una sola imagen - Display grande -->
                        <div class="relative group">
                            <div class="aspect-[16/9] rounded-2xl overflow-hidden bg-gray-100">
                                <img src="{{ $displayImages[0]['url'] }}" alt="{{ $displayImages[0]['alt'] }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute bottom-4 left-4 right-4">
                                    <p class="text-white font-semibold text-lg">{{ $displayImages[0]['alt'] }}</p>
                                </div>
                            </div>
                            @if ($displayImages[0]['is_primary'])
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="inline-flex items-center px-3 py-1 bg-premium text-white text-sm font-medium rounded-full">
                                        <i class="fas fa-star mr-1 text-xs"></i>
                                        Principal
                                    </span>
                                </div>
                            @endif
                        </div>
                    @elseif(count($displayImages) == 2)
                        <!-- Dos imágenes - Grid 2 columnas -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($displayImages as $index => $image)
                                <div class="relative group">
                                    <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-gray-100">
                                        <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    </div>
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="absolute bottom-4 left-4 right-4">
                                            <p class="text-white font-medium">{{ $image['alt'] }}</p>
                                        </div>
                                    </div>
                                    @if ($image['is_primary'])
                                        <div class="absolute top-4 left-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1 bg-premium text-white text-sm font-medium rounded-full">
                                                <i class="fas fa-star mr-1 text-xs"></i>
                                                Principal
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Tres imágenes - Layout especial: 1 grande + 2 pequeñas -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            <!-- Imagen principal (más grande) -->
                            <div class="lg:col-span-2">
                                <div class="relative group">
                                    <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-gray-100">
                                        <img src="{{ $displayImages[0]['url'] }}" alt="{{ $displayImages[0]['alt'] }}"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    </div>
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="absolute bottom-4 left-4 right-4">
                                            <p class="text-white font-semibold text-lg">{{ $displayImages[0]['alt'] }}
                                            </p>
                                        </div>
                                    </div>
                                    @if ($displayImages[0]['is_primary'])
                                        <div class="absolute top-4 left-4">
                                            <span
                                                class="inline-flex items-center px-3 py-1 bg-premium text-white text-sm font-medium rounded-full">
                                                <i class="fas fa-star mr-1 text-xs"></i>
                                                Principal
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Imágenes secundarias -->
                            <div class="space-y-6">
                                @foreach (array_slice($displayImages, 1) as $image)
                                    <div class="relative group">
                                        <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-gray-100">
                                            <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}"
                                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        </div>
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                            <div class="absolute bottom-3 left-3 right-3">
                                                <p class="text-white font-medium text-sm">{{ $image['alt'] }}</p>
                                            </div>
                                        </div>
                                        @if ($image['is_primary'])
                                            <div class="absolute top-3 left-3">
                                                <span
                                                    class="inline-flex items-center px-2 py-1 bg-premium text-white text-xs font-medium rounded-full">
                                                    <i class="fas fa-star mr-1 text-xs"></i>
                                                    Principal
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Catálogo virtual -->
        @if (!empty($businessData->custom_links))

            <div class=" md:hidden mb-6 border-b border-danger"></div>
            <div class="bg-white rounded-2xl sm:shadow-lg shadow-ink sm:border overflow-hidden mb-8">
                <div class="sm:p-6">
                    <!-- Encabezado -->
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 min-w-12 bg-gradient-to-br from-secondary to-ink rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-cart-arrow-down text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl text-secondary ">
                                <strong class=" text-primary">Catálogo:</strong> {{ $businessData->business->name }}
                            </h2>
                            <p class="text-sm text-danger mt-2 hidden sm:block">
                                ⚠️ Si el catálogo es de WhatsApp, es posible que no se vea en computador. En ese caso,
                                haz clic en el botón de WhatsApp en la sección de información para contactar al
                                comercio.
                            </p>
                        </div>
                    </div>

                    <!-- Instrucciones claras -->
                    <div class="mb-4 p-3 bg-premium/10 border-l-4 border-premium rounded-r-lg">
                        <p class="text-sm text-premium">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>
                                @if (count($businessData->custom_links) == 1)
                                    Haz clic en el catálogo de abajo para acceder:
                                @else
                                    Haz clic en cualquiera de los catálogos de abajo para acceder:
                                @endif
                            </strong>
                        </p>
                    </div>

                    <!-- Enlaces a catálogos con mejoras visuales -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach ($businessData->custom_links as $link)
                            <a href="{{ $link['url'] }}" target="_blank" rel="noopener"
                                class="group relative flex items-center p-4 bg-gradient-to-r from-primary/10 to-secondary/10 hover:from-primary/15 hover:to-secondary/15 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border-2 border-primary/20 hover:border-primary/40 cursor-pointer transform hover:-translate-y-1">

                                <!-- Indicador visual de que es clickeable -->
                                <div
                                    class="absolute top-2 right-2 opacity-50 group-hover:opacity-100 transition-opacity">
                                    <i class="fas fa-external-link-alt text-primary text-xs"></i>
                                </div>

                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-primary to-ink text-white flex items-center justify-center rounded-full mr-4 group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                    <i class="fas fa-book-open text-lg"></i>
                                </div>

                                <div class="flex-grow">
                                    <div class="flex items-center mb-1">
                                        <p
                                            class="text-base font-bold text-ink group-hover:text-primary transition-colors">
                                            {{ $link['title'] }}
                                        </p>
                                        <i
                                            class="fas fa-chevron-right ml-2 text-primary opacity-0 group-hover:opacity-100 transition-all duration-300 transform group-hover:translate-x-1"></i>
                                    </div>

                                    <p
                                        class="text-xs text-primary font-medium mt-1 opacity-70 group-hover:opacity-100 transition-opacity duration-300">
                                        Clic para abrir catálogo →
                                    </p>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <!-- Mensaje adicional de ayuda -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-ink/60">
                            <i class="fas fa-mouse-pointer mr-1"></i>
                            @if (count($businessData->custom_links) == 1)
                                El catálogo se abrirá en una nueva pestaña
                            @else
                                Los catálogos se abrirán en una nueva pestaña
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Información de contacto -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                <!-- Contacto -->
                <div class="bg-white rounded-2xl sm:shadow-lg shadow-ink sm:border sm:p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 min-w-12  bg-primary rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-phone text-white text-lg"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-ink">Información de Contacto</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Teléfono -->
                        <div
                            class="flex sm:flex-row flex-col sm:items-center items-start p-4 bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors">
                            <div
                                class="w-10 h-10 min-w-10 bg-secondary rounded-lg flex items-center justify-center sm:mr-4 mb-2 sm:mb-0">
                                <i class="fas fa-phone text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-medium">Teléfono</p>
                                <a href="tel:{{ $businessData->phone }}"
                                    class="text-ink font-semibold hover:text-primary transition-colors">
                                    {{ $businessData->phone }}
                                </a>
                            </div>
                        </div>
                        <!-- WhatsApp -->
                        <div
                            class="flex sm:flex-row flex-col sm:items-center items-start p-4 bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors">

                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $businessData->whatsapp) }}?text={{ urlencode('Hola, estoy interesado en sus productos y vengo referido por Fornuvi S.A.S.') }}"
                                target="_blank" rel="noopener"
                                class="flex sm:flex-row flex-col sm:items-center items-start p-4 w-full bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors group no-underline">

                                <!-- Icono -->
                                <div
                                    class="w-10 h-10 min-w-10 bg-green-600 rounded-lg flex items-center justify-center sm:mr-4 mb-2 sm:mb-0">
                                    <i class="fab fa-whatsapp text-white text-xl"></i>
                                </div>

                                <!-- Contenido -->
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">
                                        Contacta a {{ $businessData->business->name }} directamente por WhatsApp
                                    </p>
                                    <span class="text-ink font-semibold group-hover:text-primary transition-colors">
                                        {{ $businessData->whatsapp }}
                                    </span>

                                    <!-- Mensaje solo visible en PC -->
                                    <p class="text-sm text-danger mt-1 hidden lg:block">
                                        Este boton abrirá WhatsApp Web.
                                    </p>
                                </div>
                            </a>
                        </div>

                        <!-- Email -->
                        @if ($businessData->business_email)
                            <div
                                class="flex sm:flex-row flex-col sm:items-center items-start p-4 bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors">
                                <div
                                    class="w-10 h-10 min-w-10 bg-secondary rounded-lg flex items-center justify-center sm:mr-4 mb-2 sm:mb-0">
                                    <i class="fas fa-envelope text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Email</p>
                                    <a href="mailto:{{ $businessData->business_email }}"
                                        class="text-ink font-semibold hover:text-primary transition-colors break-words">
                                        {{ $businessData->business_email }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- Website -->
                        @if ($businessData->website_url)
                            <div
                                class="flex sm:flex-row flex-col sm:items-center items-start p-4 bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors ">
                                <div
                                    class="w-10 h-10 min-w-10 bg-secondary rounded-lg flex items-center justify-center sm:mr-4 mb-2 sm:mb-0">
                                    <i class="fas fa-globe text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Sitio Web</p>
                                    <a href="{{ $businessData->website_url }}" target="_blank"
                                        class="text-ink font-semibold hover:text-primary transition-colors break-words">
                                        sitio web
                                        <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Ubicación -->
                <div class="bg-white rounded-2xl sm:shadow-lg shadow-ink sm:border sm:p-6">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-10 h-10 min-w-10 sm:w-12 sm:h-12  bg-premium rounded-xl flex items-center justify-center mr-3 sm:mr-4">
                            <i class="fas fa-map-marker-alt text-white text-base sm:text-lg"></i>
                        </div>
                        <h2 class="text-lg sm:text-2xl font-bold text-ink">Ubicación</h2>
                    </div>

                    <div class="space-y-4">

                        <div class="p-4 bg-gradient-to-r from-premium/15 to-premium/8 rounded-xl">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 bg-premium rounded-lg flex items-center justify-center mt-1 flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-white text-sm"></i>
                                </div>


                                <div class="flex items-center">
                                    <div>
                                        @if ($businessData->city || $businessData->department || $businessData->country)
                                            <p class="text-ink">
                                                {{-- Si city_id existe, usamos el nombre de la relación, si no usamos el campo city manual --}}
                                                {{ $businessData->cityRelation ? $businessData->cityRelation->name : $businessData->city }}
                                                {{ $businessData->department ? ', ' . $businessData->department->name : '' }}
                                                {{ $businessData->country ? ' - ' . $businessData->country->name : '' }}
                                            </p>

                                            @if (!empty($businessData->address))
                                                <p class="">
                                                    {{ $businessData->address }}
                                                </p>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if ($businessData->store_type == 'physical' || $businessData->store_type == 'hybrid')

                                <!-- Botones de navegación -->
                                <div class="mt-4 pt-4 border-t border-premium/50">
                                    <p class="text-sm text-gray-600 font-medium mb-3 flex items-center">
                                        <i class="fas fa-route mr-2 text-premium"></i>
                                        ¿Cómo llegar?
                                    </p>

                                    @php
                                        $hasCoordinates =
                                            !empty($businessData->latitude) &&
                                            !empty($businessData->longitude) &&
                                            $businessData->latitude > 0 &&
                                            $businessData->longitude > 0;
                                        if ($hasCoordinates) {
                                            $coordinates = $businessData->latitude . ',' . $businessData->longitude;
                                            $googleMapsUrl = 'https://www.google.com/maps/search/' . $coordinates;
                                            $googleMapsAppUrl = 'https://maps.google.com/?q=' . $coordinates;
                                            $wazeUrl = 'https://waze.com/ul?ll=' . $coordinates;
                                        } else {
                                            $fullAddress = $businessData->address;
                                            $fullAddress .= $businessData->city ? ', ' . $businessData->city : '';
                                            $fullAddress .= $businessData->department
                                                ? ', ' . $businessData->department
                                                : '';
                                            $fullAddress .= $businessData->country ? ', ' . $businessData->country : '';
                                            $googleMapsUrl =
                                                'https://www.google.com/maps/search/' . urlencode($fullAddress);
                                            $googleMapsAppUrl = 'https://maps.google.com/?q=' . urlencode($fullAddress);
                                            $wazeUrl = 'https://waze.com/ul?q=' . urlencode($fullAddress);
                                        }
                                    @endphp

                                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                                        <!-- Google Maps (Web) -->
                                        <a href="{{ $googleMapsUrl }}" target="_blank"
                                            class="flex items-center px-4 py-3 bg-white border-2 border-premium/25 rounded-lg hover:border-secondary hover:bg-blue-50 transition group">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center mr-3 group-hover:bg-secondary transition">
                                                    <i class="fas fa-globe text-white text-sm"></i>
                                                </div>
                                                <div class="text-left">
                                                    <p class="font-semibold text-ink text-sm">Google Maps</p>
                                                    <p class="text-xs text-gray-600">Navegador</p>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- Google Maps App -->
                                        <a href="{{ $googleMapsAppUrl }}"
                                            class="flex items-center px-4 py-3 bg-white border-2 border-premium/25 rounded-lg hover:border-primary hover:bg-blue-50 transition group">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-secondary rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary transition">
                                                    <i class="fas fa-mobile-alt text-white text-sm"></i>
                                                </div>
                                                <div class="text-left">
                                                    <p class="font-semibold text-ink text-sm">Maps App</p>
                                                    <p class="text-xs text-gray-600">Aplicación</p>
                                                </div>
                                            </div>
                                        </a>

                                        <!-- Waze -->
                                        <a href="{{ $wazeUrl }}" target="_blank"
                                            class="flex items-center px-4 py-3 bg-white border-2 border-premium/25 rounded-lg hover:border-primary hover:bg-blue-50 transition group">
                                            <div class="flex items-center">
                                                <div
                                                    class="w-8 h-8 bg-ink rounded-lg flex items-center justify-center mr-3 group-hover:bg-primary transition">
                                                    <i class="fas fa-route text-white text-sm"></i>
                                                </div>
                                                <div class="text-left">
                                                    <p class="font-semibold text-ink text-sm">Waze</p>
                                                    <p class="text-xs text-gray-600">GPS</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- Información método de navegación -->
                                    <div class="mt-3 p-3 bg-white/90 rounded-lg">
                                        <div
                                            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                            <p class="text-xs text-ink flex items-center">
                                                <i class="fas fa-info-circle mr-2 text-primary"></i>
                                                Selecciona tu aplicación de navegación preferida
                                            </p>

                                            <div class="flex items-center">
                                                @if ($hasCoordinates)
                                                    <i class="fas fa-crosshairs text-primary text-xs mr-1"></i>
                                                    <span class="text-xs text-primary font-medium">Ubicación
                                                        precisa</span>
                                                @else
                                                    <i class="fas fa-map-marker text-danger text-xs mr-1"></i>
                                                    <span class="text-xs text-danger font-medium">Por
                                                        dirección</span>
                                                @endif
                                            </div>
                                        </div>

                                        @if ($hasCoordinates)
                                            <p class="text-xs text-gray-500 mt-1">
                                                Coordenadas: {{ number_format($businessData->latitude, 6) }},
                                                {{ number_format($businessData->longitude, 6) }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>


            <!-- Sidebar con redes sociales y enlaces -->
            <div class="space-y-8 ">
                <!-- Redes Sociales -->
                @php
                    $socialNetworks = collect([
                        'facebook_url' => [
                            'icon' => 'fab fa-facebook-f',
                            'name' => 'Facebook',
                            // Azul oficial: #1877F2
                            'color' => 'bg-[#1877F2] hover:bg-[#166FE5]',
                        ],
                        'instagram_url' => [
                            'icon' => 'fab fa-instagram',
                            'name' => 'Instagram',
                            // Instagram usa un degradado, se usa un color cercano dominante
                            'color' => 'bg-[#E1306C] hover:bg-[#C72E65]',
                        ],
                        'linkedin_url' => [
                            'icon' => 'fab fa-linkedin-in',
                            'name' => 'LinkedIn',
                            // Azul oficial: #0077B5
                            'color' => 'bg-[#0077B5] hover:bg-[#00669C]',
                        ],
                        'youtube_url' => [
                            'icon' => 'fab fa-youtube',
                            'name' => 'YouTube',
                            // Rojo oficial: #FF0000
                            'color' => 'bg-[#FF0000] hover:bg-[#E60000]',
                        ],
                        'tiktok_url' => [
                            'icon' => 'fab fa-tiktok',
                            'name' => 'TikTok',
                            // Negro con cian y fucsia, se usa negro base
                            'color' => 'bg-[#010101] hover:bg-[#121212]',
                        ],
                        'x_url' => [
                            'icon' => 'fab fa-x-twitter',
                            'name' => 'X (Twitter)',
                            // Color oficial actual: negro puro
                            'color' => 'bg-black hover:bg-neutral-900',
                        ],
                    ])->filter(function ($data, $field) use ($businessData) {
                        return !empty($businessData->$field);
                    });
                @endphp

                @if ($socialNetworks->count() > 0)
                    <div class="bg-white rounded-2xl shadow-lg shadow-ink border p-6">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-secondary to-ink rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-share-alt text-white text-lg"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-ink">Redes Sociales</h2>
                        </div>

                        <div class="space-y-3">
                            @foreach ($socialNetworks as $field => $social)
                                <a href="{{ $businessData->$field }}" target="_blank"
                                    class="flex items-center p-4 rounded-xl {{ $social['color'] }} text-white transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                    <i class="{{ $social['icon'] }} text-xl mr-4 w-6 text-center"></i>
                                    <span class="font-semibold">{{ $social['name'] }}</span>
                                    <i class="fas fa-external-link-alt ml-auto text-sm opacity-75"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if ($businessData->promo_video_url || $businessData->additional_videos)
        <div class="mt-8 md:mt-16 space-y-4">
            <div class="flex items-center justify-center">
                <div class="w-12 h-12 min-w-12 bg-danger rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-play text-white text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold text-ink">Videos Promocionales</h2>
            </div>

            {{-- Video principal --}}
            @if ($businessData->promo_video_url)
                <div class="flex justify-center px-4 md:px-0">
                    {!! $businessData->promo_video_url !!}
                </div>
            @endif

            {{-- Videos adicionales --}}
            @if ($businessData->additional_videos)
                @foreach ($businessData->additional_videos as $video)
                    <div class="flex justify-center px-4 md:px-0">
                        {!! $video !!}
                    </div>
                @endforeach
            @endif
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow-lg mt-8 max-w-4xl mx-auto">
        <div class="rounded-3xl bg-gradient-to-r from-black/6 via-white to-black/6 p-8 sm:p-10">
            <h2 class="text-xl font-semibold text-ink mb-4">Beneficios de tus compras como afiliado</h2>

            <p class="text-gray-700 leading-relaxed">
                Por cada compra que usted realice como afiliado de Fornuvi a la marca
                <span class="font-semibold">{{ $businessData->business->name }}</span>, Fornuvi recibe una comisión
                que varía entre <span class="font-semibold">{{ $businessData->business->minimum_percentage }}%</span>
                (mínimo) y <span class="font-semibold">{{ $businessData->business->maximum_percentage }}%</span>
                (máximo), dependiendo de las condiciones comerciales.
            </p>

            <p class="text-gray-700 leading-relaxed mt-4">
                Cada comisión de <span class="font-semibold">ingreso bruto de $38.000</span>, equivalente a
                <span class="font-semibold">1.80 puntos</span>. Ingreso bruto corresponde al valor total
                <span class="italic">antes de aplicar cualquier descuento, retención o gasto legal obligatorio</span>.
            </p>
        </div>
    </div>



    <!-- Botón de regreso -->
    <div class="mt-8 flex justify-center">
        <a href="{{ route('companies.index') }}"
            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-primary to-secondary text-white font-semibold rounded-xl hover:from-secondary hover:to-primary transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
            <i class="fas fa-arrow-left mr-3"></i>
            Volver a la lista
        </a>
    </div>


    <script async src="//www.instagram.com/embed.js"></script>
</div>
