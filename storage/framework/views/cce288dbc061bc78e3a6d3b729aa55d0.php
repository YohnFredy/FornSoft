<div>
    <div class=" sm:p-6 sm:bg-white/80 sm:shadow-lg shadow-ink rounded-lg min-h-screen">
        <!-- Header del Dashboard -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 sm:gap-0 mb-4 sm:mb-8">
            <div class="text-center sm:text-left w-full sm:w-auto">
                <h1 class="text-xl sm:text-2xl md:text-3xl font-bold text-primary">Oficina Virtual</h1>
                <p class="text-ink text-sm sm:text-base">Bienvenido de nuevo</p>
            </div>
            <div class="flex items-center space-x-3 sm:space-x-4">
                <div class="relative">
                    <button class="p-1.5 sm:p-2 bg-white rounded-full text-primary hover:bg-zinc-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                    </button>
                    <span
                        class="absolute top-0 right-0 h-2.5 w-2.5 sm:h-3 sm:w-3 rounded-full bg-danger border-2 border-white"></span>
                </div>
                <div class="flex items-center rounded-full py-1 px-2 shadow-sm">
                    <span class="font-medium text-xs sm:text-sm text-primary capitalize"><?php echo e($user->name); ?></span>
                </div>
            </div>
        </div>

        <!-- Cards  -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
            <!-- Card Ganancias Totales -->
           

            <!-- Card Socios Unilevel -->
            <div
                class="bg-white rounded-xl shadow-lg hover:shadow-xl shadow-ink border border-primary/30 transition-all duration-300 overflow-hidden">

                <div class="p-6">
                    <div class=" flex items-center justify-between">
                        <p class="text-sm font-semibold text-primary uppercase tracking-wider">Socios Unilevel</p>
                        <div class="p-3 rounded-full bg-secondary/20 text-secondary shadow-md flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <div class="bg-neutral-50 rounded-lg p-3 text-center">
                            <span class="block text-sm text-secondary font-medium">Directos</span>
                            <span class="block text-xl font-bold text-ink mt-1">
                                <?php echo e($direct); ?>

                            </span>
                        </div>
                        <div class="bg-neutral-50 rounded-lg p-3 text-center">
                            <span class="block text-sm text-secondary font-medium">Afiliados</span>
                            <span class="block text-xl font-bold text-ink mt-1"><?php echo e($totalDirect); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card Socios Binario -->
            <div
                class="bg-white rounded-xl shadow-lg hover:shadow-xl shadow-ink border border-primary/30 transition-all duration-300 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-semibold text-primary uppercase tracking-wider mr-4">Socios Binario</p>
                        <div class="p-3 rounded-full bg-danger/20 text-danger shadow-md flex-shrink-0">
                            <!--[if BLOCK]><![endif]--><?php if($left > $right): ?>
                                <i class="fas fa-balance-scale-left h-6 w-6"></i>
                            <?php elseif($right > $left): ?>
                                <i class="fas fa-balance-scale-right h-6 w-6"></i>
                            <?php else: ?>
                                <i class="fas fa-balance-scale h-6 w-6"></i>
                            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-2">
                        <div class="bg-neutral-50 rounded-lg p-3 text-center">
                            <span class="block text-sm font-medium text-danger">Izquierda</span>
                            <span class="block text-xl font-bold text-ink mt-1"><?php echo e($left); ?></span>
                        </div>
                        <div class="bg-neutral-50 rounded-lg p-3 text-center">
                            <span class="block text-sm font-medium text-danger">Derecha</span>
                            <span class="block text-xl font-bold text-ink mt-1"><?php echo e($right); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Rango alcanzado -->
            <div
                class="bg-white rounded-xl shadow-lg hover:shadow-xl shadow-ink border border-primary/30 transition-all duration-300 overflow-hidden">

                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div class="space-y-2">
                            <p class="text-sm font-semibold text-primary uppercase tracking-wider">Rango alcanzado</p>
                            <h3 class="text-2xl font-bold text-premium">Asociado</h3>
                            <div class="flex items-center text-sm font-medium mt-1">
                                <span class="px-3 py-1 rounded-lg bg-neutral-50 text-primary">
                                    Próximo nivel: Aprendiz
                                </span>
                            </div>
                        </div>
                        <div class="p-3 rounded-full bg-premium/20 text-premium shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos y Estadísticas -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8 mb-8">
            <!-- Gráfico de Rendimiento -->
            <div class="bg-white p-6 border border-primary/30 rounded-lg shadow-md shadow-ink">
                <div class="sm:flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-primary">Rendimiento de Red</h2>
                    <div class="flex bg-zinc-50 rounded-lg p-1 text-sm shadow-xs shadow-ink">
                        <button
                            class="px-3 py-1 rounded bg-white shadow shadow-ink text-ink font-medium">Semana</button>
                        <button class="px-3 py-1 text-gray-600">Mes</button>
                        <button class="px-3 py-1 text-gray-600">Año</button>
                    </div>
                </div>
                <div class="h-64 flex items-end space-x-2">
                    <div class="bg-primary rounded-t w-full h-16 hover:bg-secondary transition-colors"></div>
                    <div class="bg-primary rounded-t w-full h-28 hover:bg-secondary transition-colors"></div>
                    <div class="bg-primary rounded-t w-full h-20 hover:bg-secondary transition-colors"></div>
                    <div class="bg-primary rounded-t w-full h-24 hover:bg-secondary transition-colors"></div>
                    <div class="bg-primary rounded-t w-full h-32 hover:bg-secondary transition-colors"></div>
                    <div class="bg-primary rounded-t w-full h-40 hover:bg-secondary transition-colors"></div>
                    <div class="bg-secondary rounded-t w-full h-52 hover:bg-primary transition-colors"></div>
                </div>
                <div class="flex justify-between mt-2 text-xs text-primary">
                    <span>Lun</span>
                    <span>Mar</span>
                    <span>Mié</span>
                    <span>Jue</span>
                    <span>Vie</span>
                    <span>Sáb</span>
                    <span>Dom</span>
                </div>
            </div>

            <!-- Estructura de Red -->
            
        </div>

        <!-- Listado de Socios y Actividades -->
        

        <hr class=" my-8">


        <div id="link-sponsor" class=" bg-secondary/5 rounded-lg py-4 px-6 mb-4 ">
            <h1 class=" text-center font-medium text-primary text-lg">Haz clic en "Registrar" en el lado
                correspondiente donde deseas inscribir al prospecto o copia el enlace para enviárselo.</h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10">
            <!-- Link Lado Izquierdo -->
            <div class="bg-gradient-to-bl from-white to-primary/20  p-4 sm:p-6 rounded-lg ">
                <div class="flex items-center justify-center mb-3">
                    <div class="bg-primary/10 p-2 rounded-full mr-2">
                        <i class="fas fa-arrow-left text-primary"></i>
                    </div>
                    <?php if (isset($component)) { $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::heading','data' => ['class' => 'text-primary! text-lg sm:text-xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-primary! text-lg sm:text-xl']); ?>Link lado izquierdo <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $attributes = $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $component = $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
                </div>

                <div class="relative bg-neutral-50 rounded-lg p-2 border border-dashed border-neutral-200 mb-4">
                    <p id="p2" class="text-xs sm:text-sm text-neutral-600 truncate select-all">
                        https://fornuvi.com/register/<?php echo e($user->username); ?>/left</p>
                    <button
                        class="absolute right-1 top-1/2 transform -translate-y-1/2 text-neutral-400 hover:text-primary transition-colors"
                        onclick="copiarAlPortapapeles('p2')">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>

                <div class="space-y-3">
                    <div class="text-center">
                        <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['variant' => 'primary','class' => 'w-full sm:w-auto cursor-pointer transition-transform hover:scale-105','onclick' => 'copiarAlPortapapeles(\'p2\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','class' => 'w-full sm:w-auto cursor-pointer transition-transform hover:scale-105','onclick' => 'copiarAlPortapapeles(\'p2\')']); ?>
                            <i class="fas fa-copy mr-2"></i> Copiar enlace
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
                    </div>

                    <div class="text-center">
                        <?php if (isset($component)) { $__componentOriginal54ddb5b70b37b1e1cf0f2f95e4c53477 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54ddb5b70b37b1e1cf0f2f95e4c53477 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::link','data' => ['class' => 'text-danger hover:text-premium flex items-center justify-center gap-1 transition-all','href' => ''.e(route('register', [$user->username, 'left'])).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-danger hover:text-premium flex items-center justify-center gap-1 transition-all','href' => ''.e(route('register', [$user->username, 'left'])).'']); ?>
                            <i class="fas fa-user-plus text-xs"></i> Registrar directo
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54ddb5b70b37b1e1cf0f2f95e4c53477)): ?>
<?php $attributes = $__attributesOriginal54ddb5b70b37b1e1cf0f2f95e4c53477; ?>
<?php unset($__attributesOriginal54ddb5b70b37b1e1cf0f2f95e4c53477); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54ddb5b70b37b1e1cf0f2f95e4c53477)): ?>
<?php $component = $__componentOriginal54ddb5b70b37b1e1cf0f2f95e4c53477; ?>
<?php unset($__componentOriginal54ddb5b70b37b1e1cf0f2f95e4c53477); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Link Lado Derecho -->
            <div class="bg-gradient-to-br from-white to-primary/20 p-4 sm:p-6 rounded-lg">
                <div class="flex items-center justify-center mb-3">
                    <div class="bg-primary/10 p-2 rounded-full mr-2">
                        <i class="fas fa-arrow-right text-primary"></i>
                    </div>
                    <?php if (isset($component)) { $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::heading','data' => ['class' => 'text-primary! text-lg sm:text-xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::heading'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-primary! text-lg sm:text-xl']); ?>Link lado derecho <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $attributes = $__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__attributesOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9)): ?>
