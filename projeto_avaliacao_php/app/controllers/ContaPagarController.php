<?php

namespace app\controllers;
use app\models\ContaPagar;
use app\models\Empresa;

class ContaPagarController extends Controller{
    public function index() {
        $contas = ContaPagar::all();
        $empresas = Empresa::all();
        return $this->view("index", compact('contas', 'empresas'));
    }

    public function show($params) {
        return redirect(route("empresa.index"));
    }

    public function store() {
        $conta = ContaPagar::create($_POST);
        return redirect(route("conta.index"));
    }
}