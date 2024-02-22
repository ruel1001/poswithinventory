<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maintenance extends Model
{
    use HasFactory;
    protected $table='maintenance';
    protected $primaryKey = 'maintenance_id';

    protected $fillable =[
        'account_number',
        'account_name',
'address',
'account_id',
'area',
'material_used',
'material_quantity_used',
'material_id',
'nature_of_repair'
    ];
}
