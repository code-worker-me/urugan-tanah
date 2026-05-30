<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Urugan;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ritase extends Model
{
    protected $table = "ritase";

    protected $fillable = [
        "no_plat",
        "panjang",
        "lebar",
        "tinggi",
        "foto",
        "tanggal",

        "urugan_id",
    ];

    public function urugan(): BelongsTo
    {
        return $this->belongsTo(Urugan::class);
    }
}
