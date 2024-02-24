<?php

namespace App\Http\Resources;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\MissingValue;

class CartProductResource extends JsonResource
{

    public function __construct(Cart | MissingValue $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'product_id' => $this->resource->getProductId(),
            'quantity'   => $this->resource->getProductQuantity(),
            'price'      => $this->resource->getProductPrice(),
        ];

        return $data;
    }
}
