<?php

use core\Route;
use app\controllers\ContaPagarController;


Route::get("/", [ContaPagarController::class, "index"], "conta.index");
Route::get("/search", [ContaPagarController::class, "search"], "conta.search");
Route::post("/", [ContaPagarController::class, "store"], "conta.store");
Route::post("/change_status/{conta}", [ContaPagarController::class, "change_status"], "conta.change_status");
Route::post("/{conta}", [ContaPagarController::class, "delete"], "conta.delete");
Route::post("/edit/{conta}", [ContaPagarController::class, "update"], "conta.update");

Route::get("/api/{conta}", [ContaPagarController::class, "api_show"], "api.conta.show");