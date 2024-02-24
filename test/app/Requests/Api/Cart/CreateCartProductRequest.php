<?php

namespace App\Requests\Api\Cart;

use App\DataTransferObjects\Cart\CreateCartProductDTO;
use App\Requests\Api\ApiFormRequest;

class CreateCartProductRequest extends ApiFormRequest
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

    public function getDto(): CreateCartProductDTO
    {
        $data = $this->validated();

        $data['user_id'] = auth()->user()->getId();

        return new CreateCartProductDTO($data);
    }
}
