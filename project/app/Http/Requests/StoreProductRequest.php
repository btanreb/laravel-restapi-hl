<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
                'required',
                'string',
                'max:100'
            ],
            'price' => [
                'required',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'code' => [
                'required',
                'string',
                'max:10'
            ],
            'quantity' => [
                'required',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
        ];
    }
}
