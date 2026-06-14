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
        Schema::create("ritase", function (Blueprint $table) {
            $table->id();
            $table->string("no_plat");
            $table->decimal("panjang", 8, 2)->comment("meter");
            $table->decimal("lebar", 8, 2)->comment("meter");
            $table->decimal("tinggi", 8, 2)->comment("meter");
            $table
                ->decimal("volume", 10, 4)
                ->storedAs("panjang * lebar * tinggi")
                ->comment("m³ - auto computed");
            $table->string("foto")->nullable();
            $table->dateTime("tanggal");

            $table
                ->foreignId("urugan_id")
                ->constrained("urugan")
                ->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("ritase");
    }
};
