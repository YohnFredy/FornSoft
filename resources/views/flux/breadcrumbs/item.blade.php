@props([
    'separator' => 'chevron-right',
    'iconVariant' => 'mini',
    'icon' => null,
    'href' => null,
])

@php
$classes = Flux::classes()
    ->add('flex items-center')
    ->add('text-sm font-medium')
    ->add('group/breadcrumb')
    ;

$linkClasses = Flux::classes()
    ->add('text-primary')
    ->add('hover:underline decoration-primary/20 underline-offset-4');

$staticTextClasses = Flux::classes()
    ->add('text-secondary')
    ;

$separatorClasses = Flux::classes()
    ->add('mx-1 text-zinc-300')
    ->add('group-last/breadcrumb:hidden')
    ;

$iconClasses = Flux::classes()
    // When using the outline icon variant, we need to size it down to match the default icon sizes...
    ->add($iconVariant === 'outline' ? 'size-5' : '')
    ;

[ $styleAttributes, $attributes ] = Flux::splitAttributes($attributes);
@endphp

<div {{ $styleAttributes->class($classes) }} data-flux-breadcrumbs-item>
    <?php if ($href): ?>
        <a {{ $attributes->class($linkClasses) }} href="{{ $href }}">
            <?php if ($icon): ?>
                <flux:icon :$icon :variant="$iconVariant" class="{{ $iconClasses }}" />
            <?php else: ?>
                {{ $slot }}
            <?php endif; ?>
        </a>
    <?php else: ?>
        <div {{ $attributes->class($staticTextClasses) }}>
            <?php if ($icon): ?>
                <flux:icon :$icon :variant="$iconVariant" class="{{ $iconClasses }}" />
            <?php else: ?>
                {{ $slot }}
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <flux:icon :icon="$separator" variant="mini" class="{{ $separatorClasses }}" />
</div>
