<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            //  'logo' => 'required|image|mimes:jpeg,png,jpg|dimensions:min_width=100,min_height=100', // Adjust maximum file size as needed
            'website' => 'nullable|url|max:255',
            // 'status' => 'required|in:active,inactive',
     
        ];
    }
}
