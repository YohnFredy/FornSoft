<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'public_order_number',
        'user_id',
        'status',
        'payment_method',
        'shipping_type',

        // Datos del receptor
        'shipping_name',
        'document_type_id',
        'shipping_document',
        'shipping_phone',

        // Valores monetarios
        'subtotal',
        'discount',
        'taxable_amount',
        'tax_amount',
        'shipping_cost',
        'total',
        'total_pts',

        // Envío
        'shipping_country_id',
        'shipping_department_id',
        'shipping_city_id',
        'shipping_addCity',
        'shipping_address',
        'shipping_additional_address',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'taxable_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total' => 'decimal:2',
        'total_pts' => 'decimal:2',
        'status' => 'integer',
    ];

    const STATUS_SALE_PENDING = 1;
    const STATUS_SALE_APPROVED = 2;
    const STATUS_PTS_GENERATED = 3;
    const STATUS_SENT = 4;
    const STATUS_DELIVERED = 5;
    const STATUS_SALE_REJECTED = 6;
    const STATUS_VOIDED  = 7;
    const STATUS_VOID_REJECTED  = 8;

    const SHIPPING_TYPE_STORE = 1;
    const SHIPPING_TYPE_DELIVERY = 2;

    public function getRouteKeyName()
    {
        return 'public_order_number';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shippingCountry()
    {
        return $this->belongsTo(Country::class);
    }

    public function shippingDepartment()
    {
        return $this->belongsTo(Department::class);
    }

    public function shippingCity()
    {
        return $this->belongsTo(City::class);
    }


    // Datos de facturación (relación 1:1 con order_billing_data)
    public function billingData()
    {
        return $this->hasOne(OrderBillingData::class, 'order_id');
    }

    // Método para actualizar el estado de la orden
    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }

    public function updateStatusAndPayment($status, $paymentId = null)
    {
        $this->status = $status;
        $this->payment_id = $paymentId;

        $this->save();
    }

    public function paymentWebhook()
    {
        return $this->hasOne(PaymentWebhook::class, 'reference', 'public_order_number');
    }
}
