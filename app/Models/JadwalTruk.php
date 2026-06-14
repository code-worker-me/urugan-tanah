<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Urugan;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalTruk extends Model
{
    use HasFactory;
    protected $table = "jadwal_truk";
    protected $fillable = ["urugan_id", "waktu", "status"];

    protected $casts = ["waktu" => "datetime"];

    public function urugan(): BelongsTo
    {
        return $this->belongsTo(Urugan::class, "urugan_id");
    }

    public function scopeCountKerja(Builder $query): int
    {
        return $query->where("status", "kerja")->count();
    }

    public function scopeCountLibur(Builder $query): int
    {
        return $query->where("status", "libur")->count();
    }

    public function scopeKerja($query)
    {
        return $query->where("status", "kerja");
    }
}
