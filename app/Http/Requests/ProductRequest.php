<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required',
            'product_sku' => 'required',
            'product_status' => 'required',
            'product_price' => 'required',
            'product_description' => 'required',
            'product_special_price' => 'required',
        ];
    }
}
