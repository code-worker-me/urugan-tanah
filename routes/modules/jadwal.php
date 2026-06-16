<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JadwalController;

Route::middleware("auth")->group(function () {
    Route::get("/jadwal-truk/{urugan}", [
        JadwalController::class,
        "indexUrugan",
    ])->name("jadwalUrugan.index");

    Route::get("/jadwal-truk/create/{urugan}", [
        JadwalController::class,
        "create",
    ])->name("jadwalUrugan.create");

    Route::post("/jadwal-truk/{urugan}", [
        JadwalController::class,
        "store",
    ])->name("jadwalUrugan.store");

    Route::delete("/urugan/{urugan}/jadwal-truk/{jadwal}", [
        JadwalController::class,
        "delete",
    ])->name("jadwalUrugan.delete");
});

Route::get("/", [JadwalController::class, "index"])->name("jadwal.index");