<?php $component = $__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9; ?>
<?php unset($__componentOriginale0fd5b6a0986beffac17a0a103dfd7b9); ?>
<?php endif; ?>
                </div>

                <div class="relative bg-neutral-50 rounded-lg p-2 border border-dashed border-neutral-200 mb-4">
                    <p id="p1" class="text-xs sm:text-sm text-neutral-600 truncate select-all">
                        https://fornuvi.com/register/<?php echo e($user->username); ?>/right</p>
                    <button
                        class="absolute right-1 top-1/2 transform -translate-y-1/2 text-neutral-400 hover:text-primary transition-colors"
                        onclick="copiarAlPortapapeles('p1')">
                        <i class="fas fa-copy"></i>
                    </button>
                </div>

                <div class="space-y-3">
                    <div class="text-center">
                        <?php if (isset($component)) { $__componentOriginalc04b147acd0e65cc1a77f86fb0e81580 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc04b147acd0e65cc1a77f86fb0e81580 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::button.index','data' => ['variant' => 'primary','class' => 'w-full sm:w-auto cursor-pointer transition-transform hover:scale-105','onclick' => 'copiarAlPortapapeles(\'p1\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'primary','class' => 'w-full sm:w-auto cursor-pointer transition-transform hover:scale-105','onclick' => 'copiarAlPortapapeles(\'p1\')']); ?>
                            <i class="fas fa-copy mr-2"></i> Copiar enlace
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
                    </div>

                    <div class="text-center">
                        <?php if (isset($component)) { $__componentOriginal54ddb5b70b37b1e1cf0f2f95e4c53477 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54ddb5b70b37b1e1cf0f2f95e4c53477 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::link','data' => ['class' => 'text-danger hover:text-premium flex items-center justify-center gap-1 transition-all','href' => ''.e(route('register', [$user->username, 'right'])).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-danger hover:text-premium flex items-center justify-center gap-1 transition-all','href' => ''.e(route('register', [$user->username, 'right'])).'']); ?>
                            <i class="fas fa-user-plus text-xs"></i> Registrar directo
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54ddb5b70b37b1e1cf0f2f95e4c53477)): ?>
<?php $attributes = $__attributesOriginal54ddb5b70b37b1e1cf0f2f95e4c53477; ?>
<?php unset($__attributesOriginal54ddb5b70b37b1e1cf0f2f95e4c53477); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54ddb5b70b37b1e1cf0f2f95e4c53477)): ?>
<?php $component = $__componentOriginal54ddb5b70b37b1e1cf0f2f95e4c53477; ?>
<?php unset($__componentOriginal54ddb5b70b37b1e1cf0f2f95e4c53477); ?>
<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copiarAlPortapapeles(id_elemento) {
            var aux = document.createElement("input");
            aux.setAttribute("value", document.getElementById(id_elemento).innerHTML);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");
            document.body.removeChild(aux);
        }
    </script>
</div>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/livewire/office/dashboard.blade.php ENDPATH**/ ?>