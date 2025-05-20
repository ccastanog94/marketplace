<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'products'; // <- nombre real de la tabla
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
    ];
}
