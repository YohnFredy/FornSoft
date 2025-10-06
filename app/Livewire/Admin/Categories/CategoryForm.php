<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Nullable;

class CategoryForm extends Component
{

    public ?Category $category;

    public $name;
    public $slug;
    public $is_active = true;
    public $is_final = false;

    // Array para almacenar los niveles seleccionados
    public $selectedLevels = [];
    // Array para almacenar las categorías disponibles en cada nivel
    public $categoryLevels = [];

    public $parent_id = null, $isEditMode = false;

    protected function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($this->category?->id),
            ],

            'parent_id' => 'nullable',
            'is_final' => 'required|boolean',
            'is_active' => 'required|boolean',
        ];
    }

    public function mount(Category $category)
    {
        $this->category = $category ?? new Category();

        // Inicializar el primer nivel con categorías raíz
        $this->categoryLevels[0] = Category::whereNull('parent_id')->get();

        if ($this->category->exists) {

            $this->authorize('admin.categories.edit');
            $this->loadCategoryData();

            $this->isEditMode = true;
        } else {
            $this->authorize('admin.categories.create');
        }
    }

    public function loadCategoryData()
    {
        $this->fill($this->category->toArray());

        // Cargar la cadena de categorías padres
        $parentChain = collect();
        $currentCategory = $this->category->parent;

        while ($currentCategory) {
            $parentChain->prepend($currentCategory);
            $currentCategory = $currentCategory->parent;
        }

        // Configurar los niveles seleccionados y cargar sus subcategorías
        $level = 0;
        foreach ($parentChain as $parent) {
            $this->selectedLevels[$level] = $parent->id;
            $this->categoryLevels[$level + 1] = Category::where('parent_id', $parent->id)->get();
            $level++;
        }

        if ($this->category->parent_id) {
            $this->selectedLevels[$level] = $this->category->parent_id;
            $this->parent_id = $this->category->parent_id;
        }
    }

    public function updatedSelectedLevels($value, $key)
    {
        // Si el valor es vacío, limpiar este nivel y todos los siguientes
        if (empty($value)) {
            $this->clearLevelsFrom($key);
            $this->parent_id = $key > 0 ? $this->selectedLevels[$key - 1] : null;
            return;
        }

        // Limpiar todos los niveles posteriores al modificado
        $this->clearLevelsFrom($key + 1);

        // Actualizar el parent_id al nivel seleccionado actual
        $this->parent_id = $value;

        // Cargar las subcategorías del nivel seleccionado
        $subcategories = Category::where('parent_id', $value)->get();

        if ($subcategories->isNotEmpty()) {
            $this->categoryLevels[$key + 1] = $subcategories;
        } else {
            // Si no hay subcategorías, limpiar los niveles siguientes
            unset($this->categoryLevels[$key + 1]);
        }
    }


    public function save()
    {
        $validatedData = $this->validate();

        Category::create($validatedData);

        session()->flash('success', 'Categoria creada exitosamente.');
        return redirect()->route('admin.categories.index');
    }

    public function update()
    {
        $validatedData = $this->validate();

        $this->category->update($validatedData);

        session()->flash('success', 'Categoira actualizado exitosamente.');
        return redirect()->route('admin.categories.index');
    }

    protected function clearLevelsFrom($startLevel)
    {
        foreach ($this->selectedLevels as $level => $selectedId) {
            if ($level >= $startLevel) {
                unset($this->selectedLevels[$level]);
                unset($this->categoryLevels[$level + 1]);
            }
        }
    }

    #[Layout('components.layouts.admin')]
    public function render()
    {
        return view('livewire.admin.categories.category-form');
    }
}
