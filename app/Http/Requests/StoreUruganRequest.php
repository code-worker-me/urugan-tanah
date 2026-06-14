<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUruganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()?->can("konstruktor");
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has("status") || is_null($this->input("status"))) {
            $this->merge([
                "status" => "pending",
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
            "nama_pt" => "required|string|max:255",
            "alamat_pt" => "required|string|max:500",
            "nama_konstruktor" => "required|string|max:150",
            "tanggal_mulai" => "required|date|after_or_equal:today",
            "luas_tanah" => "required|string|max:255",
            "lokasi" => "required|string|max:355",
            "status" => "required|in:accepted,decline,pending",
            "fileupload" => "nullable|file|mimes:jpg,jpeg,png,pdf|max:5048",
        ];
    }

    public function messages(): array
    {
        return [
            "nama_pt.required" => "Nama Perusahaan Diperlukan dan Mohon diisi!",
            "nama_pt.max" =>
                "Nama Perusahaan maksimal 255 karakter tidak lebih!",

            "alamat_pt.required" => "Alamat Perusahaan wajib diisi!",
            "alamat_pt.max" =>
                "Alamat Perusahaan maksimal 500 karakter tidak lebih!",

            "nama_konstruktor.required" =>
                "Nama kontruktor atau penanggung jawab wajib diisi!",
            "nama_konstruktor.max" => "Nama kontruktor maksimal 150 karakter!",

            "tanggal_mulai.required" =>
                "Tanggal mulai wajib ditentukan tidak boleh kosong!",
            "tanggal_mulai.after_or_equal" =>
                "Tanggal mulai tidak bisa hari sebelumnya!",

            "luas_tanah.required" => "Luas tanah wajib diisi!",

            "lokasi.required" => "Lokasi urugan proyek tidak boleh kosong!",
            "lokasi.max" => "Maksimal 355 karakter saja!",

            "fileupload.max" => "Maksimal 5mb!",
            "fileupload.file" => "Input harus berupa berkas/file!",
            "fileupload.mimes" => "Format file harus jpg, jpeg, png, atau pdf!",
        ];
    }
}
