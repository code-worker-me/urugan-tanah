<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRitaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            "tanggal" => now()->toDateTimeString(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "no_plat" => "required|string|max:20",
            "panjang" => "required|numeric|min:0.01",
            "lebar" => "required|numeric|min:0.01",
            "tinggi" => "required|numeric|min:0.01",
            "tanggal" => "required|date",
            "foto" => "nullable|image|mimes:jpg,jpeg,png,webp|max:5120",
        ];
    }

    public function messages(): array
    {
        return [
            "no_plat.required" => "Nomor plat kendaraan wajib diisi!",
            "no_plat.max" => "Nomor plat maksimal 20 karakter!",
            "panjang.required" => "Ukuran panjang wajib diisi!",
            "panjang.numeric" => "Ukuran panjang harus berupa angka!",
            "lebar.required" => "Ukuran lebar wajib diisi!",
            "lebar.numeric" => "Ukuran lebar harus berupa angka!",
            "tinggi.required" => "Ukuran tinggi wajib diisi!",
            "tinggi.numeric" => "Ukuran tinggi harus berupa angka!",
            "tanggal.required" => "Tanggal ritase wajib ditentukan!",
            "foto.image" => "Berkas yang diunggah harus berupa gambar!",
            "foto.mimes" =>
                "Format foto harus berekstensi jpg, jpeg, png, atau webp!",
            "foto.max" => "Ukuran foto tidak boleh lebih dari 5MB!",
        ];
    }
}
