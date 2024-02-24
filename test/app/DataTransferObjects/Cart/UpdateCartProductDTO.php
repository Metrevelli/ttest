<?php

namespace App\DataTransferObjects\Cart;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateCartProductDTO extends DataTransferObject
{
    public int $user_id;

    public int $product_id;

    public ?int $quantity;
}
