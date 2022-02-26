<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrUpdatePropertyRequest extends FormRequest
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
            'region' => 'required',
            'city' => 'required',
            'town' => 'required',
            'address' => 'required',
            'contactPhoneNumber' => 'required',
            'contactEmail' => 'required|email',
            'type' => 'required',//add check for exists|type,type, write tests for validation, show failed validation errors in vue form
            'price' => 'required|numeric',
        ];
    }
}
