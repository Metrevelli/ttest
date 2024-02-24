<?php

namespace App\Http\Rules;

use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;

class ProductIdRule implements Rule
{

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        return Product::where('product_id', $value)->exists();
    }

    /**
     * @inheritDoc
     */
    public function message()
    {
        return 'Invalid product_id';
    }
}
