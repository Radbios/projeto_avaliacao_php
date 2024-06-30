<?php

use core\Route;
use app\controllers\ContaPagarController;


Route::get("/", [ContaPagarController::class, "index"], "conta.index");
Route::get("/create", [ContaPagarController::class, "create"], "conta.create");
Route::post("/", [ContaPagarController::class, "store"], "conta.store");
Route::get("/{conta}", [ContaPagarController::class, "show"], "conta.show");
Route::get("/edit/{conta}", [ContaPagarController::class, "edit"], "conta.edit");
Route::post("/edit/{conta}", [ContaPagarController::class, "update"], "conta.update");
Route::post("/{conta}", [ContaPagarController::class, "delete"], "conta.delete");