<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => 'string|max:255',
            'gender' => 'string|max:7',
            'city' => 'string|max:255',
            'barangay' => 'string|max:255',
            'present_address' => 'string|max:255',
            'permanent_address' => 'string|max:255',
            'phone_number' => 'string|max:11',
            'avatar' => 'file|max:1025',
            'email' => 'string|email|max:255|unique:users',
        ];
    }
}
