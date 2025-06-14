<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //buat authorize
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
            'id' => 'required|integer',
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,'.Request()->id,
            'phone' => 'required|max:20|string',
            'superadmin' => 'required|boolean'
        ];
    }
}
