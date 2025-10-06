<li class="py-1" wire:key="category-<?php echo e($category->id); ?>">
    <!--[if BLOCK]><![endif]--><?php if($category->children->isEmpty()): ?>
        
        <button wire:click="category(<?php echo e($category->id); ?>)" 
            class=" cursor-pointer w-full text-left flex items-center  px-2 py-0.5  hover:text-secondary hover:bg-neutral-100 rounded-md   group">
            <span class="flex-1"><?php echo e($category->name); ?></span>
            <span class="opacity-0 group-hover:opacity-100 duration-300 text-ink">
                <i class="fas fa-arrow-right text-sm"></i>
            </span>
        </button>
    <?php else: ?>
        
        <button 
            class="w-full px-2 py-0.5 hover:text-secondary hover:bg-neutral-100 focus:bg-neutral-100 rounded-md cursor-pointer"
            x-on:click="openCategories[<?php echo e($category->id); ?>] = !openCategories[<?php echo e($category->id); ?>]">
            <span class="flex items-center justify-between ">
                <p class=""><?php echo e($category->name); ?></p>
                <i
                    x-bind:class="openCategories[<?php echo e($category->id); ?>] ?
                        'fas fa-chevron-down text-danger' :
                        'fas fa-chevron-right text-primary'"></i>
            </span>
        </button>

        <div x-show="openCategories[<?php echo e($category->id); ?>]" x-collapse class="ml-2">
            <ul class="divide-y-1 divide-neutral-400">
                <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('partials.category-item', [
                        'category' => $child,
                        'level' => $level + 1,
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
            </ul>
        </div>
    <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
</li>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/partials/category-item.blade.php ENDPATH**/ ?>