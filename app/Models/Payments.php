<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    use HasFactory;

    protected $table='payments';
    protected $primaryKey = 'payment_id';

    protected $fillable =[
        'uuid',
        'account_number',
        'account_name',
        'account_balance',
        'arrears_month',
        'amount_paid',
        'collectors_name',
        'billing_month'
    ];
}
