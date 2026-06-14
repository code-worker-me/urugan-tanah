<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Ritase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Urugan extends Model
{
    use HasFactory;
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
        "admin_lapangan_id",
    ];

    public function adminLapangan()
    {
        return $this->belongsTo(User::class, "admin_lapangan_id");
    }

    public function ritase(): HasMany
    {
        return $this->hasMany(Ritase::class, "urugan_id");
    }

    public function jadwal(): HasMany
    {
        return $this->hasMany(JadwalTruk::class, "urugan_id");
    }

    public function getTotalRitasiAttribute(): int
    {
        return $this->ritase->count();
    }

    public function getTotalVolumeAttribute(): float
    {
        return $this->ritase->sum("volume");
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            "urugan_user",
            "urugan_id",
            "user_id",
        )->withTimestamps();
    }
}
