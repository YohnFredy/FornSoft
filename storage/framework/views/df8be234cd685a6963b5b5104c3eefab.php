<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title', // Título del enlace o grupo
    'icon' => null, // Ej: 'fas fa-users'  (FontAwesome)
    'iconBlade' => null, // Ej: 'flux:icon.bolt' (Blade Component)
    'routes' => [], // Rutas que activan el menú
    'items' => null, // Subitems: [ ['name'=>'...', 'route'=>'...', 'icon'=>'...', 'iconBlade'=>null] ]
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title', // Título del enlace o grupo
    'icon' => null, // Ej: 'fas fa-users'  (FontAwesome)
    'iconBlade' => null, // Ej: 'flux:icon.bolt' (Blade Component)
    'routes' => [], // Rutas que activan el menú
    'items' => null, // Subitems: [ ['name'=>'...', 'route'=>'...', 'icon'=>'...', 'iconBlade'=>null] ]
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $active = collect($routes)->some(fn($r) => request()->routeIs($r));
?>

<div x-data="{ open: <?php echo e($active ? 'true' : 'false'); ?> }">
    
    <?php if($items): ?>
        <button @click="open = !open" :aria-expanded="open.toString()"
            class="flex items-center justify-between w-full text-left  text-primary hover:font-bold cursor-pointer hover:bg-secondary/5 py-2 px-3 rounded-xl focus:outline-none group">
            <div class="flex items-center gap-3 text-sm">
                <?php if($iconBlade): ?>
                    <?php if (isset($component)) { $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.index','data' => ['name' => ''.e($iconBlade).'','variant' => 'mini','class' => ' text-secondary group-hover:text-primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => ''.e($iconBlade).'','variant' => 'mini','class' => ' text-secondary group-hover:text-primary']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $attributes = $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $component = $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
                <?php elseif($icon): ?>
                    <i class="<?php echo e($icon); ?> text-secondary group-hover:text-primary"></i>
                <?php endif; ?>
                <span><?php echo e($title); ?></span>
            </div>

            <?php if (isset($component)) { $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.index','data' => ['name' => 'chevron-right','variant' => 'mini','xBind:class' => 'open ? \'text-premium rotate-90\' : \'text-secondary rotate-0\'','class' => 'transition-transform duration-300']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'chevron-right','variant' => 'mini','x-bind:class' => 'open ? \'text-premium rotate-90\' : \'text-secondary rotate-0\'','class' => 'transition-transform duration-300']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $attributes = $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $component = $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
        </button>

        <div x-show="open" <?php if(!$active): ?> wire:cloak <?php endif; ?> x-transition class="relative mt-1 pl-5">
            <span x-show="open" x-transition.opacity
                class="absolute left-5 top-0 bottom-0 w-0.5 bg-premium/50"></span>

            <nav class="space-y-1 ml-2 text-secondary">
                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $itemActive = request()->routeIs($item['route']);
                    ?>
                    <a href="<?php echo e(route($item['route'])); ?>"
                        class="flex items-center gap-3 py-1 px-2 rounded text-sm
                       hover:bg-secondary/5 hover:text-primary
                       <?php echo e($itemActive ? 'bg-white hover:bg-white text-primary shadow-sm border border-primary/50' : ''); ?>">
                        <?php if(!empty($item['iconBlade'])): ?>
                            <?php if (isset($component)) { $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.index','data' => ['name' => ''.e($item['iconBlade']).'','variant' => 'micro']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => ''.e($item['iconBlade']).'','variant' => 'micro']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $attributes = $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $component = $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
                        <?php elseif(!empty($item['icon'])): ?>
                            <i class="<?php echo e($item['icon']); ?>"></i>
                        <?php endif; ?>
                        <span><?php echo e($item['name']); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </nav>
        </div>

        
    <?php else: ?>
        <a href="<?php echo e(route($routes[0])); ?>"
            class="flex items-center w-full text-left text-primary hover:font-bold cursor-pointer hover:bg-secondary/5 py-2 px-3 rounded-lg focus:outline-none group
                  <?php echo e($active ? 'bg-white hover:bg-white hover:font-normal text-primary shadow-sm border border-primary/50' : ''); ?>">
            <div class="flex items-center gap-3 text-sm">
                <?php if($iconBlade): ?>
                    <?php if (isset($component)) { $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.index','data' => ['name' => ''.e($iconBlade).'','variant' => 'mini','class' => 'text-secondary group-hover:text-primary ']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => ''.e($iconBlade).'','variant' => 'mini','class' => 'text-secondary group-hover:text-primary ']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $attributes = $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2)): ?>
<?php $component = $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2; ?>
<?php unset($__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2); ?>
<?php endif; ?>
                <?php elseif($icon): ?>
                    <i class="<?php echo e($icon); ?> text-secondary group-hover:text-primary"></i>
                <?php endif; ?>
                <span><?php echo e($title); ?></span>
            </div>
        </a>
    <?php endif; ?>
</div>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/components/menu-item.blade.php ENDPATH**/ ?>