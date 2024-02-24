<?php

namespace App\DataTransferObjects\Cart;

use Spatie\DataTransferObject\DataTransferObject;

class GetCartProductsDTO extends DataTransferObject
{
    public int $user_id;
}
