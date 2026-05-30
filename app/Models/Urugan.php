<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Ritase;

class Urugan extends Model
{
    protected $table = "urugan";

    protected $fillable = [
        "nama_pt",
        "alamat_pt",
        "nama_konstruktor",
        "tanggal_mulai",
        "luas_tanah",
        "lokasi",
        "status",
        "fileupload",
    ];

    public function ritase(): HasMany
    {
        return $this->hasMany(Ritase::class, "urugan_id");
    }

    public function getTotalRitasiAttribute(): int
    {
        return $this->ritase->count();
    }

    public function getTotalVolumeAttribute(): float
    {
        return $this->ritase->sum("volume");
    }
}
