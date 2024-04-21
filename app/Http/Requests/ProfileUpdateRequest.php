<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // Ensure that only the authenticated user can make this request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id)
            ],
            // Adding rules for family information
            'kin_email_1' => ['nullable', 'email', 'max:255'],
            'kin_email_2' => ['nullable', 'email', 'max:255'],
            'kin_email_3' => ['nullable', 'email', 'max:255'],
            'additional_info' => ['nullable', 'string', 'max:1000'],  // Assuming there's a length limit
        ];
    }
}
