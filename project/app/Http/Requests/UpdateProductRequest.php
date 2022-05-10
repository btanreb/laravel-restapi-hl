<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'string',
                'max:100'
            ],
            'price' => [
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'code' => [
                'string',
                'max:10'
            ],
            'quantity' => [
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
        ];
    }
}
