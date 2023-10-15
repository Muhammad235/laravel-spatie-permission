<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:30'],
            'email' => ['required', 'string', 'unique:users,email', 'max:40'],
            'firstname' => ['required', 'string', 'min:3', 'max:60'],
            'lastname' => ['required', 'string', 'min:3' ,'max:60'],
            'gender' => ['required', 'string', 'in:male,female'],
        ];
    }
}
