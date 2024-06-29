<?php

namespace app\controllers;
use app\models\Empresa;

class EmpresaController extends Controller{
    public function index() {
        $empresa = Empresa::find_or_fail(1);
        dd($empresa);
        return $this->view("index", compact('data'));
    }

    public function show($request) {
        dd($request);
    }
}