<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("urugan", function (Blueprint $table) {
            $table->id();
            $table->string("nama_pt");
            $table->string("alamat_pt");
            $table->string("nama_konstruktor");
            $table->string("tanggal_mulai");
            $table->string("luas_tanah");
            $table->string("lokasi");
            $table->string("status")->defult("pending");
            $table->string("fileupload")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("urugan");
    }
};
