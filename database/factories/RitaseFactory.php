<?php

namespace Database\Factories;

use App\Models\Ritase;
use App\Models\Urugan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ritase>
 */
class RitaseFactory extends Factory
{
    protected $model = Ritase::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $wilayah = $this->faker->randomElement(["B", "AB", "D", "L", "N", "H"]);
        $angka = $this->faker->numberBetween(1000, 9999);
        $seri = strtoupper($this->faker->lexify("???"));
        $noPlat = "{$wilayah} {$angka} {$seri}";

        return [
            "urugan_id" => Urugan::factory(), // Otomatis membuat atau mengikat ke Urugan
            "no_plat" => $noPlat,
            "panjang" => $this->faker->randomFloat(2, 4.0, 6.0), // Meter (Min: 4.00, Max: 6.00)
            "lebar" => $this->faker->randomFloat(2, 1.8, 2.4), // Meter (Min: 1.80, Max: 2.40)
            "tinggi" => $this->faker->randomFloat(2, 0.8, 1.5), // Meter (Min: 0.80, Max: 1.50)
            "foto" => null,
            "tanggal" => $this->faker->dateTimeBetween("-1 month", "now"), // Waktu sebulan terakhir
        ];
    }
}
