<div class="">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header con información básica -->
        <div class="bg-white rounded-2xl overflow-hidden mb-8">
            <div class="relative bg-gradient-to-r from-primary to-secondary p-6 sm:p-8">
                <div class="relative">
                    <!-- Cambiamos a layout vertical en pantallas pequeñas -->
                    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                        <div class="flex-1">
                            <h1 class="text-2xl sm:text-4xl font-bold text-white mb-2">
                                {{ $businessData->business->name }}
                            </h1>

                            @if ($businessData->business->nit)
                                <p class="text-white/90 text-base sm:text-lg mb-2">
                                    NIT: {{ $businessData->business->nit }}
                                </p>
                            @endif

                            @if ($businessData->description)
                                <p class="text-white/90 leading-relaxed max-w-full sm:max-w-3xl text-sm sm:text-base">
                                    {{ $businessData->description }}
                                </p>
                            @endif
                        </div>

                        <div class="sm:ml-6">
                            <div
                                class="inline-flex items-center px-4 py-2 bg-white/20 rounded-full text-white border border-white/30">
                                <i class="fas fa-store mr-2"></i>
                                <span class="capitalize font-medium">{{ __($businessData->store_type) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Galería de imágenes de la empresa -->
        <div class="bg-white rounded-2xl sm:shadow-lg shadow-ink sm:border overflow-hidden mb-8">
            <div class="sm:p-6">
                <div class="flex items-center mb-6">
                    <div
                        class="w-12 h-12 bg-gradient-to-br from-premium to-danger rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-images text-white text-lg"></i>
                    </div>
                    <h2 class=" text-xl sm:text-2xl font-bold text-ink">Galería de la Empresa</h2>
                </div>

                @php
                    // Imágenes de ejemplo - después conectarás con la tabla images
                    $companyImages = [
                        [
                            'url' =>
                                'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&h=600&fit=crop&crop=center',
                            'alt' => '' . $businessData->business->name,
                            'is_primary' => true,
                        ],
                        [
                            'url' =>
                                'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800&h=600&fit=crop&crop=center',
                            'alt' => '' . $businessData->business->name,
                            'is_primary' => false,
                        ],
                        [
                            'url' =>
                                'https://images.unsplash.com/photo-1556761175-b413da4baf72?w=800&h=600&fit=crop&crop=center',
                            'alt' => '' . $businessData->business->name,
                            'is_primary' => false,
                        ],
                    ];

                    // Mezcla las imágenes y toma 3
                    shuffle($companyImages);
                    $displayImages = array_slice($companyImages, 0, 3);
                @endphp

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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Información de contacto -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Contacto -->
                <div class="sm:bg-white rounded-2xl sm:shadow-lg shadow-ink sm:border sm:p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-primary rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-phone text-white text-lg"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-ink">Información de Contacto</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                        <!-- Teléfono -->
                        <div
                            class="flex sm:flex-row flex-col sm:items-center items-start p-4 bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors">
                            <div
                                class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center sm:mr-4 mb-2 sm:mb-0">
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
                        <!-- Whatsapp -->
                        <div
                            class="flex sm:flex-row flex-col sm:items-center items-start p-4 bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors">
                            <div
                                class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center sm:mr-4 mb-2 sm:mb-0">
                                <i class="fab fa-whatsapp text-white text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 font-medium">WhatsApp</p>
                                <a href="tel:{{ $businessData->phone }}"
                                    class="text-ink font-semibold hover:text-primary transition-colors">
                                    {{ $businessData->phone }}
                                </a>
                            </div>
                        </div>

                        <!-- Email -->
                        @if ($businessData->email)
                            <div
                                class="flex sm:flex-row flex-col sm:items-center items-start p-4 bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors">
                                <div
                                    class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center sm:mr-4 mb-2 sm:mb-0">
                                    <i class="fas fa-envelope text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Email</p>
                                    <a href="mailto:{{ $businessData->email }}"
                                        class="text-ink font-semibold hover:text-primary transition-colors break-words">
                                        {{ $businessData->email }}
                                    </a>
                                </div>
                            </div>
                        @endif

                        <!-- Website -->
                        @if ($businessData->website_url)
                            <div
                                class="flex sm:flex-row flex-col sm:items-center items-start p-4 bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors ">
                                <div
                                    class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center sm:mr-4 mb-2 sm:mb-0">
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
                <div class="bg-white rounded-2xl shadow-lg shadow-ink border p-4 sm:p-6">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 bg-premium rounded-xl flex items-center justify-center mr-3 sm:mr-4">
                            <i class="fas fa-map-marker-alt text-white text-base sm:text-lg"></i>
                        </div>
                        <h2 class="text-lg sm:text-2xl font-bold text-ink">Ubicación</h2>
                    </div>

                    <div class="space-y-4">
                        @if ($businessData->address)
                            <div class="p-4 bg-gradient-to-r from-premium/15 to-premium/8 rounded-xl">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 bg-premium rounded-lg flex items-center justify-center mt-1 flex-shrink-0">
                                        <i class="fas fa-map-marker-alt text-white text-sm"></i>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-600 font-medium mb-1">Dirección</p>
                                        <p class="text-ink font-semibold text-sm sm:text-base">
                                            {{ $businessData->address }}</p>
                                        @if ($businessData->city || $businessData->department || $businessData->country)
                                            <p class="text-gray-600 text-sm mt-1">
                                                {{ $businessData->city }}{{ $businessData->department ? ', ' . $businessData->department : '' }}{{ $businessData->country ? ' - ' . $businessData->country : '' }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Botones de navegación -->
                                <div class="mt-4 pt-4 border-t border-premium/50">
                                    <p class="text-sm text-gray-600 font-medium mb-3 flex items-center">
                                        <i class="fas fa-route mr-2 text-premium"></i>
                                        ¿Cómo llegar?
                                    </p>

                                    @php
                                        $hasCoordinates =
                                            !empty($businessData->latitude) && !empty($businessData->longitude);
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
                                                    <span class="text-xs text-danger font-medium">Por dirección</span>
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
                            </div>
                        @endif
                    </div>
                </div>


                <!-- Videos promocionales -->
                @if ($businessData->promo_video_url || $businessData->additional_videos)
                    <div class="sm:bg-white rounded-2xl sm:shadow-lg sm:hadow-ink sm:border sm:p-6">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-danger rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-play text-white text-lg"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-ink">Videos Promocionales</h2>
                        </div>

                        <div class="space-y-4">
                            @if ($businessData->promo_video_url)
                                <div class="aspect-video bg-gray-100 rounded-xl overflow-hidden">
                                    <iframe src="{{ $businessData->promo_video_url }}" class="w-full h-full"
                                        frameborder="0" allowfullscreen></iframe>
                                </div>
                            @endif

                            @if ($businessData->additional_videos)
                                @php
                                    $additionalVideos = json_decode($businessData->additional_videos, true) ?? [];
                                @endphp
                                @if (count($additionalVideos) > 0)
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                                        @foreach ($additionalVideos as $video)
                                            <div class="aspect-video bg-gray-100 rounded-xl overflow-hidden">
                                                <iframe src="{{ $video }}" class="w-full h-full"
                                                    frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            </div>


            <!-- Sidebar con redes sociales y enlaces -->
            <div class="space-y-8">
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

                <!-- Enlaces personalizados -->
                @if ($businessData->custom_links)
                    @php
                        $customLinks = json_decode($businessData->custom_links, true) ?? [];
                    @endphp
                    @if (count($customLinks) > 0)
                        <div class="sm:bg-white rounded-2xl sm:shadow-lg sm:shadow-ink pt-4 sm:p-6">
                            <div class="flex items-center mb-6">
                                <div class="w-12 h-12 bg-secondary rounded-xl flex items-center justify-center mr-4">
                                    <i class="fas fa-link text-white text-lg"></i>
                                </div>
                                <h2 class="text-2xl font-bold text-ink">Enlaces Adicionales</h2>
                            </div>

                            <div class="space-y-3">
                                @foreach ($customLinks as $link)
                                    <a href="{{ $link['url'] ?? '#' }}" target="_blank"
                                        class="flex items-center p-4 bg-gradient-to-r from-secondary/15 to-primary/20 rounded-xl hover:from-primary/15 hover:to-secondary/15 transition-all duration-300 group">
                                        <div
                                            class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center mr-4 group-hover:bg-secondary transition-colors">
                                            <i class="fas fa-external-link-alt text-white text-sm"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p
                                                class="font-semibold text-ink group-hover:text-primary transition-colors">
                                                {{ $link['name'] ?? 'Enlace personalizado' }}
                                            </p>
                                            @if (isset($link['description']))
                                                <p class="text-sm text-gray-600">{{ $link['description'] }}</p>
                                            @endif
                                        </div>
                                        <i
                                            class="fas fa-chevron-right text-gray-700 group-hover:text-primary transition-colors"></i>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endif

                <!-- Información adicional -->
                {{-- <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-gray-600 to-gray-700 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-info text-white text-lg"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-ink">Información</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600 font-medium">Tipo de Tienda</span>
                            <span class="capitalize font-semibold text-ink px-3 py-1 bg-white rounded-full">
                                {{ $businessData->store_type }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600 font-medium">Registrado</span>
                            <span class="font-semibold text-ink">
                                {{ $businessData->created_at->format('d/m/Y') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-600 font-medium">Última actualización</span>
                            <span class="font-semibold text-ink">
                                {{ $businessData->updated_at->format('d/m/Y') }}
                            </span>
                        </div>
                    </div>
                </div> --}}
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
    </div>
</div>
