<?php

use core\Route;
use app\controllers\EmpresaController;


Route::get("/", [EmpresaController::class, "index"], "empresa.index");
Route::get("/create", [EmpresaController::class, "create"], "empresa.create");
Route::post("/", [EmpresaController::class, "store"], "empresa.store");
Route::get("/{empresa}", [EmpresaController::class, "show"], "empresa.show");
Route::get("/edit/{empresa}", [EmpresaController::class, "edit"], "empresa.edit");
Route::post("/edit/{empresa}", [EmpresaController::class, "update"], "empresa.update");
Route::post("/{empresa}", [EmpresaController::class, "delete"], "empresa.delete");