<?php

namespace Database\Factories;

use App\Models\JadwalTruk;
use App\Models\Model;
use App\Models\Urugan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class JadwalTrukFactory extends Factory
{
    protected $model = JadwalTruk::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "urugan_id" => Urugan::factory(), // Otomatis membuat atau mengikat ke Urugan
            "waktu" => $this->faker->dateTimeBetween("now", "+1 month"), // Jadwal untuk sebulan ke depan
            "status" => $this->faker->randomElement(["kerja", "libur"]),
        ];
    }
}
