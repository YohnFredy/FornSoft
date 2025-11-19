<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label' => '', 'for' => '', 'disabled' => false]));

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

foreach (array_filter((['label' => '', 'for' => '', 'disabled' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="mb-5">
    <label for="<?php echo e($for); ?>" class="block mb-2 text-sm font-medium text-primary">
        <?php echo e($label); ?>

    </label>

    <input 
        <?php echo e($disabled ? 'disabled' : ''); ?> 
        <?php echo $attributes->merge([
            'class' => 'block w-full border text-sm rounded-lg p-2.5 focus:outline-1 ' . 
                        ($disabled 
                            ? 'bg-neutral-50/20 text-neutral-400 border-neutral-100 cursor-not-allowed' 
                            : 'bg-neutral-50/50 border-gray-300 text-primary focus:outline-primary focus:bg-white')
        ]); ?>

    >

    <!--[if BLOCK]><![endif]--><?php $__errorArgs = [$for];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p <?php echo e($attributes->merge(['class' => 'text-sm text-danger'])); ?>><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><!--[if ENDBLOCK]><![endif]-->
</div>

<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/components/input.blade.php ENDPATH**/ ?>