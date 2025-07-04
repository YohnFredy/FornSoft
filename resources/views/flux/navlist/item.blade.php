@aware([ 'variant' ])

@props([
    'iconVariant' => 'outline',
    'iconTrailing' => null,
    'badgeColor' => null,
    'variant' => null,
    'iconDot' => null,
    'accent' => true,
    'badge' => null,
    'icon' => null,
])

@php
// Button should be a square if it has no text contents...
$square ??= $slot->isEmpty();

// Size-up icons in square/icon-only buttons...
$iconClasses = Flux::classes($square ? 'size-5!' : 'size-4!');

$classes = Flux::classes()
    ->add('h-10 lg:h-8 relative flex items-center gap-3 rounded-lg')
    ->add($square ? 'px-2.5!' : '')
    ->add('py-0 text-left w-full px-3 my-px')
    ->add('text-zinc-500')
    ->add(match ($variant) {
        'outline' => match ($accent) {
            true => [
                'data-current:text-secondary hover:data-current:text-secondary',
                'data-current:bg-white data-current:border data-current:border-zinc-200',
                'hover:text-zinc-800 hover:bg-zinc-800/5 ',
                'border border-transparent',
            ],
            false => [
                'data-current:text-zinc-800 data-current:border-zinc-200',
                'data-current:bg-white data-current:border data-current:border-zinc-200 data-current:shadow-xs',
                'hover:text-zinc-800',
            ],
        },
        default => match ($accent) {
            true => [
                'data-current:text-primary hover:data-current:text-secondary',
                'data-current:bg-primary/5',
                'hover:text-primary hover:bg-secondary/5',
            ],
            false => [
                'data-current:text-zinc-800',
                'data-current:bg-zinc-800/[4%]',
                'hover:text-zinc-800 hover:bg-zinc-800/[4%]',
            ],
        },
    })
    ;
@endphp

<flux:button-or-link :attributes="$attributes->class($classes)" data-flux-navlist-item>
    <?php if ($icon): ?>
        <div class="relative">
            <?php if (is_string($icon) && $icon !== ''): ?>
                <flux:icon :$icon :variant="$iconVariant" class="{!! $iconClasses !!}" />
            <?php else: ?>
                {{ $icon }}
            <?php endif; ?>

            <?php if ($iconDot): ?>
                <div class="absolute top-[-2px] right-[-2px]">
                    <div class="size-[6px] rounded-full bg-zinc-500"></div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ($slot->isNotEmpty()): ?>
        <div class="flex-1 text-sm font-medium leading-none whitespace-nowrap [[data-nav-footer]_&]:hidden [[data-nav-sidebar]_[data-nav-footer]_&]:block" data-content>{{ $slot }}</div>
    <?php endif; ?>

    <?php if (is_string($iconTrailing) && $iconTrailing !== ''): ?>
        <flux:icon :icon="$iconTrailing" :variant="$iconVariant" class="size-4!" />
    <?php elseif ($iconTrailing): ?>
        {{ $iconTrailing }}
    <?php endif; ?>

    <?php if ($badge): ?>
        <flux:navlist.badge :color="$badgeColor">{{ $badge }}</flux:navlist.badge>
    <?php endif; ?>
</flux:button-or-link>
