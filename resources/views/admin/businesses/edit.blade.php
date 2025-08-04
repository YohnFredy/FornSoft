<x-layouts.admin>
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-extrabold text-primary tracking-tight">
            Editar Negocio
        </h1>
        <a href="{{ route('admin.businesses.index') }}">
            <flux:button icon="arrow-long-left" type="button">
                Volver al listado
            </flux:button>
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-lg shadow-ink border border-neutral-300 rounded-lg">
        <div class="p-6 sm:p-8 bg-white">
           @livewire('admin.businesses.business-form', ['businessData' => $businessData]) 
            </form>
        </div>
    </div>
</x-layouts.admin>