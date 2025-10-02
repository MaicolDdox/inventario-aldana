<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'tool_id',
        'product_id'
    ];

    public function tool():BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
