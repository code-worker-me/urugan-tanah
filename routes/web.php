<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LapanganController;
use App\Http\Controllers\RitaseController;
use Illuminate\Support\Facades\Route;

Route::get("/", [JadwalController::class, "index"])->name("jadwal.index");

Route::middleware("auth")->group(function () {
    // Urugan Tanah Route
    Route::get("/home", [DashboardController::class, "index"])->name(
        "dashboard",
    );
    Route::middleware("can:view-dashboard")->group(function () {
        Route::get("/create/urugan", [
            DashboardController::class,
            "createUrugan",
        ])->name("urugan.create");
        Route::post("/store/urugan", [
            DashboardController::class,
            "storeUrugan",
        ])->name("urugan.store");
        Route::get("/edit/{urugan}", [
            DashboardController::class,
            "editUrugan",
        ])->name("urugan.edit");
        Route::get("/view/{urugan}", [
            DashboardController::class,
            "showUrugan",
        ])->name("urugan.view");
        Route::patch("/update-status/{urugan}", [
            DashboardController::class,
            "updateStatus",
        ])->name("urugan.update-status");
        Route::delete("/delete/{urugan}", [
            DashboardController::class,
            "deleteUrugan",
        ])->name("urugan.delete");
        Route::put("/update/{urugan}", [
            DashboardController::class,
            "updateUrugan",
        ])->name("urugan.update");
    });

    // Ritase Tanah Route
    Route::get("/ritase-tanah/{urugan}", [
        RitaseController::class,
        "index",
    ])->name("ritase.index");
    Route::get("/ritase-tanah/create/{urugan}", [
        RitaseController::class,
        "create",
    ])->name("ritase.create");
    Route::get("/edit/{urugan}/ritase-tanah/{ritase}", [
        RitaseController::class,
        "edit",
    ])->name("ritase.edit");
    Route::post("/ritase-tanah/{urugan}", [
        RitaseController::class,
        "store",
    ])->name("ritase.store");
    Route::put("/update/{urugan}/ritase-tanah/{ritase}", [
        RitaseController::class,
        "update",
    ])->name("ritase.update");
    Route::delete("/urugan/{urugan}/ritase-tanah/{ritase}", [
        RitaseController::class,
        "delete",
    ])->name("ritase.delete");

    // Jadwal Truk
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

    // Admin Lapangan
    Route::get("/urugan/{urugan}/lapangan/create", [
        LapanganController::class,
        "create",
    ])->name("lapangan.create");
    Route::post("/urugan/{urugan}/lapangan", [
        LapanganController::class,
        "store",
    ])->name("lapangan.store");
});

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
