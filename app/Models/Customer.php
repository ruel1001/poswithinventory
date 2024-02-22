<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $table='customer';
    protected $primaryKey = 'account_number';

    protected $fillable =[
        'account_name',
'address',
'date_plan',
'amount_of_installation',
'due_date_month',
'foc',
'area',
'modem',
'connector',
'arrears',
'ficamp',
'others',
'messenger',
'contact_number',
'billing_month',
'plan_subscribed',
    ];
}