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
        Schema::create("jadwal_truk", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("urugan_id")
                ->constrained("urugan")
                ->cascadeOnDelete();
            $table->dateTime("waktu");
            $table->enum("status", ["kerja", "libur"])->default("kerja");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("jadwal_truk");
    }
};
