<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
