<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:150',
            'email' => 'required|string|max:150|unique:users,email'. ($this->method() == 'PUT' ?  ",$this->id" : ''),
            'username' => 'required|string|max:50|unique:users,username'.($this->method() == 'PUT' ?  ",$this->id" : ''),
            'password' => 'required|string|min:8|max:16',
            'status' => 'required|in:1,2',
            'role_id' => 'required|exists:roles,id'
        ];
    }
}
