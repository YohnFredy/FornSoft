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
                                    <?php echo e($businessData->business->name); ?>

                                </h1>

                                <!--[if BLOCK]><![endif]--><?php if($businessData->business->nit): ?>
                                    <p class="text-base sm:text-lg mb-2">
                                        NIT: <?php echo e($businessData->business->nit); ?>

                                    </p>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <!--[if BLOCK]><![endif]--><?php if($businessData->description): ?>
                                    <div class=" text-justify [&_*]:!text-justify">
                                        <?php echo $businessData->description; ?>

                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>

                            <!-- Logo y tipo de tienda -->
                            <div class="flex flex-col items-center sm:items-center sm:ml-6 text-center">
                                <!--[if BLOCK]><![endif]--><?php if($businessData->business->latestLogo): ?>
                                    <img src="<?php echo e(asset('storage/' . $businessData->business->latestLogo->path)); ?>"
                                        alt="<?php echo e($businessData->business->name); ?>" class="h-24 object-contain mb-2">
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                                <div class="inline-flex items-center px-4 py-2 rounded-full border border-ink/30">
                                    <i class="fas fa-store mr-2"></i>
                                    <span class="capitalize font-medium"><?php echo e(__($businessData->store_type)); ?></span>
                                </div>
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
                    <h2 class="text-xl sm:text-2xl font-bold text-ink">Galería de <?php echo e($businessData->business->name); ?>

                    </h2>
                </div>

                <?php
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
                ?>

                <!--[if BLOCK]><![endif]--><?php if(count($displayImages) == 1): ?>
                    <!-- Una sola imagen - Display grande -->
                    <div class="relative group">
                        <div class="aspect-[16/9] rounded-2xl overflow-hidden bg-gray-100">
                            <img src="<?php echo e($displayImages[0]['url']); ?>" alt="<?php echo e($displayImages[0]['alt']); ?>"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        </div>
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-4 left-4 right-4">
                                <p class="text-white font-semibold text-lg"><?php echo e($displayImages[0]['alt']); ?></p>
                            </div>
                        </div>
                        <!--[if BLOCK]><![endif]--><?php if($displayImages[0]['is_primary']): ?>
                            <div class="absolute top-4 left-4">
                                <span
                                    class="inline-flex items-center px-3 py-1 bg-premium text-white text-sm font-medium rounded-full">
                                    <i class="fas fa-star mr-1 text-xs"></i>
                                    Principal
                                </span>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                <?php elseif(count($displayImages) == 2): ?>
                    <!-- Dos imágenes - Grid 2 columnas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $displayImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="relative group">
                                <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-gray-100">
                                    <img src="<?php echo e($image['url']); ?>" alt="<?php echo e($image['alt']); ?>"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-4 left-4 right-4">
                                        <p class="text-white font-medium"><?php echo e($image['alt']); ?></p>
                                    </div>
                                </div>
                                <!--[if BLOCK]><![endif]--><?php if($image['is_primary']): ?>
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1 bg-premium text-white text-sm font-medium rounded-full">
                                            <i class="fas fa-star mr-1 text-xs"></i>
                                            Principal
                                        </span>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                <?php else: ?>
                    <!-- Tres imágenes - Layout especial: 1 grande + 2 pequeñas -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Imagen principal (más grande) -->
                        <div class="lg:col-span-2">
                            <div class="relative group">
                                <div class="aspect-[16/10] rounded-2xl overflow-hidden bg-gray-100">
                                    <img src="<?php echo e($displayImages[0]['url']); ?>" alt="<?php echo e($displayImages[0]['alt']); ?>"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-4 left-4 right-4">
                                        <p class="text-white font-semibold text-lg"><?php echo e($displayImages[0]['alt']); ?></p>
                                    </div>
                                </div>
                                <!--[if BLOCK]><![endif]--><?php if($displayImages[0]['is_primary']): ?>
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="inline-flex items-center px-3 py-1 bg-premium text-white text-sm font-medium rounded-full">
                                            <i class="fas fa-star mr-1 text-xs"></i>
                                            Principal
                                        </span>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        </div>

                        <!-- Imágenes secundarias -->
                        <div class="space-y-6">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = array_slice($displayImages, 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="relative group">
                                    <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-gray-100">
                                        <img src="<?php echo e($image['url']); ?>" alt="<?php echo e($image['alt']); ?>"
                                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    </div>
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="absolute bottom-3 left-3 right-3">
                                            <p class="text-white font-medium text-sm"><?php echo e($image['alt']); ?></p>
                                        </div>
                                    </div>
                                    <!--[if BLOCK]><![endif]--><?php if($image['is_primary']): ?>
                                        <div class="absolute top-3 left-3">
                                            <span
                                                class="inline-flex items-center px-2 py-1 bg-premium text-white text-xs font-medium rounded-full">
                                                <i class="fas fa-star mr-1 text-xs"></i>
                                                Principal
                                            </span>
                                        </div>
                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Información de contacto -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Contacto -->
                <div class="bg-white rounded-2xl sm:shadow-lg shadow-ink sm:border sm:p-6">
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
                                <a href="tel:<?php echo e($businessData->phone); ?>"
                                    class="text-ink font-semibold hover:text-primary transition-colors">
                                    <?php echo e($businessData->phone); ?>

                                </a>
                            </div>
                        </div>
                        <!-- Whatsapp -->
                        <div
                            class="flex sm:flex-row flex-col sm:items-center items-start p-4 bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors">



                            <!-- WhatsApp -->
                            <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $businessData->whatsapp)); ?>?text=<?php echo e(urlencode('Hola, estoy interesado en sus productos y vengo referido por Fornuvi S.A.S.')); ?>"
                                target="_blank" rel="noopener"
                                class="flex sm:flex-row flex-col sm:items-center items-start p-4 w-full bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors group no-underline">

                                <div
                                    class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center sm:mr-4 mb-2 sm:mb-0">
                                    <i class="fab fa-whatsapp text-white text-xl"></i>
                                </div>

                                <div>
                                    <p class="text-sm  text-gray-600 font-medium">contacta a
                                        <?php echo e($businessData->business->name); ?> directamente por WhatsApp
                                    </p>
                                    <span class="text-ink font-semibold group-hover:text-primary transition-colors">
                                        <?php echo e($businessData->whatsapp); ?>

                                    </span>
                                </div>
                            </a>
                        </div>

                        <!-- Email -->
                        <!--[if BLOCK]><![endif]--><?php if($businessData->business_email): ?>
                            <div
                                class="flex sm:flex-row flex-col sm:items-center items-start p-4 bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors">
                                <div
                                    class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center sm:mr-4 mb-2 sm:mb-0">
                                    <i class="fas fa-envelope text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Email</p>
                                    <a href="mailto:<?php echo e($businessData->business_email); ?>"
                                        class="text-ink font-semibold hover:text-primary transition-colors break-words">
                                        <?php echo e($businessData->business_email); ?>

                                    </a>
                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

                        <!-- Website -->
                        <!--[if BLOCK]><![endif]--><?php if($businessData->website_url): ?>
                            <div
                                class="flex sm:flex-row flex-col sm:items-center items-start p-4 bg-primary/10 rounded-xl hover:bg-primary/15 transition-colors ">
                                <div
                                    class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center sm:mr-4 mb-2 sm:mb-0">
                                    <i class="fas fa-globe text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600 font-medium">Sitio Web</p>
                                    <a href="<?php echo e($businessData->website_url); ?>" target="_blank"
                                        class="text-ink font-semibold hover:text-primary transition-colors break-words">
                                        sitio web
                                        <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>

                <!-- Ubicación -->
                <div class="bg-white rounded-2xl sm:shadow-lg shadow-ink sm:border sm:p-6">
                    <div class="flex items-center mb-6">
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 bg-premium rounded-xl flex items-center justify-center mr-3 sm:mr-4">
                            <i class="fas fa-map-marker-alt text-white text-base sm:text-lg"></i>
                        </div>
                        <h2 class="text-lg sm:text-2xl font-bold text-ink">Ubicación</h2>
                    </div>

                    <div class="space-y-4">
                        <!--[if BLOCK]><![endif]--><?php if($businessData->address): ?>
                            <div class="p-4 bg-gradient-to-r from-premium/15 to-premium/8 rounded-xl">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 bg-premium rounded-lg flex items-center justify-center mt-1 flex-shrink-0">
                                        <i class="fas fa-map-marker-alt text-white text-sm"></i>
                                    </div>


                                    <div class=" flex items-center">
                                        <div>
                                            <!--[if BLOCK]><![endif]--><?php if($businessData->city || $businessData->department || $businessData->country): ?>
                                                <p class="text-ink">
                                                    
                                                    <?php echo e($businessData->cityRelation ? $businessData->cityRelation->name : $businessData->city); ?>

                                                    <?php echo e($businessData->department ? ', ' . $businessData->department->name : ''); ?>

                                                    <?php echo e($businessData->country ? ' - ' . $businessData->country->name : ''); ?>

                                                </p>

                                                <p class="">
                                                    <?php echo e($businessData->address); ?>

                                                </p>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>

                                    </div>


                                </div>

                                <!--[if BLOCK]><![endif]--><?php if($businessData->store_type == 'physical' || $businessData->store_type == 'hybrid'): ?>



                                    <!-- Botones de navegación -->
                                    <div class="mt-4 pt-4 border-t border-premium/50">
                                        <p class="text-sm text-gray-600 font-medium mb-3 flex items-center">
                                            <i class="fas fa-route mr-2 text-premium"></i>
                                            ¿Cómo llegar?
                                        </p>

                                        <?php
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
                                                $fullAddress .= $businessData->country
                                                    ? ', ' . $businessData->country
                                                    : '';
                                                $googleMapsUrl =
                                                    'https://www.google.com/maps/search/' . urlencode($fullAddress);
                                                $googleMapsAppUrl =
                                                    'https://maps.google.com/?q=' . urlencode($fullAddress);
                                                $wazeUrl = 'https://waze.com/ul?q=' . urlencode($fullAddress);
                                            }
                                        ?>

                                        <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                                            <!-- Google Maps (Web) -->
                                            <a href="<?php echo e($googleMapsUrl); ?>" target="_blank"
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
                                            <a href="<?php echo e($googleMapsAppUrl); ?>"
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
                                            <a href="<?php echo e($wazeUrl); ?>" target="_blank"
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
                                                    <!--[if BLOCK]><![endif]--><?php if($hasCoordinates): ?>
                                                        <i class="fas fa-crosshairs text-primary text-xs mr-1"></i>
                                                        <span class="text-xs text-primary font-medium">Ubicación
                                                            precisa</span>
                                                    <?php else: ?>
                                                        <i class="fas fa-map-marker text-danger text-xs mr-1"></i>
                                                        <span class="text-xs text-danger font-medium">Por
                                                            dirección</span>
                                                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                                </div>
                                            </div>

                                            <!--[if BLOCK]><![endif]--><?php if($hasCoordinates): ?>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    Coordenadas: <?php echo e(number_format($businessData->latitude, 6)); ?>,
                                                    <?php echo e(number_format($businessData->longitude, 6)); ?>

                                                </p>
                                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                                        </div>
                                    </div>
                                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                            </div>
                        <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                    </div>
                </div>
            </div>


            <!-- Sidebar con redes sociales y enlaces -->
            <div class="space-y-8 ">
                <!-- Redes Sociales -->
                <?php
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
                ?>

                <!--[if BLOCK]><![endif]--><?php if($socialNetworks->count() > 0): ?>
                    <div class="bg-white rounded-2xl shadow-lg shadow-ink border p-6">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-12 h-12 bg-gradient-to-br from-secondary to-ink rounded-xl flex items-center justify-center mr-4">
                                <i class="fas fa-share-alt text-white text-lg"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-ink">Redes Sociales</h2>
                        </div>

                        <div class="space-y-3">
                            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $socialNetworks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field => $social): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e($businessData->$field); ?>" target="_blank"
                                    class="flex items-center p-4 rounded-xl <?php echo e($social['color']); ?> text-white transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                    <i class="<?php echo e($social['icon']); ?> text-xl mr-4 w-6 text-center"></i>
                                    <span class="font-semibold"><?php echo e($social['name']); ?></span>
                                    <i class="fas fa-external-link-alt ml-auto text-sm opacity-75"></i>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
            </div>
        </div>
    </div>

    <!--[if BLOCK]><![endif]--><?php if($businessData->promo_video_url || $businessData->additional_videos): ?>
        <div class="mt-8 md:mt-16 space-y-4">
            <div class="flex items-center justify-center">
                <div class="w-12 h-12 bg-danger rounded-xl flex items-center justify-center mr-4">
                    <i class="fas fa-play text-white text-lg"></i>
                </div>
                <h2 class="text-2xl font-bold text-ink">Videos Promocionales</h2>
            </div>

            
            <!--[if BLOCK]><![endif]--><?php if($businessData->promo_video_url): ?>
                <div class="flex justify-center px-4 md:px-0">
                    <?php echo $businessData->promo_video_url; ?>

                </div>
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

            
            <!--[if BLOCK]><![endif]--><?php if($businessData->additional_videos): ?>
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $businessData->additional_videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex justify-center px-4 md:px-0">
                        <?php echo $video; ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <div class="bg-white rounded-3xl shadow-lg mt-8 max-w-4xl mx-auto">
        <div class="rounded-3xl bg-gradient-to-r from-black/3 via-white to-black/3 p-8 sm:p-10">
            <h2 class="text-xl font-semibold text-ink mb-4">Beneficios de tus compras como afiliado</h2>

            <p class="text-gray-700 leading-relaxed">
                Por cada compra que usted realice como afiliado de Fornuvi a la marca
                <span class="font-semibold"><?php echo e($businessData->business->name); ?></span>, Fornuvi recibe una comisión
                que varía entre <span class="font-semibold"><?php echo e($businessData->business->minimum_percentage); ?>%</span>
                (mínimo) y <span class="font-semibold"><?php echo e($businessData->business->maximum_percentage); ?>%</span>
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
        <a href="<?php echo e(route('companies.index')); ?>"
            class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-primary to-secondary text-white font-semibold rounded-xl hover:from-secondary hover:to-primary transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
            <i class="fas fa-arrow-left mr-3"></i>
            Volver a la lista
        </a>
    </div>


    <script async src="//www.instagram.com/embed.js"></script>
</div>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/livewire/company-show.blade.php ENDPATH**/ ?>