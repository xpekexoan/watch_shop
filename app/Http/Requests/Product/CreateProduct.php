<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
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
            'image' => 'required|image',
            'price' => 'required|numeric|min:1000',
            'id_category' => 'required|exists:category,id',
            'id_brand' => 'required|exists:brand,id',
            'image_details.*' => 'image',
            'warranty' => 'required|integer|min:0',
        ];
    }

    public function attributes()
    {
        return [
            'image_details.*' => 'image detail',
        ];
    }
}
