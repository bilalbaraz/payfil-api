<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'bin_number',
        'card_type',
        'card_association',
        'card_family',
    ];

    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }
}
