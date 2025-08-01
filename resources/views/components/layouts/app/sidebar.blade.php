@php

    $groups = [
        'platform' => [
            [
                'name' => 'Dashboard',
                'icon' => 'home',
                'route' => 'dashboard',
            ],
            [
                'name' => 'Comisiones',
                'icon' => 'currency-dollar',
                'route' => 'commissions',
            ],
            [
                'name' => 'Binario',
                'icon' => 'network',
                'route' => 'binary-tree',
            ],
            [
                'name' => 'Unilevel',
                'icon' => 'network',
                'route' => 'unilevel-tree',
            ],
            [
                'name' => 'Agregar Factura',
                'icon' => 'clipboard-document-list',
                'route' => 'add-invoice',
            ],
        ],

        'Tienda' => [
            [
                'name' => 'Home',
                'icon' => 'home',
                'route' => 'home',
            ],
        ],
    ];

@endphp


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{-- class="dark bg-white" --}}>

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white/95 dark:bg-white/95 text-ink">
    <flux:sidebar sticky stashable class=" shadow-lg bg-zinc-50  shadow-ink">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
            <x-side-app-logo />
        </a>

        <flux:navlist variant="outline">
            @foreach ($groups as $group => $links)
                <flux:navlist.group :heading="$group" class="grid">
                    @foreach ($links as $link)
                        <flux:navlist.item :icon="$link['icon']" :href="route($link['route'])"
                            :current="request()->routeIs($link['route'])" wire:navigate>
                            {{ __($link['name']) }}
                        </flux:navlist.item>
                    @endforeach
                </flux:navlist.group>
            @endforeach
        </flux:navlist>

        <flux:spacer />

        <!-- Desktop User Menu -->
        <flux:dropdown position="bottom" align="start">
            <flux:profile class="text-white" :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-premium text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-left text-sm leading-tight text-ink">
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
        <flux:sidebar.toggle class="lg:hidden bg-danger/3!  text-danger! hover:bg-secondary/5! hover:text-primary"
            icon="bars-3" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile class="text-white" :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-premium text-white">
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
    </flux:header>

    {{ $slot }}

    @fluxScripts


</body>

</html>
