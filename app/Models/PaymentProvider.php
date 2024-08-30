<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentProvider extends Model
{
    use SoftDeletes;

    protected $fillable = ['title'];
}
