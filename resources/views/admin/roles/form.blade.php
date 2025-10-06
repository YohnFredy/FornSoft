@csrf

<div class="mb-4">
    <x-input type="text" label="Nombre del Rol:" for="name" name="name" autofocus autocomplete=""
            value="{{ old('name', $role->name?? '') }}" />
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Permisos</label>
    <div class="mt-2 space-y-4">
        @foreach($permissions as $group => $groupPermissions)
            <div class="border rounded-lg p-3 shadow-sm">
                <h4 class="font-semibold text-gray-600 capitalize">{{ $group }}</h4>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mt-2">
                    @foreach($groupPermissions as $permission)
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="permissions[]"
                                   value="{{ $permission->name }}"
                                   {{ in_array($permission->name, old('permissions', $rolePermissions ?? [])) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-primary focus:ring-primary">
                            <span class="text-sm text-gray-700">{{ $permission->description ?? $permission->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="flex justify-end">
    <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 bg-gray-200 rounded-lg text-sm mr-2">Cancelar</a>
    <flux:button type="submit" variant="primary">Guardar</flux:button>
</div>