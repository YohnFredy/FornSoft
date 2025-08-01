@php

    $groups = [
        [
            'heading' => 'Plataforma',
            'expandable' => false,
            'items' => [
                [
                    'name' => 'Dashboard',
                    'icon' => 'home',
                    'route' => 'admin.index',
                    'routeIs' => 'admin.index',
                ],
                [
                    'name' => 'Usuarios',
                    'icon' => 'user',
                    'route' => 'admin.users.index',
                    'routeIs' => 'admin.users.index',
                ],
                [
                    'name' => 'Categoria',
                    'icon' => 'tag',
                    'route' => 'admin.categories.index',
                    'routeIs' => 'admin.categories.*',
                ],
                [
                    'name' => 'Producto',
                    'icon' => 'shopping-cart',
                    'route' => 'admin.products.index',
                    'routeIs' => 'admin.products.*',
                ],
                [
                    'name' => 'Generar',
                    'icon' => 'calculator',
                    'route' => 'admin.products.index',
                    'routeIs' => 'admin.products.*',
                ],
            ],
        ],
        [
            'heading' => 'Mis Favoritos',
            'expandable' => true,
            'items' => [
                [
                    'name' => 'Producto',
                    'icon' => 'shopping-cart',
                    'route' => 'admin.products.index',
                    'routeIs' => 'admin.products.*',
                ],
                
            ],
        ],
        [
            'heading' => 'Tienda',
            'expandable' => false,
            'items' => [
                [
                    'type' => 'route',
                    'name' => 'Home',
                    'icon' => 'home',
                    'route' => 'home',
                    'routeIs' => 'home',
                ],
                [
                    'type' => 'route',
                    'name' => 'Productos',
                    'icon' => 'shopping-cart',
                    'route' => 'products.index',
                    'routeIs' => 'products*',
                ],
                [
                    'type' => 'route',
                    'name' => 'Oficina',
                    'icon' => 'building-office-2',
                    'route' => 'dashboard',
                    'routeIs' => 'dashboard',
                ],
            ],
        ],
    ];
@endphp


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{-- class="dark bg-white" --}}>

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white/95 text-ink">
    <flux:sidebar sticky stashable class=" shadow-lg bg-zinc-50  shadow-ink">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('admin.index') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            @foreach ($groups as $group)
                @php
                    $heading = $group['heading'];
                    $expandable = $group['expandable'] ?? false;
                    $items = $group['items'];
                @endphp

                @if ($expandable)
                    <flux:navlist.group expandable :heading="$heading">
                        @foreach ($items as $item)
                            <flux:navlist.item :icon="$item['icon']" :href="route($item['route'])"
                                :current="request()->routeIs($item['routeIs'])" wire:navigate>
                                {{ __($item['name']) }}
                            </flux:navlist.item>
                        @endforeach
                    </flux:navlist.group>
                @else
                    <flux:navlist.group :heading="$heading" class="grid">
                        @foreach ($items as $item)
                            <flux:navlist.item :icon="$item['icon']" :href="route($item['route'])"
                                :current="request()->routeIs($item['routeIs'])" wire:navigate>
                                {{ __($item['name']) }}
                            </flux:navlist.item>
                        @endforeach
                    </flux:navlist.group>
                @endif
            @endforeach
        </flux:navlist>

        <flux:spacer />

        <!-- Desktop User Menu -->
        <flux:dropdown position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>{{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden bg-white shadow-md shadow-ink">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>Settings</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts


</body>

</html>
