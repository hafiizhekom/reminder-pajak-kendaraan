<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleEditRequest extends FormRequest
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
            'area_code' => 'required|max:2|string',
            'number' => 'required|max:4|string ',
            'code' => 'required|max:3|string',
            'tax_validity_period' => 'required|date',
            'stnk_validity_period' => 'required|date'
        ];
    }
}
