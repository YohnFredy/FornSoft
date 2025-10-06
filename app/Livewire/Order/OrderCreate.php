<?php

namespace App\Livewire\Order;

use App\Models\ActivationPt;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\DocumentType;
use App\Models\Order;
use App\Models\OrderBillingData;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class OrderCreate extends Component
{
    public $cart = [], $shippingCountires = [], $products = [], $productItems = [], $groupedItems = [], $documentTypes = [];
    public $user, $tipo_usuario = 'inactive', $activationPt, $shipping_cost = 0, $shipping_type = 2, $terms = false;

    // ===== Facturación =====
    #[Validate]
    public $name, $document_type = 3, $document, $email, $phone, $address = '';
    #[Validate]
    public $countries = [], $departments = [], $cities = [];
    #[Validate]
    public $selectedCountry, $selectedDepartment, $selectedCity, $city = '';

    // ===== Datos del que recibe =====
    #[Validate]
    public  $shippingDifferent = false, $shipping_name, $shipping_document_type = 3, $shipping_document, $shipping_phone;
    #[Validate]
    public $shipping_countries = [], $shipping_departments = [], $shipping_cities = [];

    #[Validate]
    public $shipping_selectedCountry, $shipping_selectedDepartment, $shipping_selectedCity, $shipping_city = '';

    #[Validate()]
    public $shipping_address, $shipping_additional_address;

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

    protected function rules()
    {
        $rules = [

            //datos de facturar
            'name' => 'required|string|max:255',
            'document_type' => 'required',
            'document' => 'required|regex:/^[0-9]+$/|max:50',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:30',
            'selectedCountry' => 'required',
            'selectedDepartment' => 'required',
            'selectedCity' => Rule::requiredIf(empty($this->city)),
            'city' =>  Rule::requiredIf(empty($this->selectedCity)),
            'address' => 'required|max:255',

            'shipping_selectedCountry' => Rule::requiredIf($this->shipping_type == 2),
            'shipping_selectedDepartment' => Rule::requiredIf($this->shipping_type == 2),
            'shipping_selectedCity' => Rule::requiredIf($this->shipping_type == 2 && empty($this->shipping_city)),
            'shipping_city' => Rule::requiredIf($this->shipping_type == 2 && empty($this->shipping_selectedCity)),
            'shipping_address' => Rule::requiredIf($this->shipping_type == 2),
            'shipping_additional_address' => 'nullable|string|max:255',

            'shipping_type' => ['required', Rule::in(['1', '2'])],
            'terms' => 'required|accepted',
        ];

        if ($this->shippingDifferent == true) {
            $rules = array_merge($rules, [
                'shipping_name' => 'required|string|max:255',
                'shipping_document_type' => 'required',
                'shipping_document' => 'required|regex:/^[0-9]+$/|max:50',
                'shipping_phone' => 'required|string|max:30',
            ]);
        }

        return $rules;
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->cart = session('cart', []);
        $this->activationPt = ActivationPt::first();
        $this->countries = Country::all();
        $this->shippingCountires =  $this->countries;
        $this->documentTypes = DocumentType::where('is_active', '>=', 1)->get();

        $this->loadData();

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
            $this->user?->activation?->is_active => 'active',
            $this->user?->activation && !$this->user->activation->is_active && $totalPts >= $this->activationPt->min_pts_monthly => 'renew_activation',
            !$this->user?->activation && $totalPts >= $this->activationPt->min_pts_first => 'new_affiliate',
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

    public function loadData()
    {
        $this->name = ucwords(strtolower($this->user->name . ' ' . $this->user->last_name));
        $this->document_type = 3;
        $this->document = $this->user->dni;
        $this->email = $this->user->email;
        $this->phone = $this->user->userData->phone;

        $this->selectedCountry = $this->user->userData->country_id;
        $this->departments = Department::where('country_id', $this->selectedCountry)->get();
        $this->selectedDepartment  = $this->user->userData->department_id;
        $this->cities = City::where('department_id', $this->selectedDepartment)->get();
        $this->selectedCity = $this->user->userData->city_id;
        $this->city  = $this->user->userData->city;
        $this->address = $this->user->userData->address;

        $this->shipping_selectedCountry =  $this->selectedCountry;
        $this->shipping_departments =  $this->departments;
        $this->shipping_selectedDepartment  = $this->selectedDepartment;
        $this->shipping_cities = $this->cities;
        $this->shipping_selectedCity =  $this->selectedCity;
        $this->shipping_city  =   $this->city;
        $this->shipping_address =  $this->address;
    }


    //Construye los elementos del carrito a partir de los productos.
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

    //Calcula todos los totales de la compra de manera clara y organizada.
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

    // Optimiza el carrito para cumplir con un mínimo de puntos requeridos.
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

    //Encuentra la mejor combinación de productos que cumplan con los puntos mínimos.
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

    //Genera todas las combinaciones posibles de $length elementos.
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

    public function updatedShippingSelectedCountry($shippingCountryId)
    {
        $this->reset(['shipping_departments', 'shipping_selectedDepartment', 'shipping_cities', 'shipping_selectedCity', 'shipping_city']);
        $this->shipping_departments = Department::where('country_id', $shippingCountryId)->get();
    }

    public function updatedShippingSelectedDepartment($shippingDepartmentId)
    {
        $this->reset(['shipping_cities', 'shipping_selectedCity', 'shipping_city', 'shipping_cost']);
        $this->shipping_cities = City::where('department_id', $shippingDepartmentId)->get();
    }

    public function updatedShippingSelectedCity($shippingCityId)
    {
        $this->reset('shipping_city');
        $this->shipping_cost = City::find($shippingCityId)->cost ?? 0;
    }

    public function updatedSelectedCountry($countryId)
    {
        $this->reset(['departments', 'selectedDepartment', 'cities', 'selectedCity', 'city']);
        $this->departments = Department::where('country_id', $countryId)->get();
    }

    public function updatedSelectedDepartment($departmentId)
    {
        $this->reset(['cities', 'selectedCity', 'city']);
        $this->cities = City::where('department_id', $departmentId)->get();
    }

    public function updatedSelectedCity($cityId)
    {
        $this->reset('city');
    }

    public function create_order()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $publicOrderNumber = strtoupper(dechex(time()) . bin2hex(random_bytes(4)));

                $orderData = [
                    'public_order_number' => $publicOrderNumber,
                    'user_id' => $this->user->id,
                    'status' => Order::STATUS_SALE_PENDING,
                    'shipping_type' => $this->shipping_type,
                    // === Totales ===
                    'subtotal' => $this->totals['subtotal'],
                    'discount' => $this->totals['descuento'],
                    'taxable_amount' => $this->totals['total_bruto_factura'],
                    'tax_amount' => $this->totals['iva'],
                    'shipping_cost' => $this->shipping_cost,
                    'total' => $this->totals['total_factura'] + $this->shipping_cost,
                    'total_pts' => $this->totals['total_pts'],
                ];

                if ($this->shipping_type == 2) {
                    $orderData = array_merge($orderData, [
                        'shipping_country_id' => $this->shipping_selectedCountry,
                        'shipping_department_id' => $this->shipping_selectedDepartment,
                        'shipping_city_id' => $this->shipping_selectedCity,
                        'shipping_addCity' => $this->shipping_city,
                        'shipping_address' => $this->shipping_address,
                        'shipping_additional_address' => $this->shipping_additional_address,
                    ]);
                }

                if ($this->shippingDifferent == true) {
                    $orderData = array_merge($orderData, [
                        'shipping_name' => $this->shipping_name,
                        'document_type_id' => $this->shipping_document_type,
                        'shipping_document' => $this->shipping_document,
                        'shipping_phone' => $this->shipping_phone,
                    ]);
                }

                $order = Order::create($orderData);

                $orderBillingData = [
                    'order_id' => $order->id,
                    'name' => $this->name,
                    'document_type_id' => $this->document_type,
                    'document' => $this->document,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'address' => $this->address,
                    'country_id' => $this->selectedCountry,
                    'department_id' => $this->selectedDepartment,
                    'city_id' => $this->selectedCity,
                    'addCity' => $this->city,
                ];

                OrderBillingData::create($orderBillingData);

                foreach ($this->productItems as $item) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $descuento = ($subtotal * $item['discount_percent']) / 100;
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
                        'discount' => $descuento,
                        'tax_percent' => $item['tax_percent'],
                        'tax_amount' => $iva,
                        'unit_sales_price' => $total_bruto_factura,
                        'totalPts' => $total_pts,
                    ]);
                }

                session()->forget('cart');

                return redirect()->route('bold.checkout', $order);
            });
        } catch (\Exception $e) {
            // Aquí puedes manejar el error, por ejemplo, registrarlo o mostrar un mensaje al usuario.
            Log::error('Error al crear la orden: ' . $e->getMessage());
            // Opcionalmente, puedes redirigir al usuario a una página de error.
            // return redirect()->route('error.page')->with('error', 'Ocurrió un error al procesar tu orden.');
        }
    }

    public function render()
    {
        return view('livewire.order.order-create');
    }
}
