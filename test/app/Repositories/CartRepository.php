<?php

namespace App\Repositories;

use App\DataTransferObjects\Cart\CreateCartProductDTO;
use App\DataTransferObjects\Cart\UpdateCartProductDTO;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Collection;

class CartRepository
{
    public function findManyProducts(int $user_id): Collection
    {
        return $this->getModel()
            ->where('user_id', $user_id)
            ->get();
    }

    public function findProduct(int $user_id, int $product_id): ?Cart
    {
        return $this->getModel()
            ->where([
                ['user_id', $user_id],
                ['product_id', $product_id]
            ])->first();
    }

    public function addProduct(CreateCartProductDTO $dto): Cart
    {
        $data = $dto->toArray();
        $item = $this->findProduct($dto->user_id, $dto->product_id);

        if (!$item) {
            $item = $this->getModel()->create($data)->fresh();
        }

        return $item;
    }

    public function setProductQuantity(Cart $product, UpdateCartProductDTO $dto): void
    {
        $product->update(['quantity' => $dto->quantity]);
    }

    public function getTotalDiscountOfUserCartItems(int $user_id): float
    {
        $cartProductsData = Cart::where('carts.user_id', $user_id)->selectRaw("
                 user_product_groups.group_id as group_id,
                 (SUM(products.price) * (ANY_VALUE(user_product_groups.discount) / 100)) as discounted_total_price,
                 (SELECT COUNT(*) FROM product_group_items pgi
                    WHERE pgi.group_id = user_product_groups.group_id) as total_products_in_group,
                 SUM(products.price) as total_price,
                 MIN(carts.quantity) as min_quantity
            ")
            ->join('product_group_items','product_group_items.product_id','=','carts.product_id')
            ->join('user_product_groups', 'user_product_groups.group_id','=','product_group_items.group_id')
            ->join('products', 'products.product_id', '=', 'carts.product_id')
            ->groupBy('group_id')
            ->havingRaw('COUNT(DISTINCT products.product_id) = total_products_in_group')
            ->get();

        return $cartProductsData->reduce(function ($acc, $item) {
            return $acc + ($item->discounted_total_price * $item->min_quantity);
        }, 0);
    }

    public function removeProduct(Cart $cartProduct): void
    {
        $cartProduct->delete();
    }

    private function getModel(): Cart
    {
        return new Cart();
    }
}
