<?php

namespace App\Requests\Api\Cart;

use App\DataTransferObjects\Cart\SetCartProductQuantityDTO;
use App\DataTransferObjects\Cart\UpdateCartProductDTO;
use App\Requests\Api\ApiFormRequest;

class SetCartProductQuantityRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'product_id' => 'required|integer|exists:products,product_id',
            'quantity' => 'required|integer|min:0',
        ];

        return $rules;
    }

    public function getDto(): UpdateCartProductDTO
    {
        $data = $this->validated();

        $data['user_id'] = auth()->user()->getId();

        return new UpdateCartProductDTO($data);
    }
}
