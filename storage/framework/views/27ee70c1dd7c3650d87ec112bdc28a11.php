<div class="w-ful" x-data="{ openCategories: {} }" x-cloak> 
    <h3 class="text-lg font-medium text-danger">Categorías</h3>

    <ul class=" text-primary px-2">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $__env->make('partials.category-item', ['category' => $category, 'level' => 0], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </ul>
</div>








<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/livewire/product/category-listing.blade.php ENDPATH**/ ?>