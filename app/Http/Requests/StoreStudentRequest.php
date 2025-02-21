<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreStudentRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:20',
            'birthdate' => 'required|date',
            'card_id' => 'required|string|size:8|unique:students,card_id',
            'password' => ['required','string', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'group_id' => 'required|exists:groups,id',
        ];
    }
}
