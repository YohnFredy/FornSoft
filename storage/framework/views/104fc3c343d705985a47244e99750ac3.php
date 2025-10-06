<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Dashboard']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Dashboard']); ?>


    <?php if(session('success')): ?>
        <div class="bg-premium/5 border-l-4 border-premium text-premium p-4 mb-6 rounded shadow-md" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-premim" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">
                        <strong>¡Mensaje enviado con éxito!</strong>
                    </p>
                    <p class="text-sm mt-1"><?php echo e(session('success')); ?></p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Hero Section -->
    <section id="inicio" class="p-4 sm:p-10 border border-primary/10 bg-primary/5 rounded-lg">
        <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-6">
            <div class="space-y-4 sm:space-y-6 text-center md:text-left">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-primary leading-tight">
                    Bienvenido a Fornuvi
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-ink font-light">
                    Calidad, Oportunidad y Crecimiento. Una compañía en el sector de salud y bienestar a través de un
                    sistema global de asociación.
                </p>

                <div class="flex flex-col sm:flex-row justify-center md:justify-start gap-4">
                    <a href="#contacto">
                        <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['variant' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary']); ?>
                            Comienza Hoy
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
                    </a>
                </div>
            </div>

            <!-- Imagen ahora visible en móviles pero más pequeña -->
            <div class="flex justify-center md:justify-end">
                <img src="https://us.123rf.com/450wm/zhunsky/zhunsky2304/zhunsky230400043/201771464-globo-en-manos-humanas-concepto-de-conservaci%C3%B3n-ambiental-renderizado-3d.jpg?ver=6"
                    alt="ActivosNetwork Oportunidades" class="w-40 sm:w-56 md:w-full rounded-lg shadow-lg shadow-ink">
            </div>
        </div>
    </section>


    <!-- Nuestra Misión -->
    <section class="py-6 sm:py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col-reverse md:flex-row items-center gap-8">

                <!-- Texto -->
                <div class="md:w-1/2 text-center md:text-left">
                    <h2 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-6 text-primary">Nuestra Misión</h2>
                    <p class="text-base sm:text-lg text-ink leading-relaxed mb-4">
                        En Fornuvi creemos en la excelencia, la innovación y la oportunidad. Nuestra misión es ofrecer
                        productos de la más alta calidad a través de nuestra tienda online, brindando a nuestros
                        clientes
                        una experiencia de compra excepcional con productos naturales, saludables y confiables.
                    </p>
                    <p class="text-base sm:text-lg text-ink leading-relaxed">
                        Nos especializamos en la comercialización de productos propios y de terceros, asegurando que
                        cumplan
                        con los más altos estándares de calidad y competitividad en el mercado.
                    </p>
                    <div class="mt-6 sm:mt-8">
                        <a href="#"
                            class="text-secondary hover:text-primary font-medium inline-flex items-center group">
                            Conoce más sobre nosotros
                            <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Imagen -->
                <div class="md:w-1/2 flex justify-center">
                    <img src="https://d1ih8jugeo2m5m.cloudfront.net/2024/09/oportunidades_de_negocio.jpg"
                        alt="Productos naturales Fornuvi"
                        class="w-full max-w-xs sm:max-w-sm md:max-w-full rounded-lg shadow-xl">
                </div>

            </div>
        </div>
    </section>

    <!-- Tienda en Línea -->
    <section class="py-6 sm:py-16 bg-neutral-50">
        <div class="container mx-auto px-4">

            <!-- Encabezado -->
            <div class="max-w-3xl mx-auto text-center mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-primary mb-4">
                    Una Tienda en Línea para Todos
                </h2>
                <p class="text-base sm:text-lg text-ink leading-relaxed">
                    Nuestra plataforma ofrece una amplia variedad de productos naturales y de otros nichos
                    cuidadosamente seleccionados, con la calidad y confianza que mereces.
                </p>
            </div>

            <!-- Tarjetas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">

                <!-- Tarjeta 1 -->
                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="h-1 bg-primary"></div>
                    <div class="p-6 text-center">
                        <div
                            class="w-16 h-16 bg-premium/10 text-premium rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-leaf text-2xl"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-primary mb-3">Productos Naturales</h3>
                        <p class="text-ink mb-4">
                            Seleccionamos cuidadosamente productos naturales que aportan bienestar y salud para tu vida
                            diaria.
                        </p>
                        <a href="#" class="text-secondary hover:text-primary font-medium">Ver productos</a>
                    </div>
                </div>

                <!-- Tarjeta 2 -->
                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="h-1 bg-primary"></div>
                    <div class="p-6 text-center">
                        <div
                            class="w-16 h-16 bg-premium/10 text-premium rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-check-circle text-2xl"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-primary mb-3">Calidad Garantizada</h3>
                        <p class="text-ink mb-4">
                            Cada artículo en Fornuvi cumple con nuestros estrictos criterios de calidad y efectividad.
                        </p>
                        <a href="#" class="text-secondary hover:text-primary font-medium">Nuestros estándares</a>
                    </div>
                </div>

                <!-- Tarjeta 3 -->
                <div
                    class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-lg">
                    <div class="h-1 bg-primary"></div>
                    <div class="p-6 text-center">
                        <div
                            class="w-16 h-16 bg-premium/10 text-premium rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-tag text-2xl"></i>
                        </div>
                        <h3 class="text-lg sm:text-xl font-semibold text-primary mb-3">Precios Competitivos</h3>
                        <p class="text-ink mb-4">
                            Mantenemos precios accesibles para que puedas disfrutar de productos de primer nivel sin
                            comprometer tu presupuesto.
                        </p>
                        <a href="#" class="text-secondary hover:text-primary font-medium">Ver ofertas</a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Programa de Afiliados -->
    <section class="py-6 sm:py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row-reverse items-center gap-6 sm:gap-12">
                <div class="w-full lg:w-1/2">
                    <img src="https://www.kupakia.com/wp-content/uploads/2024/07/nuevas-oportunidades-de-negocios.jpg"
                        alt="Programa de afiliados Fornuvi"
                        class="rounded-lg shadow-md w-full h-auto max-w-md mx-auto lg:max-w-none" />
                </div>
                <div class="w-full lg:w-1/2 text-center lg:text-left max-w-2xl">
                    <h2 class="text-3xl font-bold mb-6 text-primary">Únete como Afiliado y Genera Ingresos</h2>
                    <p class="text-lg mb-5 text-ink leading-relaxed">
                        Fornuvi no solo es una tienda online, es una oportunidad de crecimiento y desarrollo financiero.
                        Si buscas una manera de generar ingresos de forma innovadora y rentable, nuestro sistema de
                        afiliados es para ti.
                    </p>
                    <p class="text-lg mb-5 text-ink leading-relaxed">
                        Al ser parte de nuestra red de afiliados, podrás acceder a múltiples beneficios diseñados para
                        impulsar tu éxito dentro de la empresa.
                    </p>
                    <div class="bg-primary/5 border-l-4 border-primary p-4 rounded-r mb-6">
                        <p class="italic text-primary">
                            "Nuestro programa te brinda la posibilidad de generar ingresos de manera escalonada y
                            sostenible, dependiendo de tu crecimiento y desempeño."
                        </p>
                    </div>
                    <a href="#"
                        class="inline-block bg-primary hover:bg-secondary text-white font-semibold py-3 px-6 rounded-lg shadow transition transform hover:translate-y-1">
                        Conoce el Programa de Afiliados
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bolsa Global -->
    <section class="py-6 sm:py-16 bg-gradient-to-r from-secondary via-primary to-ink text-white mt-6 sm:mt-0">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center mb-8 sm:mb-12">
                <h2 class="text-3xl font-bold mb-4 sm:mb-6">Bolsa Global de Crecimiento</h2>
                <p class="text-lg sm:text-xl leading-relaxed">
                    Un aspecto único de nuestro modelo de negocio que recompensa el esfuerzo y el crecimiento.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-4xl mx-auto">
                <div class="bg-white/10 rounded-xl p-6 sm:p-8 backdrop-blur-sm border border-white/20">
                    <div class="text-4xl mb-4">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 sm:mb-4">Distribución Mensual</h3>
                    <p class="text-white/90 text-sm sm:text-base">
                        Cada mes, un porcentaje de todos los ingresos generados por la compañía se acumula en esta bolsa
                        y se distribuye entre nuestros afiliados activos.
                    </p>
                </div>

                <div class="bg-white/10 rounded-xl p-6 sm:p-8 backdrop-blur-sm border border-white/20">
                    <div class="text-4xl mb-4">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 sm:mb-4">Recompensa al Esfuerzo</h3>
                    <p class="text-white/90 text-sm sm:text-base">
                        La asignación de estos fondos se realiza en función del crecimiento individual de cada afiliado,
                        asegurando que quienes más se esfuerzan reciban mayores recompensas.
                    </p>
                </div>
            </div>

            <div class="mt-8 sm:mt-12 text-center">
                <a href="#"
                    class="inline-block bg-white text-primary hover:text-secondary font-semibold py-3 px-6 sm:px-8 rounded-full shadow-lg transition transform hover:scale-105">
                    Descubre cómo funciona
                </a>
            </div>
        </div>
    </section>




    <!-- Crecimiento y Rentabilidad -->
    <section class=" py-8 sm:py-16 sm:bg-neutral-50">
        <div class="container mx-auto sm:px-4">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold mb-3 sm:mb-8 text-primary text-center">Crecimiento y Rentabilidad para
                    Todos
                </h2>

                <div class="sm:bg-white rounded-xl sm:shadow-md sm:p-8 sm:mb-8">
                    <p class="text-lg text-ink leading-relaxed mb-6">
                        Sabemos que cada persona tiene diferentes aspiraciones y objetivos, por lo que hemos diseñado un
                        sistema accesible y escalable que se adapta a las necesidades de cada afiliado. Nuestra
                        estructura permite que cualquier persona con determinación y compromiso pueda avanzar y obtener
                        ingresos significativos dentro de Fornuvi.
                    </p>

                    <div class="flex items-center gap-4 mb-8">
                        <div
                            class="w-12 h-12 bg-premium/10 text-premium rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-users"></i>
                        </div>
                        <p class="text-neutral-700">
                            <span class="font-semibold">Comunidad en crecimiento</span> - Forma parte de un ecosistema
                            de oportunidades financieras donde todos crecen juntos.
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-premium/10 text-premium rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <p class="text-ink">
                            <span class="font-semibold">Respaldo sólido</span> - Cuenta con un equipo comprometido en
                            ayudarte a alcanzar tus metas financieras.
                        </p>
                    </div>
                </div>

                <div class="text-center">
                    <p class="text-xl font-semibold text-primary mt-6 sm:mt-0 mb-6">Fornuvi es más que una empresa: es
                        tu
                        oportunidad para un futuro mejor.</p>
                    <a href="#"
                        class="inline-block bg-primary hover:bg-secondary text-white font-bold py-4 px-8 rounded-lg shadow-lg transition transform hover:translate-y-1">
                        Únete hoy y empieza a construir tu camino al éxito
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- Contacto -->
    <section id="contacto" class=" mt-4  sm:mt-10 ">
        <div class="text-center sm:p-8">
            <h2 class="text-2xl md:text-4xl font-bold text-primary">¿Tienes alguna pregunta? Contáctanos</h2>
            <p class="mt-4 text-secondary">Estamos listos para responder todas tus preguntas</p>
            <div class="h-1 w-24 bg-premium mx-auto mt-4"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 py-4 sm:px-10 ">
            <div class="bg-white rounded-xl shadow-md shadow-ink p-4 sm:p-8">
                <h3 class="text-2xl font-bold text-primary mb-6">Contáctanos</h3>

                <?php if($errors->any()): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                        role="alert">
                        <strong class="font-bold">¡Error!</strong>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <form id="demo-form" action="<?php echo e(route('contacto.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="grid grid-cols-2 gap-x-3">
                        <div class="col-span-2 sm:col-span-1">
                            <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['id' => 'nombre','name' => 'nombre','label' => 'Nombre completo:','for' => 'nombre','placeholder' => 'Nombre completo','value' => ''.e(old('nombre')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'nombre','name' => 'nombre','label' => 'Nombre completo:','for' => 'nombre','placeholder' => 'Nombre completo','value' => ''.e(old('nombre')).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['id' => 'email','name' => 'email','label' => 'Correo electrónico:','type' => 'email','for' => 'email','placeholder' => 'Ingrese el Correo electrónico','value' => ''.e(old('email')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'email','name' => 'email','label' => 'Correo electrónico:','type' => 'email','for' => 'email','placeholder' => 'Ingrese el Correo electrónico','value' => ''.e(old('email')).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <?php if (isset($component)) { $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input','data' => ['id' => 'telefono','name' => 'telefono','label' => 'Teléfono:','type' => 'tel','for' => 'telefono','placeholder' => 'Ingrese el teléfono','value' => ''.e(old('telefono')).'','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'telefono','name' => 'telefono','label' => 'Teléfono:','type' => 'tel','for' => 'telefono','placeholder' => 'Ingrese el teléfono','value' => ''.e(old('telefono')).'','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $attributes = $__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__attributesOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1)): ?>
<?php $component = $__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1; ?>
<?php unset($__componentOriginalc2fcfa88dc54fee60e0757a7e0572df1); ?>
<?php endif; ?>
                        </div>

                        <div class="col-span-2 sm:col-span-1">
                            <div class="mb-5">
                                <label for="interes" class="block mb-2 text-sm font-medium text-primary">Me
                                    interesa:</label>
                                <div class="relative">
                                    <select id="interes" name="interes" required
                                        class="block w-full bg-neutral-50/50 appearance-none border border-gray-300 text-primary text-sm rounded-lg focus:outline-1 focus:outline-primary focus:bg-white p-2.5 cursor-pointer">
                                        <option value="" <?php echo e(old('interes') ? '' : 'selected'); ?>>Seleccionar
                                            opción</option>
                                        <option value="Información"
                                            <?php echo e(old('interes') == 'Información' ? 'selected' : ''); ?>>
                                            Información general</option>
                                        <option value="programa_afiliados"
                                            <?php echo e(old('interes') == 'programa_afiliados' ? 'selected' : ''); ?>>
                                            Programa de afiliados
                                        </option>
                                        <option value="Información_producto"
                                            <?php echo e(old('interes') == 'Información_producto' ? 'selected' : ''); ?>>Información
                                            producto
                                        </option>
                                        <option value="otros" <?php echo e(old('interes') == 'otros' ? 'selected' : ''); ?>>
                                            Otros
                                        </option>
                                    </select>
                                    <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-neutral-500" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['interes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-span-2">
                            <div class="mb-5">
                                <label for="mensaje"
                                    class="block mb-2 text-sm font-medium text-primary">Mensaje:</label>
                                <textarea id="mensaje" name="mensaje" rows="6" required
                                    class="block w-full bg-neutral-50/50 border border-gray-300 text-primary text-sm rounded-lg focus:outline-1 focus:outline-primary focus:bg-white p-2.5"><?php echo e(old('mensaje')); ?></textarea>
                                <?php $__errorArgs = ['mensaje'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-sm text-danger"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['type' => 'submit','variant' => 'primary','class' => 'g-recaptcha w-full','dataSitekey' => ''.e(config('services.recaptcha.key')).'','dataCallback' => 'onSubmit','dataAction' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'primary','class' => 'g-recaptcha w-full','data-sitekey' => ''.e(config('services.recaptcha.key')).'','data-callback' => 'onSubmit','data-action' => 'submit']); ?>
                        Enviar mensaje
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $attributes = $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580)): ?>
<?php $component = $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580; ?>
<?php unset($__componentOriginalc04b147acd0e65cc1a77f86fb0e81580); ?>
<?php endif; ?>
                </form>
            </div>

            <div class="bg-primary text-white rounded-xl shadow-md shadow-ink">
                <div class="p-4 sm:p-6 md:p-8">
                    <h3 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6 text-center sm:text-left">Información de
                        contacto</h3>
                    <div class="space-y-4 sm:space-y-6">
                        
                        <div class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left">
                            <div class="bg-white rounded-full text-primary mb-2 sm:mb-0 sm:mr-4">
                                <div class="w-10 h-10 flex items-center justify-center">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-base sm:text-lg font-medium mb-1">Teléfono</h4>
                                <p class="text-sm sm:text-base">+57 (314) 520-78-14</p>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left">
                            <div class="bg-white rounded-full text-primary mb-2 sm:mb-0 sm:mr-4">
                                <div class="w-10 h-10 flex items-center justify-center">
                                    <i class="fas fa-envelope"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-base sm:text-lg font-medium mb-1">Correo electrónico</h4>
                                <p class="text-sm sm:text-base">info@fornuvi.com</p>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left">
                            <div class="bg-white rounded-full text-primary mb-2 sm:mb-0 sm:mr-4">
                                <div class="w-10 h-10 flex items-center justify-center">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-base sm:text-lg font-medium mb-1">Horario de atención</h4>
                                <p class="text-sm sm:text-base">Lunes a Viernes: 9:00 AM - 6:00 PM</p>
                                <p class="text-sm sm:text-base">Sábados: 9:00 AM - 1:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 sm:mt-8">
                        <h4 class="text-base sm:text-lg font-medium mb-3 sm:mb-4 text-center sm:text-left">Síguenos en
                            redes sociales</h4>
                        <div class="flex justify-center sm:justify-start space-x-3 sm:space-x-4">
                            <a href="#"
                                class="bg-white text-primary p-2 sm:p-3 rounded-full hover:bg-neutral-200 transition duration-300">
                                <div class="w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center">
                                    <i class="fab fa-facebook-f text-sm sm:text-base"></i>
                                </div>
                            </a>
                            <a href="#"
                                class="bg-white text-primary p-2 sm:p-3 rounded-full hover:bg-neutral-200 transition duration-300">
                                <div class="w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center">
                                    <i class="fab fa-instagram text-sm sm:text-base"></i>
                                </div>
                            </a>
                            <a href="#"
                                class="bg-white text-primary p-2 sm:p-3 rounded-full hover:bg-neutral-200 transition duration-300">
                                <div class="w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center">
                                    <i class="fab fa-twitter text-sm sm:text-base"></i>
                                </div>
                            </a>
                            <a href="#"
                                class="bg-white text-primary p-2 sm:p-3 rounded-full hover:bg-neutral-200 transition duration-300">
                                <div class="w-5 h-5 sm:w-6 sm:h-6 flex items-center justify-center">
                                    <i class="fab fa-linkedin-in text-sm sm:text-base"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Back to top button -->
    <button id="backToTop"
        class="fixed cursor-pointer bottom-6 right-6 bg-secondary text-white w-12 h-12 rounded-full flex items-center justify-center shadow-md shadow-ink  hover:bg-primary transition duration-300"
        onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
        <i class="fas fa-arrow-up"></i>
    </button>

    <?php $__env->startPush('js'); ?>
        <script src="https://www.google.com/recaptcha/api.js"></script>

        <script>
            function onSubmit(token) {
                document.getElementById("demo-form").submit();
            }
        </script>
    <?php $__env->stopPush(); ?>

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

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/index.blade.php ENDPATH**/ ?>