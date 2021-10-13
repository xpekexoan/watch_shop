<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
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
            'name' => 'required',
            'image' => 'image',
            'price' => 'required|numeric|min:1000',
            'id_category' => 'required|exists:category,id',
            'id_brand' => 'required|exists:brand,id',
            'status' => 'required|boolean',
            'image_detail.*' => 'image',
            'warranty' => 'required|integer|min:0',
        ];
    }

    public function attributes()
    {
        return [
            'image_detail.*' => 'image detail',
            'id_category' => 'category',
        ];
    }
}
