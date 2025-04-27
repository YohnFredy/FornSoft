<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?php echo e($title ?? 'FORNUVI: Transforma tus Gastos en Ingresos'); ?></title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo app('flux')->fluxAppearance(); ?>


    <style>
        /* Estilo para el campo Honeypot - debe estar oculto visualmente */
        .honeypot-field {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            height: 0;
            width: 0;
            z-index: -1;
        }

        /* Estilo inicial para el botón de WhatsApp (oculto o semitransparente) */
        #whatsapp-button {
            /* opacity: 0.5; */
            /* transition: opacity 0.5s ease-in-out; */
            display: none; /* Lo mostraremos con JS */
            transform: translateY(20px); /* Efecto sutil de aparición */
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
        }
        #whatsapp-button.visible {
            /* opacity: 1; */
            display: inline-flex; /* O block, según tu diseño */
            transform: translateY(0);
        }
    </style>
</head>

<body class="min-h-screen bg-primary/5 text-ink">
    <div class="py-8 md:py-10 mx-auto max-w-4xl">

        <header class="">
            <div class="flex justify-center">
                <img src="<?php echo e(asset('storage/images/logo_fornuvi.png')); ?>" alt="FORNUVI Logo" class="">
            </div>
            <div
                class="text-2xl sm:text-3xl md:text-5xl lg:text-6xl font-bold leading-tight text-center mt-4 md:mt-8 mx-4">
                <span class="text-primary">Transforma</span> Tus Gastos Diarios en <span class="text-primary">Ingresos
                    Reales</span>
            </div>

            <div class="w-16 md:w-24 h-1 bg-premium mx-auto my-4 rounded-full"></div>
            <p class="text-base sm:text-lg md:text-xl max-w-2xl mx-auto leading-relaxed px-6 text-center">
                Bienvenido a la nueva era de generación de ingresos. Descubre el modelo innovador de FORNUVI que
                convierte tus compras esenciales en una poderosa oportunidad financiera.
            </p>
        </header>

        <main class="mt-4 md:mt-8">
            <!-- Video principal -->
            <div class=" mx-auto max-w-4xl sm:px-2 ">
                <video id="fornuvi-video" class="w-full h-full object-cover sm:rounded-t-lg shadow-md" controls preload="metadata"
                    poster="<?php echo e(asset('storage/videos/empresarios.jpg')); ?>">
                    <source src="<?php echo e(asset('storage/videos/fornuvi_oportunidad.mp4')); ?>" type="video/mp4">
                    Tu navegador no soporta la etiqueta de video. Considera actualizarlo.
                </video>
                <div class="p-4 md:p-6 text-center bg-gradient-to-r from-neutral-800 via-neutral-600 to-neutral-700 sm:rounded-b-lg " sm:rounded-b-lg shadow-md">
                    <p class="font-medium text-base md:text-lg text-neutral-100">Mira este corto video y descubre cómo funciona.
                    </p>
                </div>
            </div>


            <!-- Botón de WhatsApp -->
            <div class="text-center my-4 md:my-8 px-4">
                <a id="whatsapp-button"
                    href="https://wa.me/+573145207814?text=Hola%2C%20vi%20el%20video%20de%20FORNUVI%20y%20quiero%20m%C3%A1s%20informaci%C3%B3n."
                    target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center justify-center px-4 sm:px-8 py-3 sm:py-4 bg-primary hover:bg-secondary text-white font-bold text-base md:text-lg rounded-2xl shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 w-full sm:w-auto">
                    <i class="fab fa-whatsapp text-3xl mr-2"></i>
                    <span class="whitespace-normal">¡Quiero Más Información por WhatsApp!</span>
                </a>
            </div>

            
            <div aria-hidden="true" class="honeypot-field">
                <label for="hp_field">No llenar este campo</label>
                <input type="text" id="hp_field" name="hp_field" tabindex="-1" autocomplete="off">
            </div>

            <section class="mt-4 px-2 md:px-4">
                <div class="text-center px-4">
                    <h2
                        class="text-xl sm:text-2xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary inline-block">
                        ¿Por qué FORNUVI es Diferente?</h2>
                    <div class="w-12 md:w-16 h-1 my-4 bg-premium mx-auto"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 lg:gap-8">
                    <div
                        class="benefit-card bg-white rounded-2xl p-4 md:p-8 border border-gray-100 shadow-lg text-center">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 md:w-16 md:h-16 rounded-full bg-primary/10 text-primary mb-4 md:mb-6">
                            <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.83 1M9 14a4 4 0 110-8 4 4 0 010 8zm0 0v2m0-10V4M3 14a4 4 0 000-8 4 4 0 000 8zm0 0v2m0-10V4m6 14v2m0-16V2">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-ink mb-2 md:mb-3">Sin Inversión Inicial</h3>
                        <p class="text-primary text-sm md:text-base">Comienza a generar ingresos sin necesidad de
                            invertir dinero. Solo activa tu código y empieza a ganar.</p>
                    </div>

                    <div
                        class="benefit-card bg-white rounded-2xl p-4 md:p-8 border border-gray-100 shadow-lg text-center">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 md:w-16 md:h-16 rounded-full bg-secondary/10 text-secondary mb-4 md:mb-6">
                            <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-ink mb-2 md:mb-3">Sin Vender Productos</h3>
                        <p class="text-primary text-sm md:text-base">Tu enfoque es recomendar el sistema, no vender.
                            Ganas por las compras
                            que ya se hacen diariamente.</p>
                    </div>

                    <div
                        class="benefit-card bg-white rounded-2xl p-4 md:p-8 border border-gray-100 shadow-lg text-center sm:col-span-2 md:col-span-1">
                        <div
                            class="inline-flex items-center justify-center w-12 h-12 md:w-16 md:h-16 rounded-full bg-premium/10 text-premium mb-4 md:mb-6">
                            <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg md:text-xl font-bold text-ink mb-2 md:mb-3">Potencial de Accionista</h3>
                        <p class="text-primary text-sm md:text-base">Crece con nosotros y ten la oportunidad de ser
                            accionista de futuras
                            franquicias y negocios asociados.</p>
                    </div>
                </div>

                <div
                    class="mt-6 md:mt-10 p-4 md:p-6 bg-gradient-to-r from-primary to-secondary rounded-xl text-white text-center shadow-xl">
                    <p class="text-base md:text-xl font-medium">
                        Es simple: cambia dónde haces tus compras esenciales y <strong
                            class="font-bold underline decoration-premium decoration-2 underline-offset-2">convierte
                            gastos en ganancias</strong>.
                    </p>
                </div>

            </section>

            <!-- Cómo Funciona -->
            <section class=" mt-10 md:mt-16 px-2 md:px-4">
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-center mb-6 md:mb-10 text-primary">Cómo
                    Funciona FORNUVI
                </h2>

                <div class="relative">
                    <!-- Línea de conexión para desktop -->
                    <div class="hidden md:block absolute top-24 left-0 right-0 h-0.5 bg-secondary/20 z-0"></div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 md:gap-8 relative z-10">
                        <div class="bg-white p-4 md:p-6 rounded-xl shadow-md text-center">
                            <div
                                class="w-12 h-12 md:w-16 md:h-16 bg-primary text-white rounded-full flex items-center justify-center text-xl md:text-2xl font-bold mx-auto mb-3 md:mb-4">
                                1</div>
                            <h3 class="text-lg md:text-xl font-bold mb-2 md:mb-3 text-primary">Activa Tu Código</h3>
                            <p class="text-ink text-sm md:text-base">Regístrate con tu código de activación y accede a
                                nuestra plataforma
                                exclusiva.</p>
                        </div>

                        <div class="bg-white p-4 md:p-6 rounded-xl shadow-md text-center">
                            <div
                                class="w-12 h-12 md:w-16 md:h-16 bg-primary text-white rounded-full flex items-center justify-center text-xl md:text-2xl font-bold mx-auto mb-3 md:mb-4">
                                2</div>
                            <h3 class="text-lg md:text-xl font-bold mb-2 md:mb-3 text-primary">Cambia Tus Hábitos</h3>
                            <p class="text-ink text-sm md:text-base">Realiza tus compras habituales a través de nuestra
                                red de
                                establecimientos asociados.</p>
                        </div>

                        <div class="bg-white p-4 md:p-6 rounded-xl shadow-md text-center sm:col-span-2 md:col-span-1">
                            <div
                                class="w-12 h-12 md:w-16 md:h-16 bg-primary text-white rounded-full flex items-center justify-center text-xl md:text-2xl font-bold mx-auto mb-3 md:mb-4">
                                3</div>
                            <h3 class="text-lg md:text-xl font-bold mb-2 md:mb-3 text-primary">Genera Ingresos</h3>
                            <p class="text-ink text-sm md:text-base">Recibe comisiones por tus compras y las de tu red.
                                Crece y expande tus
                                ganancias.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Llamado a la acción -->
            <section class=" mt-8 md:mt-12 px-2 md:px-4">
                <div
                    class="text-center bg-gradient-to-br from-secondary to-ink text-white p-5 md:p-10 rounded-2xl shadow-2xl">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-4 md:mb-6">¿Listo para Transformar tu
                        Economía?</h2>
                    <p class="text-base sm:text-lg md:text-xl mb-6 md:mb-8 max-w-2xl mx-auto">Deja de ser un consumidor
                        pasivo. Conviértete en protagonista
                        de un sistema inteligente que trabaja para ti y tu futuro financiero.</p>

                    <a href="https://wa.me/+573145207814?text=Hola%2C%20vi%20la%20p%C3%A1gina%20de%20FORNUVI%20y%20estoy%20listo%20para%20saber%20m%C3%A1s."
                        target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center justify-center px-4 sm:px-8 py-3 sm:py-4 bg-white hover:bg-white/95 text-primary font-bold text-base md:text-lg rounded-2xl shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 w-full sm:w-auto">
                        <i class="fab fa-whatsapp text-3xl mr-2"></i>
                        <span class="whitespace-normal">Sí, ¡Quiero Saber Cómo Empezar!</span>
                    </a>
                    <p class="mt-4 md:mt-6 text-blue-100 text-sm md:text-base">Sin riesgos. Sin inversión. Sin
                        compromisos.
                    </p>
                </div>
            </section>

            <!-- FAQ -->
            <section class=" mt-8 md:mt-12 px-2 md:px-4">
                <div class=" bg-white rounded-2xl shadow-lg p-4 md:p-8">
                    <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-center mb-6 md:mb-8">Preguntas Frecuentes
                    </h2>

                    <div class="space-y-3 md:space-y-4">
                        <div class="border border-gray-200 rounded-lg p-3 md:p-4">
                            <h3 class="font-bold text-base md:text-lg text-primary mb-1 md:mb-2">¿Necesito experiencia
                                previa?</h3>
                            <p class="text-ink text-sm md:text-base">No, nuestro sistema está diseñado para cualquier
                                persona,
                                independientemente de su experiencia. Te proporcionamos toda la capacitación necesaria.
                            </p>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-3 md:p-4">
                            <h3 class="font-bold text-base md:text-lg text-primary mb-1 md:mb-2">¿Cuánto tiempo debo
                                dedicar?</h3>
                            <p class="text-ink text-sm md:text-base">Tú decides el tiempo. FORNUVI se adapta a tu
                                estilo de
                                vida. Puedes empezar
                                dedicando solo unas horas a la semana.</p>
                        </div>

                        <div class="border border-gray-200 rounded-lg p-3 md:p-4">
                            <h3 class="font-bold text-base md:text-lg text-primary mb-1 md:mb-2">¿Cómo recibo mis
                                ganancias?</h3>
                            <p class="text-ink text-sm md:text-base">Tus ganancias se acumulan en tu cuenta personal y
                                puedes transferirlas a tu
                                cuenta bancaria en cualquier momento, con total transparencia.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer class="text-center mt-8 border-t border-gray-800 mx-4">
            <div class="mt-4 md:mt-8">
                <img src="<?php echo e(asset('storage/images/logo_fornuvi.png')); ?>" alt="FORNUVI Logo"
                    class="h-8 md:h-10 mx-auto">
            </div>

            <p class="text-gray-500 text-sm md:text-base mt-4">&copy; <?php echo e(date('Y')); ?> FORNUVI. Todos los derechos
                reservados.</p>

            
        </footer>
    </div>


    
    <script>
        // Pasamos datos de PHP a JavaScript de forma segura
        window.fornuviTracking = {
            visitId: <?php echo e($visitId ?? 'null'); ?>,
            trackUrl: '<?php echo e(route('landing.track')); ?>',
            csrfToken: '<?php echo e(csrf_token()); ?>'
        };
    </script>
    
</body>

</html>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/landing.blade.php ENDPATH**/ ?>