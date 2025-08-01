<x-layouts.admin>
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-extrabold text-primary tracking-tight">
            Editar usuario
        </h1>
        <a href="{{ route('admin.users.index') }}">
            <flux:button icon="arrow-long-left" type="button">
                Volver al listado
            </flux:button>
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-lg shadow-ink border border-neutral-300 rounded-lg">
        <div class="p-6 sm:p-8 bg-white">
            @livewire('admin.users.user-form', ['user' => $user, 'isEditMode' => 'true'], key($user->id))
        </div>
    </div>
</x-layouts.admin>