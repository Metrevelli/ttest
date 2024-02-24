<?php

namespace App\Requests\Api\Cart;

use App\DataTransferObjects\Cart\GetCartProductsDTO;
use App\Requests\Api\ApiFormRequest;

class GetCartProductsRequest extends ApiFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
        ];

        return $rules;
    }

    public function getDto(): GetCartProductsDTO
    {
        $data = $this->validated();

        $data['user_id'] = auth()->user()->getId();

        return new GetCartProductsDTO($data);
    }
}
