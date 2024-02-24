<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartProductResource;
use App\Requests\Api\Cart\CreateCartProductRequest;
use App\Requests\Api\Cart\DeleteCartProductRequest;
use App\Requests\Api\Cart\GetCartProductsRequest;
use App\Requests\Api\Cart\SetCartProductQuantityRequest;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;

class CartProductsController extends \Illuminate\Routing\Controller
{
    public function __construct(private CartService $cartService)
    {
    }

    public function index(GetCartProductsRequest $request): JsonResponse
    {
        $dto = $request->getDto();

        $items = $this->cartService->findManyProducts($dto);
        $discount = $this->cartService->getTotalDiscountOfUserCartItems($dto->user_id);

        return CartProductResource::collection($items)
            ->additional(['discount' => $discount])
            ->response();
    }

    public function store(CreateCartProductRequest $request): JsonResponse
    {
        $item = $this->cartService->addProduct($request->getDto());

        return (new CartProductResource($item))->response();
    }

    public function setCartProductQuantity(SetCartProductQuantityRequest $request): JsonResponse
    {
        $updatedDiscount = $this->cartService->setCartProductQuantity($request->getDto());

        return response()->json(['discount' => $updatedDiscount]);
    }

    public function delete(DeleteCartProductRequest $request): void
    {
        $this->cartService->delete($request->getDto());
    }
}
