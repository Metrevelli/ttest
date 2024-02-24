<?php

namespace App\Services;

use App\DataTransferObjects\Cart\CreateCartProductDTO;
use App\DataTransferObjects\Cart\DeleteCartProductDTO;
use App\DataTransferObjects\Cart\GetCartProductsDTO;
use App\DataTransferObjects\Cart\UpdateCartProductDTO;
use App\Models\Cart;
use App\Repositories\CartRepository;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;

class CartService
{
    public function __construct(private CartRepository $repository)
    {
    }

    public function findManyProducts(GetCartProductsDTO $dto): Collection
    {
        $items = $this->repository->findManyProducts($dto->user_id);
        $items->load('products');

        return $items;
    }

    public function addProduct(CreateCartProductDTO $dto): Cart
    {
        return $this->repository->addProduct($dto);
    }

    public function setCartProductQuantity(UpdateCartProductDTO $dto): float
    {
        $item = $this->repository->findProduct($dto->user_id, $dto->product_id);

        if(empty($item)) {
            throw ValidationException::withMessages(['product_id' => 'Product doesn\'t exists in a cart.']);
        }

        if ($dto->quantity === 0) {
            $this->repository->removeProduct($item);
        } else {
            $this->repository->setProductQuantity($item, $dto);
        };

        return $this->repository->getTotalDiscountOfUserCartItems($dto->user_id);
    }

    public function getTotalDiscountOfUserCartItems (int $user_id): float
    {
        return $this->repository->getTotalDiscountOfUserCartItems($user_id);
    }

    public function delete(DeleteCartProductDTO $dto): void
    {
        $item = $this->repository->findProduct($dto->user_id, $dto->product_id);

        $this->repository->removeProduct($item);
    }
}
