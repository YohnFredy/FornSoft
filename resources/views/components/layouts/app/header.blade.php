@php
    // Array combinado para navbar (rutas y dropdowns en orden)
    $navbarItems = [
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
            'name' => 'Aliados',
            'icon' => 'shopping-bag',
            'route' => 'companies.index',
            'routeIs' => 'companies*',
        ],


        [
            'type' => 'dropdown',
            'name' => 'Oportunidad',
            'iconTrailing' => 'chevron-down',
            'expandable' => true,
            'items' => [
                [
                    'type' => 'route',
                    'name' => 'Plan de compensación',
                    'icon' => 'shopping-cart',
                    'route' => 'products.index',
                    'routeIs' => 'products.favorites',
                ],
                [
                    'type' => 'anchor',
                    'name' => 'Contáctanos',
                    'icon' => 'contact',
                    'route' => '#contacto',
                    'routeIs' => 'home',
                ],
            ],
        ],
        [
            'type' => 'route',
            'name' => 'Oficina',
            'icon' => 'building-office-2',
            'route' => 'dashboard',
            'routeIs' => 'dashboard',
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-white text-ink">
    <flux:header container class="border-b border-zinc-200 shadow-md shadow-primary/50">
        <flux:sidebar.toggle class="lg:hidden bg-danger/3! text-danger! hover:bg-secondary/5! hover:text-primary"
            icon="bars-3" inset="left" />

        <a href="{{ route('home') }}" class="ml-2 sm:ml-3 mr-5 lg:ml-0" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navbar class="-mb-px max-lg:hidden">
            {{-- Elementos combinados de la navbar --}}
            @foreach ($navbarItems as $item)
                @if ($item['type'] === 'route')
                    <flux:navbar.item icon="{{ $item['icon'] }}" :href="route($item['route'])"
                        :current="request()->routeIs($item['routeIs'])" wire:navigate>
                        {{ __($item['name']) }}
                    </flux:navbar.item>
                @elseif ($item['type'] === 'anchor')
                    <a href="{{ route($item['routeIs']) }}{{ $item['route'] }}">
                        <flux:navbar.item icon="{{ $item['icon'] }}" class="cursor-pointer">
                            {{ __($item['name']) }}
                        </flux:navbar.item>
                    </a>
                @elseif ($item['type'] === 'dropdown' && $item['expandable'])
                    <flux:dropdown class="max-lg:hidden">
                        <flux:navbar.item iconTrailing="{{ $item['iconTrailing'] }}">
                            {{ __($item['name']) }}
                        </flux:navbar.item>
                        <flux:navmenu>
                            @foreach ($item['items'] as $subItem)
                                @if ($subItem['type'] === 'route')
                                    <flux:navmenu.item 
                                        icon="{{ $subItem['icon'] }}" 
                                        :href="route($subItem['route'])"
                                        :current="request()->routeIs($subItem['routeIs'])"
                                        wire:navigate>
                                        {{ __($subItem['name']) }}
                                    </flux:navmenu.item>
                                @elseif ($subItem['type'] === 'anchor')
                                    <a href="{{ route($subItem['routeIs']) }}{{ $subItem['route'] }}">
                                        <flux:navmenu.item icon="{{ $subItem['icon'] }}" class="cursor-pointer">
                                            {{ __($subItem['name']) }}
                                        </flux:navmenu.item>
                                    </a>
                                @endif
                            @endforeach
                        </flux:navmenu>
                    </flux:dropdown>
                @endif
            @endforeach

            @can('admin.index')
                <flux:navbar.item icon="inbox" href="{{ route('admin.index') }}">Admin</flux:navbar.item>
            @endcan
        </flux:navbar>
        
        <flux:spacer />

        <!-- Desktop User Menu -->
        <flux:dropdown position="top" align="end">
            @auth
                <flux:profile class="cursor-pointer text-white" :initials="auth()->user()->initials()" />
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
                        <flux:menu.item href="{{ route('orders.index') }}" icon="arrow-path-rounded-square" wire:navigate>
                            Mis ordenes
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
            @else
                <flux:link class="flex text-primary" href="{{ route('login') }}" wire:navigate> 
                    <span class="flex items-center">
                        Login <flux:icon.arrow-right-start-on-rectangle class="ml-0" /> 
                    </span> 
                </flux:link>
            @endauth
        </flux:dropdown>

        <!-- cart -->
        @livewire('cart-icon')
    </flux:header>

    <!-- Mobile Menu -->
    <flux:sidebar stashable sticky class="lg:hidden border-r border-zinc-200 bg-zinc-50">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('home') }}" class="ml-1 flex items-center space-x-2" wire:navigate>
            <x-side-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group heading="Platform">
                @foreach ($navbarItems as $item)
                    @if ($item['type'] === 'route')
                        <flux:navlist.item icon="{{ $item['icon'] }}" :href="route($item['route'])"
                            :current="request()->routeIs($item['routeIs'])" wire:navigate>
                            {{ __($item['name']) }}
                        </flux:navlist.item>
                    @elseif ($item['type'] === 'anchor')
                        <a href="{{ route($item['routeIs']) }}{{ $item['route'] }}"
                            x-on:click="document.body.removeAttribute('data-show-stashed-sidebar')">
                            <flux:navlist.item icon="{{ $item['icon'] }}" class="cursor-pointer">
                                {{ __($item['name']) }}
                            </flux:navlist.item>
                        </a>
                    @elseif ($item['type'] === 'dropdown' && $item['expandable'])
                        <flux:navlist.group expandable :heading="$item['name']">
                            @foreach ($item['items'] as $subItem)
                                @if ($subItem['type'] === 'route')
                                    <flux:navlist.item 
                                        icon="{{ $subItem['icon'] }}" 
                                        :href="route($subItem['route'])"
                                        :current="request()->routeIs($subItem['routeIs'])" 
                                        wire:navigate>
                                        {{ __($subItem['name']) }}
                                    </flux:navlist.item>
                                @elseif ($subItem['type'] === 'anchor')
                                    <a href="{{ route($subItem['routeIs']) }}{{ $subItem['route'] }}"
                                        x-on:click="document.body.removeAttribute('data-show-stashed-sidebar')">
                                        <flux:navlist.item icon="{{ $subItem['icon'] }}" class="cursor-pointer">
                                            {{ __($subItem['name']) }}
                                        </flux:navlist.item>
                                    </a>
                                @endif
                            @endforeach
                        </flux:navlist.group>
                    @endif
                @endforeach
                @can('admin.index')
                    <flux:navlist.item icon="inbox" href="{{ route('admin.index') }}">Admin</flux:navlist.item>
                @endcan
            </flux:navlist.group>
        </flux:navlist>

        <flux:spacer />

    </flux:sidebar>

    {{ $slot }}

    <flux:footer>
        <footer class="bg-ink text-white rounded-md p-4 sm:p-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                <div>
                    <p class="text-xl text-white font-bold w-auto mb-6">fornuvi</p>
                    <p class="text-neutral-200 mb-6">Una compañía en el sector de salud y bienestar que ofrece
                        múltiples oportunidades financieras a través de un sistema global de asociación.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-neutral-200 hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-neutral-200 hover:text-white transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-neutral-200 hover:text-white transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-neutral-200 hover:text-white transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-6">Enlaces rápidos</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-neutral-200 hover:text-white transition">Inicio</a></li>
                        <li><a href="{{ route('products.index') }}" class="text-neutral-200 hover:text-white transition">Tienda</a></li>
                        <li><a href="{{ route('dashboard') }}" class="text-neutral-200 hover:text-white transition">Oficina</a></li>
                        <li><a href="{{ route('home') }}#contacto" class="text-neutral-200 hover:text-white transition">Contacto</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-semibold mb-6">Soporte</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-neutral-400 hover:text-white transition">Preguntas frecuentes</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-white transition">Términos y condiciones</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-white transition">Política de privacidad</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-white transition">Envíos y devoluciones</a></li>
                        <li><a href="#" class="text-neutral-400 hover:text-white transition">Centro de ayuda</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-6">Contacto</h3>
                    <ul class="space-y-3 text-neutral-200">
                        <li class="flex items-start">
                            <i class="fas fa-phone-alt mt-1 mr-3"></i>
                            <span>+57 (314) 520-78-14</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-envelope mt-1 mr-3"></i>
                            <span>info@fornuvi.com</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0">&copy; 2025 fornuvi. Todos los derechos reservados.</p>
                    <div class="flex space-x-6">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">Términos y condiciones</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">Política de privacidad</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition duration-300">Aviso legal</a>
                    </div>
                </div>
            </div>
        </footer>
    </flux:footer>

    @fluxScripts
</body>

</html>