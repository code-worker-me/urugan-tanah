<?php
namespace App\Services;

use App\Models\JadwalTruk;
use App\Models\Urugan;

class JadwalService
{
    public function create(Urugan $urugan, array $data): JadwalTruk
    {
        $data["urugan_id"] = $urugan->id;
        return JadwalTruk::create($data);
    }

    public function updateStatus(Urugan $urugan, JadwalTruk $jadwal, string $status): bool
    {
        abort_if(
            $jadwal->urugan_id !== $urugan->id,
            403,
            "Data Jadwal tidak cocok dengan Proyek Urugan!!",
        );

        return $jadwal->update(["status" => $status]);
    }

    public function delete(Urugan $urugan, JadwalTruk $jadwal): bool
    {
        abort_if(
            $jadwal->urugan_id !== $urugan->id,
            403,
            "Data Jadwal tidak cocok dengan Proyek Urugan!!",
        );

        return $jadwal->delete();
    }
}
