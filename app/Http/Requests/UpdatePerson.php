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
            'first_name' => 'required|min:3|alpha',
            'birth_date' => 'required|date',
            'email' => 'required|email|unique:users,email,' . $this->segment(3),
            'password' => 'sometimes|nullable|min:6|confirmed',
            'password_confirmation' => 'sometimes|nullable|min:6',
            'companies' => 'required|array|min:1',
            'companies.*' => 'required|numeric',
            'last_name' => 'required|min:3|alpha',
            'gender' => 'required|max:1|alpha',
            'no_hp' => 'required|max:15|string',
            'lang_id' => 'required|max:2|alpha',
            'role' => 'required|alpha'
        ];
    }
}
