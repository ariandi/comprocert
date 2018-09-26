<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePerson extends FormRequest
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
            'firstName' => 'required|min:5|alpha',
            'birthDate' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $this->segment(3),
            'password' => 'sometimes|nullable|min:6|confirmed',
            'password_confirmation' => 'sometimes|nullable|min:6',
            'company' => 'required|array|min:1',
            'company.*' => 'required|numeric',
            'lastName' => 'required|min:5|alpha',
            'gender' => 'required|max:1|alpha',
            'mobilePhoneNumber' => 'required|max:13|string',
            'languageID' => 'required|max:2|alpha',
            'role' => 'required|alpha'
        ];
    }
}
