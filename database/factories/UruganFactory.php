<?php

namespace Database\Factories;

use App\Models\Urugan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Urugan>
 */
class UruganFactory extends Factory
{
    protected $model = Urugan::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nama_pt" => $this->faker->company(),
            "alamat_pt" => $this->faker->address(),
            "nama_konstruktor" => $this->faker->name(),
            "tanggal_mulai" => $this->faker->date("Y-m-d"), // Menghasilkan string tanggal format Y-m-d
            "luas_tanah" => (string) $this->faker->numberBetween(100, 5000), // Menghasilkan angka luas tanah (string)
            "lokasi" => $this->faker->city(),
            "status" => $this->faker->randomElement([
                "pending",
                "accepted",
                "decline",
            ]),
            "fileupload" => null, // Di-set null secara default, atau bisa diisi string nama file dummy jika diperlukan
        ];
    }
}
