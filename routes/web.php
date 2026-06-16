<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// Urugan Tanah Route
require base_path('routes/modules/urugan.php');

// Ritase Tanah Route
require base_path('routes/modules/ritase.php');

// Jadwal Truk
require base_path('routes/modules/jadwal.php');

// Admin Lapangan
require base_path('routes/modules/lapangan.php');

// User Management
require base_path('routes/modules/user-manage.php');


// Profile
Route::middleware("auth")->group(function () {
    Route::get("/profile", [ProfileController::class, "edit"])->name(
        "profile.edit",
    );

    Route::patch("/profile", [ProfileController::class, "update"])->name(
        "profile.update",
    );
    Route::delete("/profile", [ProfileController::class, "destroy"])->name(
        "profile.destroy",
    );
});

require __DIR__ . "/auth.php";
