<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'iconVariant' => 'micro',
    'iconTrailing' => null,
    'initials' => null,
    'chevron' => true,
    'avatar' => null,
    'name' => null,
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
    'iconVariant' => 'micro',
    'iconTrailing' => null,
    'initials' => null,
    'chevron' => true,
    'avatar' => null,
    'name' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
// If no initials are provided, we'll try to generate them from the name by taking the first letter of the first and last name...
$initials ??= collect(explode(' ', $name ?? ''))
    ->map(fn($part) => Str::substr($part, 0, 1))
    ->filter()
    ->only([0, count(explode(' ', $name ?? '')) - 1])
    ->implode('');

// When using the outline icon variant, we need to size it down to match the default icon sizes...
$iconClasses = Flux::classes('text-zinc-400 group-hover:text-zinc-800')
    ->add($iconVariant === 'outline' ? 'size-4' : '');

$classes = Flux::classes()
    ->add('group flex items-center rounded-lg')
    ->add('[ui-dropdown>&]:w-full') // Without this, the "name" won't get truncated in a sidebar dropdown...
    ->add('p-1 hover:bg-zinc-800/5')
    ;
?>

<button type="button" <?php echo e($attributes->class($classes)); ?> data-flux-profile>
    <div class="shrink-0 size-8 bg-zinc-200 rounded-sm overflow-hidden">
        <?php if (is_string($avatar)): ?>
            <img src="<?php echo e($avatar); ?>" />
        <?php elseif ($avatar): ?>
            <?php echo e($avatar); ?>

        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center text-sm">
                <?php echo e($initials); ?>

            </div>
        <?php endif; ?>
    </div>

    <?php if ($name): ?>
        <span class="ml-2 text-sm text-zinc-500  group-hover:text-zinc-800  font-medium truncate">
            <?php echo e($name); ?>

        </span>
    <?php endif; ?>

    <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
        <div class="shrink-0 ml-auto size-8 flex justify-center items-center">
            <?php if (isset($component)) { $__componentOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc7d5f44bf2a2d803ed0b55f72f1f82e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.index','data' => ['icon' => $iconTrailing,'variant' => $iconVariant,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconTrailing),'variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconVariant),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
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
        </div>
    <?php elseif ($iconTrailing): ?>
        <?php echo e($iconTrailing); ?>

    <?php elseif ($chevron): ?>
        <div class="shrink-0 ml-auto size-8 flex justify-center items-center">
            <?php if (isset($component)) { $__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'e60dd9d2c3a62d619c9acb38f20d5aa5::icon.chevron-down','data' => ['variant' => $iconVariant,'class' => $iconClasses]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('flux::icon.chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconVariant),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconClasses)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0)): ?>
<?php $attributes = $__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0; ?>
<?php unset($__attributesOriginal298ff21bbc41cebb188cbb18c6c11bc0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0)): ?>
<?php $component = $__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0; ?>
<?php unset($__componentOriginal298ff21bbc41cebb188cbb18c6c11bc0); ?>
<?php endif; ?>
        </div>
    <?php endif; ?>
</button>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/flux/profile.blade.php ENDPATH**/ ?>