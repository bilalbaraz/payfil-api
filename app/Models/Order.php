<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_id',
        'payment_provider_id',
        'order_number',
        'shipping_address',
        'billing_address',
        'quantity',
        'unit_price',
        'currency',
    ];

    protected $casts = ['unit_price' => 'float'];

    protected $appends = ['total_amount'];

    public function getTotalAmountAttribute(): float
    {
        return $this->attributes['quantity'] * $this->attributes['unit_price'];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function paymentProvider(): BelongsTo
    {
        return $this->belongsTo(PaymentProvider::class);
    }

    public function transaction(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }
}
