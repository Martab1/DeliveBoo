<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "token" => "required",
            "products" => "required",
            "restaurantId" => "required",
            "payer_name" => "required|string|min:3|max:50",
            "payer_email" => "required",
            "payer_address" => "required|min:3|max:200",
        ];
    }
}
