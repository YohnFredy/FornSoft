<?php
$classes = Flux::classes()
    ->add('[:where(&)]:min-w-48 p-[.3125rem]')
    ->add('rounded-lg shadow-xs')
    ->add('border border-zinc-200')
    ->add('bg-white')
    ;
?>

<nav <?php echo e($attributes->class($classes)); ?> popover="manual" data-flux-navmenu>
    <?php echo e($slot); ?>

</nav>
<?php /**PATH C:\Users\Fredy\Herd\fornuvi\resources\views/flux/navmenu/index.blade.php ENDPATH**/ ?>