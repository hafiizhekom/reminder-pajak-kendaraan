<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmsManualRequest extends FormRequest
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
            'receiver' => 'required|string',
            'message' => 'required|string'
        ];
    }
}
