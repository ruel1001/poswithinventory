<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class expenses extends Model
{
    use HasFactory;

    protected $table='expenses';
    protected $primaryKey = 'expenses_id';
    
    protected $fillable =[
        'nature_of_expenses',
'amount'
    ];
}
