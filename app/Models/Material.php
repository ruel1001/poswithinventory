<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class material extends Model
{
    use HasFactory;
    protected $table='material';
    protected $primaryKey = 'material_id';

    protected $fillable =[
        'material_name',
'quantity',
'item',
'amount'
    ];
}
