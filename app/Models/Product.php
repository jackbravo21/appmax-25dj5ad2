<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'nome', 'sku', 'qtd', 'created_at', 'updated_at'
    ];

    protected $hidden = [
    ];

}
