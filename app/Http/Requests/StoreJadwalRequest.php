<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StoreJadwalRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "waktu" => "required|date|after_or_equal:today",
            "status" => "required|in:kerja,libur",
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            "waktu.required" => "Tanggal dan jam wajib diisi!",
            "waktu.date" => "Format tanggal tidak valid.",
            "waktu.after_or_equal" =>
                "Tanggal mulai tidak bisa hari sebelumnya!",
            "status.required" => "Status wajib ditentukan!",
            "status.in" => "Status harus berupa kerja atau libur.",
        ];
    }
}
