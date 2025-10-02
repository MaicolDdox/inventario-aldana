<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'estado',
        'url_img',
        'estado',
        'stock'
    ];

    public function inventory(): HasMany 
    {
        return $this->hasMany(Inventory::class);
    }
}
