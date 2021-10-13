<?php

namespace App\Http\Requests\User;

use App\Model\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
        return  [
            'name' => 'required',
            'tel' => 'required|regex:/[0-9]{10}/',
            'id_province' => 'required|exists:province,id',
            'id_district' => 'required|exists:district,id',
            'address' => 'required',
            'id_role' => 'required|exists:role,id',
            // 'status' => 'required|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'tel' => 'phone number',
            'id_province' => 'province',
            'id_district' => 'district',
            'id_role' => 'role',
        ];
    }
}

