<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()?->can("kantor");
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has("role") || is_null($this->input("role"))) {
            $this->merge([
                'role' => 'konstruktor',
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'string', Rule::unique(User::class)->ignore($this->user()->id)],
            'password' => ['required', 'min:8'],
            'role' => ['required', 'in:kantor,lapangan,konstruktor'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi!',
            'name.max' => 'maksimal 255 karakter!',
            'email.unique' => 'email harus unik atau berbeda',
            'email.required' => 'email dibutuhkan!',
            'password.min' => 'minimal 8 karakter!',
            'password.required' => 'password harus diisi!',
            'role.required' => 'role harus diisi!',
            'role.in' => 'role harus salah satu dari kantor, lapangan, atau konstruktor',
        ];
    }
}
