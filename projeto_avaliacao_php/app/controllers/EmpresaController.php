<?php

namespace app\controllers;
use app\models\Empresa;

class EmpresaController extends Controller{
    public function index() {
        dd("index");
        $empresa = Empresa::all();
        return $this->view("index", compact('data'));
    }

    public function show($request) {
        return redirect(route("empresa.index"));
    }
}