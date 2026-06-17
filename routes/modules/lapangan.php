<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;

Route::middleware("auth")->group(function () {
    Route::get("/urugan/{urugan}/lapangan/create", [
        LapanganController::class,
        "create",
    ])->name("lapangan.create");

    Route::put("/urugan/{urugan}/lapangan/", [
        LapanganController::class,
        "addLapangan",
    ])->name("lapangan.update");
});
