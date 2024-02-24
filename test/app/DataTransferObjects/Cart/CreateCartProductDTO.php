<?php

namespace App\DataTransferObjects\Cart;

use Spatie\DataTransferObject\DataTransferObject;

class CreateCartProductDTO extends DataTransferObject
{
    public int $user_id;

    public int $product_id;
}
