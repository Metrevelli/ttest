<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getProductPrice()
    {
        return $this->products->first()->getPrice();
    }
    public function getProductQuantity(): int
    {
        return $this->quantity;
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'product_id','product_id');
    }
}
