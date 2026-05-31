<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RitaseController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function () {
    // Urugan Tanah Route
    Route::get("/", [DashboardController::class, "index"])->name("dashboard");
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
