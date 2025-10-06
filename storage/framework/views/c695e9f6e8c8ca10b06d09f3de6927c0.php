<li>
    <!--[if BLOCK]><![endif]--><?php if($node['level'] < 1): ?>
        <a wire:click="show(<?php echo e($node['id']); ?>)" class="hover:bg-neutral-50 transition-colors cursor-pointer">

            <div class="grid grid-cols-2 gap-x-2 gap-y-1 p-2">
                <div class="col-span-2 flex items-center justify-center mb-1">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-primary/10 rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-user text-primary"></i>
                    </div>
                    <!--[if BLOCK]><![endif]--><?php if($node['username'] == 'master'): ?>
                        <h4 class=" text-base sm:text-xl font-bold capitalize text-primary">
                            Alejandra
                        </h4>
                    <?php else: ?>
                        <h4 class=" text-base sm:text-xl font-bold capitalize text-primary">
                            <?php echo e($node['username']); ?>

                        </h4>
                    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
                </div>

                <h5 class="text-danger font-bold text-xs sm:text-sm text-center">
                    Izquierdo
                </h5>

                <h5 class="text-danger font-bold text-xs sm:text-sm text-center">
                    Derecho
                </h5>

                <div class="col-span-1  flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            <i class="fas fa-user-tag text-xs"></i> User
                        </span>
                        <span class="truncate pl-1"><?php echo e($node['left'] ?: 'Vacío'); ?></span>
                    </h6>
                </div>

                <div class="col-span-1 flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            <i class="fas fa-user-tag text-xs"></i> User
                        </span>
                        <span class="truncate pl-1"><?php echo e($node['right'] ?: 'Vacío'); ?></span>
                    </h6>
                </div>

                <div class="col-span-1 flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            <i class="fas fa-chart-bar text-xs"></i> Puntos
                        </span>
                        <span class="font-medium pl-1"><?php echo e($node['ptsLeft'] ?: 'Vacío'); ?></span>
                    </h6>
                </div>

                <div class="col-span-1 flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            <i class="fas fa-chart-bar text-xs"></i> Puntos
                        </span>
                        <span class="font-medium pl-1"><?php echo e($node['ptsRight'] ?: 'Vacío'); ?></span>
                    </h6>
                </div>
            </div>
        </a>
    <?php elseif($node['level'] < 2): ?>
        <a wire:click="show(<?php echo e($node['id']); ?>)" class="hover:bg-neutral-50 transition-colors cursor-pointer">
            <div class="grid grid-cols-2 gap-x-2 gap-y-1 p-1">
                <div class="col-span-2 flex items-center justify-center mb-1">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-primary/10 rounded-full flex items-center justify-center mr-2">
                        <i class="fas fa-user text-primary"></i>
                    </div>
                    <h4 class="text-sm sm:text-lg font-bold capitalize text-primary">
                        <?php echo e($node['username']); ?>

                    </h4>
                </div>

                <h5 class="text-danger font-bold text-xs sm:text-sm text-center">
                    Izquierdo
                </h5>

                <h5 class="text-danger font-bold text-xs sm:text-sm text-center">
                    Derecho
                </h5>

                <div class="col-span-1  flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            <i class="fas fa-user-tag text-xs"></i> User
                        </span>
                        <span class="truncate pl-1"><?php echo e($node['left'] ?: 'Vacío'); ?></span>
                    </h6>
                </div>

                <div class="col-span-1 flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            <i class="fas fa-user-tag text-xs"></i> User
                        </span>
                        <span class="truncate pl-1"><?php echo e($node['right'] ?: 'Vacío'); ?></span>
                    </h6>
                </div>

                <div class="col-span-1 flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            Puntos
                        </span>
                        <span class="font-medium pl-1"><?php echo e($node['ptsLeft'] ?: 'Vacío'); ?></span>
                    </h6>
                </div>

                <div class="col-span-1 flex justify-center">
                    <h6 class="text-ink text-xs sm:text-sm flex flex-col">
                        <span class="text-primary font-semibold flex items-center gap-1">
                            Puntos
                        </span>
                        <span class="font-medium pl-1"><?php echo e($node['ptsRight'] ?: 'Vacío'); ?></span>
                    </h6>
                </div>
            </div>
        </a>
    <?php elseif($node['level'] < 3): ?>
        <a wire:click="show(<?php echo e($node['id']); ?>)" class="hover:bg-neutral-50 transition-colors cursor-pointer">
            <h4 class="capitalize text-primary">
                <?php echo e($node['username']); ?>

            </h4>
        </a>
    <?php elseif($node['level'] < 4): ?>
        <a wire:click="show(<?php echo e($node['id']); ?>)" class="hover:bg-neutral-50 transition-colors cursor-pointer">
            <h4 class="text-[8px] capitalize text-primary">
                <?php echo e($node['username']); ?>

            </h4>
        </a>
    <?php else: ?>
        <a wire:click="show(<?php echo e($node['id']); ?>)">
        </a>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if(!empty($node['children'])): ?>
        <ul>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $node['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('livewire.office.children-binary', ['node' => $child], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </ul>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</li>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/livewire/office/children-binary.blade.php ENDPATH**/ ?>