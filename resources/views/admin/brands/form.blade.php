@csrf

<div class=" grid grid-cols-2 gap-6">
    <div class=" col-span-2 md:col-span-1">
        <x-input type="text" label="Nombre:" for="name" name="name" autofocus autocomplete=""
            value="{{ old('name', $brand->name ?? '') }}" />
    </div>

    <div class="col-span-2 md:col-span-1">
        <x-select-l label="Activo:" for="is_active">
            <option value="1" {{ old('is_active', $brand->is_active ?? 0) == 1 ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ old('is_active', $brand->is_active ?? 0) == 0 ? 'selected' : '' }}>Inactivo
            </option>
        </x-select-l>
    </div>
</div>


<div class="flex items-center justify-end mt-4">
    <a class=" mr-4 text-xl font-bold text-palette-400 hover:text-opacity-80" href="{{ route('admin.brands.index') }}">
        <i class="fas fa-arrow-left"></i></a>
    <flux:button type="submit" variant="primary">
        Guardar
    </flux:button>
</div>
