<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MotorRequest extends FormRequest
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
            'year' => 'required|string',
            'color' => 'required|string',
            'price' => 'required|integer',
            'machine' => 'required|string',
            'suspension_type' => 'required|string',
            'transmision_type' => 'required|string',
        ];
    }
}
