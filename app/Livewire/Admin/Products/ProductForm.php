<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;


class ProductForm extends Component
{
    use WithFileUploads;

    public ?Product $product;

    public $name = '', $description = '', $price = 0, $final_price = 0, $tax_percent = 19, $commission_income = 0, $pts_base = 0, $pts_bonus = 0, $pts_dist = 0, $maximum_discount = 0, $specifications = '', $information = '', $is_physical = 1, $stock = 0, $allow_backorder = 1, $category_id = '', $brand_id = null, $is_active = 1;


    public $newImages = [],  $images = [];
    public $isEditMode = false, $suggestedPts;
    public $category, $selectedLevels = [],  $categoryLevels = [], $hasChildCategories = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'numeric|min:0|max:9999999.99',
            'tax_percent' => 'numeric|min:0|max:99',
            'commission_income' => 'numeric|min:0|max:999999.99',
            'pts_base' => 'numeric|min:0|max:999999.99',
            'pts_bonus' => 'numeric|min:0|max:999999.99',
            'pts_dist' => 'numeric|min:0|max:999999.99',
            'maximum_discount' => 'integer|min:0|max:100',
            'specifications' => 'nullable|string',
            'information' => 'nullable|string',
            'is_physical' => 'required|boolean',
            'stock' => 'nullable|required_if:is_physical,true|integer|min:0',
            'allow_backorder' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'is_active' => 'required|boolean',
            'newImages.*' => 'nullable|image|max:2048',
            'hasChildCategories' => 'required|boolean|accepted',
        ];
    }

    // Método para asegurar que los valores vacíos se convierten en 0
    private function getValidValue($value)
    {
        return $value === '' ? 0 : $value;
    }

    public function updatedFinalPrice($valor)
    {
        // Aseguramos que los valores sean válidos
        $this->final_price = $this->getValidValue($valor);
        $tax_percent = $this->getValidValue($this->tax_percent);

        // Cálculo de precio
        $this->price = round($this->final_price / (1 + ($tax_percent / 100)), 2);
        $this->final_price = round(($this->price * $tax_percent / 100) + $this->price, 2);
    }

    public function updatedTaxPercent($valor)
    {
        // Aseguramos que los valores sean válidos
        $valor = $this->getValidValue($valor);
        $this->final_price = $this->getValidValue($this->final_price);
        

        // Cálculo de precio
        $this->price = round($this->final_price / (1 + ($valor / 100)), 2);
        $this->final_price = round(($this->price *  $valor / 100) + $this->price, 2);
    }

    public function updatedPrice($valor)
    {
        // Aseguramos que los valores sean válidos
        $this->price = $this->getValidValue($valor);
        $tax_percent = $this->getValidValue($this->tax_percent);


        // Cálculo de precio

        $this->final_price = round(($this->price *  $tax_percent / 100) + $this->price, 2);
    }


    public function mount(Product $product)
    {
        $this->product = $product ?? new Product();

        // Cargar las categorías de nivel raíz (sin padre)
        $this->categoryLevels[0] = Category::whereNull('parent_id')->get();

        if ($this->product->exists) {
            $this->loadProductData();
            $this->loadCategoryData();
            $this->isEditMode = true;

            $this->final_price = round($this->final_price, 2);
        } else {
            $this->maximum_discount = 0;
        }
    }

    public function loadProductData()
    {
        $this->fill($this->product->toArray());
        $this->images = $this->product->images->pluck('path', 'id')->toArray();
    }

    public function loadCategoryData()
    {
        $this->category = Category::find($this->product->category_id);

        // Cargar la cadena de categorías padres desde la categoría principal
        $parentChain = collect();
        $currentCategory = $this->category;

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

        // Si la categoría tiene un padre, asignar su ID
        if ($this->category->parent_id) {
            $this->selectedLevels[$level] = $this->category->parent_id;
            $this->category_id = $this->category->parent_id;
        }

        $this->hasChildCategories = true;
    }

    #[On('calculadora-financiera')]
    public function updateDatos($precioPublico, $ivaPorcentaje, $pts_base, $bonoInicioPorcentaje, $pts_bono, $descuentoPorcentaje, $pts_dist)
    {

        $this->final_price = $precioPublico;
        $this->tax_percent = $ivaPorcentaje;
        $this->commission_income = $bonoInicioPorcentaje;
        $this->pts_base = $pts_base;
        $this->pts_bonus = $pts_bono;
        $this->pts_dist = $pts_dist;
        $this->maximum_discount = $descuentoPorcentaje;

        $this->updatedFinalPrice($this->final_price);
    }


    public function updatedSelectedLevels($value, $key)
    {
        // Limpiar todos los niveles posteriores al modificado
        $this->clearLevelsFrom($key + 1);

        // Actualizar el parent_id al nivel seleccionado actual
        $this->category_id = $value;

        // Cargar las subcategorías del nivel seleccionado
        $subcategories = Category::where('parent_id', $value)->get();

        if ($subcategories->isNotEmpty()) {
            $this->categoryLevels[$key + 1] = $subcategories;
            $this->hasChildCategories = false;
        } else {
            // Si no hay subcategorías, limpiar los niveles siguientes
            unset($this->categoryLevels[$key + 1]);
            $this->hasChildCategories = true;
        }
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

    public function save()
    {

        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($this->name);

        $product = Product::create($validatedData);
        $this->saveImages($product);

        session()->flash('success', 'Producto creado exitosamente.');
        return redirect()->route('admin.products.index');
    }


    public function update()
    {
        $validatedData = $this->validate();
        $validatedData['slug'] = Str::slug($this->name);

        $this->product->update($validatedData);
        $this->saveImages($this->product);

        session()->flash('success', 'Producto actualizado exitosamente.');
        return redirect()->route('admin.products.index');
    }

    public function removeMedia($mediaId)
    {

        $image = Image::find($mediaId);

        if (!$image) {
            return; // La imagen no existe
        }

        // Eliminar el archivo físico
        Storage::disk('public')->delete($image->path);

        // Eliminar de la base de datos
        $image->delete();

        // Actualizar el estado del componente para que la vista refleje el cambio al instante
        if (isset($this->images[$mediaId])) {
            unset($this->images[$mediaId]);
        }
    }

   /*  public function removeImage($path)
    {
        if (!in_array($path, $this->images)) return;

        $this->images = array_filter($this->images, fn($image) => $image !== $path);
        Storage::delete('public/' . $path);
        $this->product->images()->where('path', $path)->delete();
    } */

    protected function saveImages($product)
    {
        foreach ($this->newImages as $image) {
            $path = $image->storeAs(
                'products',
                Str::slug($this->name) . '-' . uniqid() . '.' . $image->getClientOriginalExtension(),
                'public'
            );
            $product->images()->create(['path' => $path]);
        }
    }

    public function render()
    {
        return view('livewire.admin.products.product-form', [
            'brands' => Brand::orderBy('name')->get()

        ]);
    }
}
