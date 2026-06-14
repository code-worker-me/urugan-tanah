<?php

namespace Database\Seeders;

use App\Models\JadwalTruk;
use App\Models\Ritase;
use App\Models\Urugan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            "name" => "Kantor",
            "email" => "kantor@mail.com",
            "role" => "kantor",
        ]);

        User::factory()->create([
            "name" => "Konstruktor",
            "email" => "konstruktor@mail.com",
            "role" => "konstruktor",
        ]);

        // User::factory()->create([
        //     "name" => "Lapangan",
        //     "email" => "lapangan@mail.com",
        // ]);

        // Urugan::factory(12)
        //     // Setiap 1 Urugan akan otomatis memiliki 5 data Ritase palsu
        //     ->has(Ritase::factory()->count(15), "ritase")
        //     // Setiap 1 Urugan juga otomatis memiliki 3 data JadwalTruk palsu
        //     ->has(JadwalTruk::factory()->count(13), "jadwal")
        //     ->create();
    }
}
