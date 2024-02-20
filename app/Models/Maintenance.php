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
        'account_name',
'address',
'account_id',
'area',
'material_used',
'nature_of_repair'
    ];
}
