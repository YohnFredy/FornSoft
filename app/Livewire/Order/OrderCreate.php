<?php

namespace App\Livewire\Order;

use App\Models\ActivationPt;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

class OrderCreate extends Component
{
    public $cart = [], $products = [], $productItems = [], $groupedItems = [], $activationPt;

    public $user_id, $tipo_usuario = 'inactive';

    public $shipping_cost = 0;

    // Variables organizadas para cálculos
    public $totals = [
        'subtotal' => 0,
        'descuento' => 0,
        'total_bruto_factura' => 0,
        'iva' => 0,
        'total_factura' => 0,
        'quantity' => 0,
        'total_pts' => 0,             
    ];

    public $countries = [], $departments = [], $cities = [];
    public $name = '', $phone = '', $dni = '', $email = '', $envio_type = 2;
    public $selectedCountry, $selectedDepartment, $selectedCity, $city = '';
    public $address = '', $additionalAddress = '', $terms = false;

    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'phone' => 'required|min:3',
            'dni' => 'required|min:3',
            'email' => 'required|email|min:3',
            'envio_type' => ['required', Rule::in([1, 2])],

            // Solo si el tipo de envío es a domicilio
            'selectedCountry' => Rule::requiredIf($this->envio_type == 2),
            'selectedDepartment' => Rule::requiredIf($this->envio_type == 2),
            'selectedCity' => Rule::requiredIf($this->envio_type == 2 && empty($this->city)),
            'city' => Rule::requiredIf($this->envio_type == 2 && empty($this->selectedCity)),
            'address' => Rule::requiredIf($this->envio_type == 2),
            'terms' => 'required|accepted',
        ];
    }

    public function mount()
    {

        $user = Auth::user();
        $this->cart = session('cart', []);
        $this->activationPt = ActivationPt::first();
        $this->countries = Country::all();

        $productIds = collect($this->cart)->pluck('id');
        $productsDB = Product::whereIn('id', $productIds)->get()->keyBy('id');

        // Mapeamos los productos del carrito con la info de la BD
        $this->products = collect($this->cart)->map(function ($item, $index) use ($productsDB) {
            $product = $productsDB[$item['id']] ?? null;

            if (!$product) return null;

            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'tax_percent' => $product->tax_percent,
                'pts_base' => $product->pts_base,
                'pts_bonus' => $product->pts_bonus,
                'pts_dist' => $product->pts_dist,
                'maximum_discount' => $product->maximum_discount,
                'quantity' => $item['quantity'],
                'index' => $index,
            ];
        })->filter();


        // Determinar tipo de usuario
        $totalPts = collect($this->products)->sum(fn($product) => $product['pts_base'] * $product['quantity']);
        $this->tipo_usuario = match (true) {
            $user?->activation?->is_active => 'active',
            $user?->activation && !$user->activation->is_active && $totalPts >= $this->activationPt->min_pts_monthly => 'renew_activation',
            !$user?->activation && $totalPts >= $this->activationPt->min_pts_first => 'new_affiliate',
            default => 'inactive',
        };


        // Construir items del carrito según tipo de usuario
        match ($this->tipo_usuario) {
            'new_affiliate' => $this->optimize($this->activationPt->min_pts_first),
            'renew_activation' => $this->optimize($this->activationPt->min_pts_monthly),
            'active' => $this->buildCartItems($this->products, useDistributorPts: true),
            default => $this->buildCartItems($this->products, useDistributorPts: false, discount: 0),
        };



        $this->calculateTotals();
    }

    /**
     * Construye los elementos del carrito a partir de los productos.
     */
    protected function buildCartItems($products, bool $useDistributorPts = true, ?int $discount = null)
    {
        $this->productItems = [];

        foreach ($products as $item) {
            $this->productItems[] = [
                'product_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'tax_percent' => $item['tax_percent'],
                'pts' => $useDistributorPts ? $item['pts_dist'] : $item['pts_base'],
                'discount_percent' => $discount ?? $item['maximum_discount'],
                'quantity' => $item['quantity'],
            ];
        }
    }

    /**
     * Calcula todos los totales de la compra de manera clara y organizada.
     */
    public function calculateTotals()
    {
        // Reiniciar totales
        $this->totals = array_fill_keys(array_keys($this->totals), 0);

        foreach ($this->productItems as &$item) {
            $subtotal = $item['price'] * $item['quantity'];
            $descuento =  ($subtotal * $item['discount_percent']) / 100;
            $total_bruto_factura = $subtotal - $descuento;
            $iva = ($total_bruto_factura * $item['tax_percent']) / 100;
            $total_factura =  $total_bruto_factura + $iva;
            $total_pts = $item['pts'] * $item['quantity'];

            $this->totals['subtotal'] += $subtotal;
            $this->totals['quantity'] += $item['quantity'];
            $this->totals['descuento'] +=  $descuento;
            $this->totals['total_bruto_factura'] +=  $total_bruto_factura;
            $this->totals['iva'] +=  $iva;
            $this->totals['total_factura'] += $total_factura;
            $this->totals['total_pts'] += $total_pts;
        }


        foreach ($this->productItems as &$item) {
            $subtotal = $item['price'] * $item['quantity'];
            $descuento =  ($subtotal * $item['discount_percent']) / 100;
        }
    }

    /**
     * Optimiza el carrito para cumplir con un mínimo de puntos requeridos.
     */
    public function optimize(float $minPts)
    {
        $productsUnit = [];
        $index = 0;

        foreach ($this->products as $product) {
            for ($i = 0; $i < $product['quantity']; $i++) {
                $productsUnit[] = [
                    'index' => $index++,
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'tax_percent' => $product['tax_percent'],
                    'pts_base' => $product['pts_base'],
                    'pts_bonus' => $product['pts_bonus'],
                    'pts_dist' => $product['pts_dist'],
                    'discount_percent' => $product['maximum_discount'],
                    'quantity' => 1,
                ];
            }
        }

        $bestCombination = $this->findBestPtsCombination($productsUnit, $minPts);
        $selectedIndexes = array_column($bestCombination, 'index');

        foreach ($productsUnit as $unit) {
            $isOptimized = in_array($unit['index'], $selectedIndexes);
            $pts = $isOptimized ? $unit['pts_base'] : $unit['pts_dist'];
            $discount = $isOptimized ? 0 : $unit['discount_percent'];

            $item = [
                'index' => $unit['index'],
                'product_id' => $unit['id'],
                'name' => $unit['name'],
                'price' => $unit['price'],
                'tax_percent' => $unit['tax_percent'],
                'pts' => $pts,
                'discount_percent' => $discount,
                'quantity' => 1,
            ];

            $key = md5(json_encode([
                'product_id' => $item['product_id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'tax_percent' => $item['tax_percent'],
                'pts' => $item['pts'],
                'discount_percent' => $item['discount_percent'],
            ]));

            if (isset($this->productItems[$key])) {
                $this->productItems[$key]['quantity'] += 1;
            } else {
                $this->productItems[$key] = $item;
            }
        }

        $this->calculateTotals();
    }

    /**
     * Encuentra la mejor combinación de productos que cumplan con los puntos mínimos.
     */
    protected function findBestPtsCombination(array $units, float $target): array
    {
        $bestCombo = [];
        $bestSum = INF;
        $tolerance = 0.0001;

        for ($i = 1; $i <= count($units); $i++) {
            $combinations = $this->getCombinations($units, $i);

            foreach ($combinations as $combo) {
                $sum = array_sum(array_column($combo, 'pts_base'));

                if ($sum + $tolerance >= $target && $sum < $bestSum) {
                    $bestSum = $sum;
                    $bestCombo = $combo;
                }
            }
        }

        return $bestCombo;
    }

    /**
     * Genera todas las combinaciones posibles de $length elementos.
     */
    private function getCombinations(array $items, int $length): array
    {
        if ($length === 0) return [[]];
        if (empty($items)) return [];

        $head = $items[0];
        $tail = array_slice($items, 1);

        $combosWithHead = array_map(
            fn($combo) => array_merge([$head], $combo),
            $this->getCombinations($tail, $length - 1)
        );

        $combosWithoutHead = $this->getCombinations($tail, $length);

        return array_merge($combosWithHead, $combosWithoutHead);
    }

    public function onEnvioTypeChange()
    {
        if ($this->envio_type == 1) {
            $this->reset([
                'selectedCountry',
                'departments',
                'selectedDepartment',
                'cities',
                'selectedCity',
                'city',
                'address',
                'additionalAddress',
            ]);
        }
    }

    public function updatedSelectedCountry($countryId)
    {
        $this->reset(['departments', 'selectedDepartment', 'cities', 'selectedCity', 'city']);
        $this->departments = Department::where('country_id', $countryId)->get();
        $this->calculateTotals();
    }

    public function updatedSelectedDepartment($departmentId)
    {
        $this->reset(['cities', 'selectedCity', 'city']);
        $this->cities = City::where('department_id', $departmentId)->get();
        $this->calculateTotals();
    }

    public function updatedSelectedCity($cityId)
    {
        $this->reset('city');
        $this->shipping_cost = City::find($cityId)->cost ?? 0;
        $this->calculateTotals();
    }

    public function create_order()
    {
        $this->user_id = Auth::user()->id;
        $this->validate();

        $publicOrderNumber = strtoupper(dechex(time()) . bin2hex(random_bytes(4)));

        $orderData = [
            'public_order_number' => $publicOrderNumber,
            'user_id' => $this->user_id,
            'contact' => $this->name,
            'phone' => $this->phone,
            'dni' => $this->dni,
            'email' => $this->email,
            'envio_type' => $this->envio_type,
            'subtotal' => $this->totals['subtotal'],
            'discount' => $this->totals['descuento'],
            'taxable_amount' => $this->totals['total_bruto_factura'],
            'tax_amount' => $this->totals['iva'],
            'shipping_cost' => $this->shipping_cost,
            'total' => $this->totals['total_factura'],
            'total_pts' => $this->totals['total_pts'],
        ];

        if ($this->envio_type == 2) {
            $orderData = array_merge($orderData, [
                'country_id' => $this->selectedCountry,
                'department_id' => $this->selectedDepartment,
                'city_id' => $this->selectedCity,
                'addCity' => $this->city,
                'address' => $this->address,
                'additional_address' => $this->additionalAddress,
            ]);
        }
        $order = Order::create($orderData);

        // Crear OrderItems con cálculos correctos
        foreach ($this->productItems as $item) {

            $subtotal = $item['price'] * $item['quantity'];
            $descuento =  ($subtotal * $item['discount_percent']) / 100;
            $total_bruto_factura = $subtotal - $descuento;
            $iva = ($total_bruto_factura * $item['tax_percent']) / 100;
            $total_pts = $item['pts'] * $item['quantity'];

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'name' => $item['name'],
                'unit_price' => $item['price'],
                'pts' => $item['pts'],
                'quantity' => $item['quantity'],
                'discount' =>  $descuento,
                'tax_percent' => $item['tax_percent'],
                'tax_amount' => $iva,
                'unit_sales_price' => $total_bruto_factura,
                'total' => 0,
                'totalPts' => $total_pts,
            ]);
        }

        session()->forget('cart');

        return redirect()->route('bold.checkout', $order);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.order.order-create');
    }
}
