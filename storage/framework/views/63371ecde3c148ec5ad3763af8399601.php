<li>

    <!--[if BLOCK]><![endif]--><?php if($node['level'] < 2): ?>
        <a wire:click="show(<?php echo e($node['id']); ?>)" class="hover:bg-neutral-50 transition-colors cursor-pointer">
            <div class=" space-y-2 p-2  text-primary">
                <div class=" flex items-center justify-center">
                    <div class="w-6 h-6 sm:w-8 sm:h-8 bg-primary/10 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-primary"></i>
                    </div>
                    <h4 class="ml-2 text-base sm:text-xl font-bold text-primary">
                        <?php echo e($node['username']); ?>

                    </h4>
                </div>

                <div class=" flex items-center justify-center text-xs sm:text-sm">
                    <i class=" text-danger fas fa-users text-xs mr-1"></i>
                    Directos:
                    <span class="font-medium pl-1 "><?php echo e($node['direct_affiliates']); ?></span>
                </div>

                <div class=" flex items-center justify-center text-xs sm:text-sm">
                    <i class=" text-danger fas fa-users text-xs mr-1"></i> Total:
                    <span class="font-medium pl-1"><?php echo e($node['total_affiliates']); ?></span>
                </div>
            </div>

        </a>
    <?php elseif($node['level'] < 3): ?>
        <a wire:click="show(<?php echo e($node['id']); ?> )" class="">
            <div class=" text-[8px] text-primary">
                <h6><?php echo e($node['username']); ?></h6>
            </div>
        </a>
    <?php else: ?>
        <a wire:click="show(<?php echo e($node['id']); ?>)">
        </a>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->

    <!--[if BLOCK]><![endif]--><?php if(!empty($node['children'])): ?>
        <ul>
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $node['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('livewire.office.children-unilevel', ['node' => $child], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </ul>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</li>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/livewire/office/children-unilevel.blade.php ENDPATH**/ ?>