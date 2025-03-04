<?php

namespace App\Http\Requests\Admin;

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
            'name'=> 'required|string|max:30',
            'email'=> 'required|string|email|unique:users',
            'phone_number' => 'string|max:12',
            'roles'=> 'nullable|string|in:ADMIN,USER',
            'photo_user' => 'nullable|string',
        ];
    }
}
