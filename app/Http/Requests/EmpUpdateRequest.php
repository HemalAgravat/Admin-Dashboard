<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|size:10',
        ];
    }
    public function messages()
    {
        return [
            'email.unique' => 'The email address is already in use.', // Custom error message for email uniqueness
        ];
    }

}
