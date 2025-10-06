<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{-- class="dark bg-white" --}}>

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white/95 text-ink">
    <flux:sidebar sticky stashable class=" shadow-lg bg-zinc-50  shadow-ink">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="" class="mr-5 flex items-center space-x-2" wire:navigate>
            <x-app-logo />
        </a>

      {{--  menu lateral --}}
        <div class=" space-y-1">
            <x-menu-item title="Dashboard" iconBlade="home" :routes="['admin.index']" />

            {{-- Grupo Expandible órdenes --}}
            <x-menu-item title="Órdenes" iconBlade="shopping-cart" :routes="['admin.orders.*']" :items="[
                ['name' => 'Tienda', 'route' => 'admin.orders.management', 'iconBlade' => 'shopping-cart'],
                ['name' => 'Soporte user', 'route' => 'admin.index', 'iconBlade' => 'document-text'],
            ]" />

            {{-- Grupo Expandible usuarios --}}
            <x-menu-item title="Usuarios" iconBlade="users" :routes="['admin.users.*', 'admin.roles.*']" :items="[
                ['name' => 'Usuarios', 'route' => 'admin.users.index', 'iconBlade' => 'user-group'],
                ['name' => 'Roles', 'route' => 'admin.roles.index', 'iconBlade' => 'user-plus'],
            ]" />

            <x-menu-item title="Negocios aliados" iconBlade='building-office-2' :routes="['admin.businesses.index']" />

            {{-- Grupo Expandible productos --}}
            <x-menu-item title="Productos" iconBlade="shopping-bag" :routes="['admin.categories.*', 'admin.brands.*', 'admin.products.*']" :items="[
                ['name' => 'Categorias', 'route' => 'admin.categories.index', 'iconBlade' => 'tag'],
                ['name' => 'Marcas', 'route' => 'admin.brands.index', 'iconBlade' => 'tag'],
                ['name' => 'Productos', 'route' => 'admin.products.index', 'iconBlade' => 'shopping-cart'],
            ]" />
        </div>

        <div class="space-y-1 mt-3">
             <h1 class="ml-3 text-sm font-bold text-ink">Pagina principal</h1>
             
               {{-- Grupo Expandible fornuvi --}}
            <x-menu-item title="Fornuvi" iconBlade="arrow-uturn-left" :routes="['home', 'products.index', 'dashboard']" :items="[
                ['name' => 'Inicio', 'route' => 'home', 'iconBlade' => 'home'],
                ['name' => 'Tienda', 'route' => 'products.index', 'iconBlade' => 'shopping-cart'],
                ['name' => 'Oficina', 'route' => 'dashboard', 'iconBlade' => 'building-office'],
            ]" />
        </div>

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
