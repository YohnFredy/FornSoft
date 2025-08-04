
<?php
$classes = Flux::classes()
    ->add('shrink-0 size-[1.125rem] rounded-full')
    ->add('text-sm text-zinc-700 dark:text-zinc-800')
    ->add('shadow-xs [ui-radio[disabled]_&]:opacity-75 [ui-radio[data-checked][disabled]_&]:opacity-50 [ui-radio[disabled]_&]:shadow-none [ui-radio[data-checked]_&]:shadow-none')
    ->add('flex justify-center items-center [ui-radio[data-checked]_&>div]:block')
    ->add([
        'border',
        'border-neutral-400',
        '[ui-radio[disabled]_&]:border-zinc-200 dark:[ui-radio[disabled]_&]:border-white/5',
        '[ui-radio[data-checked]_&]:border-transparent data-indeterminate:border-transparent',
        '[ui-radio[data-checked]_&]:[ui-radio[disabled]_&]:border-transparent data-indeterminate:border-transparent',
        '[print-color-adjust:exact]',
    ])
    ->add([
        'bg-white',
        '[ui-radio[data-checked]_&]:bg-secondary',
        'hover:[ui-radio[data-checked]_&]:bg-primary',
        'focus:[ui-radio[data-checked]_&]:bg-(--color-accent)',
    ])
    ;
?>

<div <?php echo e($attributes->class($classes)); ?> data-flux-radio-indicator>
    <div class="hidden size-2 rounded-full bg-white"></div>
</div>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/flux/radio/indicator.blade.php ENDPATH**/ ?>