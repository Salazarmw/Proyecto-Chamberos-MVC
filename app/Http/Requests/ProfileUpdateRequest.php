<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:100'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
            ],
            'phone' => ['required', 'string', 'max:20'],
            'province' => ['required', 'string', 'max:100'],
            'canton' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string'],
            'birth_date' => ['required', 'date'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif|max:2048'],
        ];
        // Tag validation for chambero users
        if ($user->user_type == 'chambero') {
            $rules['tags'] = ['sometimes', 'array', 'max:10'];
            $rules['tags.*'] = ['exists:tags,id'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'tags.max' => 'Solo puedes seleccionar un máximo de 10 tags.',
            'tags.*.exists' => 'Algunos de los tags seleccionados no son válidos.',
        ];
    }
}
