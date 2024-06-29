<?php

use core\Route;
use app\controllers\EmpresaController;


Route::get("/", [EmpresaController::class, "index"]);
Route::get("/create", [EmpresaController::class, "create"]);
Route::post("/", [EmpresaController::class, "store"]);
Route::get("/{empresa}", [EmpresaController::class, "show"]);
Route::get("/edit/{empresa}", [EmpresaController::class, "edit"]);
Route::post("/edit/{empresa}", [EmpresaController::class, "update"]);
Route::post("/{empresa}", [EmpresaController::class, "delete"]);