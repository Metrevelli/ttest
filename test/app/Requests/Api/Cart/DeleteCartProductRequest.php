<?php

namespace App\Requests\Api\Cart;

use App\DataTransferObjects\Cart\DeleteCartProductDTO;
use App\Requests\Api\ApiFormRequest;

class DeleteCartProductRequest extends ApiFormRequest
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
        ];

        return $rules;
    }

    public function getDto(): DeleteCartProductDTO
    {
        $data = $this->validated();

        $data['user_id'] = auth()->user()->getId();

        return new DeleteCartProductDTO($data);
    }
}
