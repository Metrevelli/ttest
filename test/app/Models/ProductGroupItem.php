<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductGroupItem extends Model
{
    protected $primaryKey = 'item_id';

    public function group(): BelongsTo
    {
        return $this->belongsTo(UserProductGroup::class);
    }

    public function product(): HasOne
    {
        return $this->HasOne(Product::class,'product_id');
    }
}
