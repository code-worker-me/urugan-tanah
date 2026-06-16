<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RitaseController;

Route::middleware("auth")->group(function () {
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
