<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::middleware("auth")->group(function () {
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
});
