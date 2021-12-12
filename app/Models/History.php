<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'nome', 'sku', 'operacao', 'quantidade', "totalestoque", 'created_at', 'updated_at'
    ];

    protected $hidden = [
    ];

}
