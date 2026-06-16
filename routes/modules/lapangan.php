<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LapanganController;

Route::middleware("auth")->group(function () {
    Route::get("/urugan/{urugan}/lapangan/create", [
        LapanganController::class,
        "create",
    ])->name("lapangan.create");

    Route::post("/urugan/{urugan}/lapangan", [
        LapanganController::class,
        "store",
    ])->name("lapangan.store");
});
