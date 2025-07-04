@props([
    'external' => null,
    'accent' => true,
    'variant' => null,
])

@php
$classes = Flux::classes()
    ->add('inline font-medium')
    ->add('underline-offset-[6px] hover:decoration-current')
    ->add(match ($variant) {
        'ghost' => 'no-underline hover:underline',
        'subtle' => 'no-underline',
        default => 'underline',
    })
    ->add(match ($variant) {
        'subtle' => 'text-zinc-500 hover:text-zinc-800 ',
        default => match ($accent) {
            true => 'text-secondary dark:text-secondary decoration-[color-mix(in_oklab,var(--color-accent-content),transparent_80%)] ',
            false => 'text-zinc-800 decoration-zinc-800/20',
        },
    })
    ;
@endphp
{{-- NOTE: It's important that this file has NO newline at the end of the file. --}}
<a {{ $attributes->class($classes) }} data-flux-link <?php if ($external) : ?>target="_blank"<?php endif; ?>>{{ $slot }}</a>