<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodMaster extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'method_name',
        'description',
        'account_number'
    ];
}
