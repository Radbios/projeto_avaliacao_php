<?php

namespace app\controllers;
use app\models\ContaPagar;
use app\models\Empresa;
use app\services\ContaPagarService;

class ContaPagarController extends Controller{
    public function index() {
        $contas = ContaPagar::all();
        $empresas = Empresa::all();
        $sum_valor_conta = ContaPagarService::sum($contas, "valor", "pago");

        return $this->view("index", compact('contas', 'empresas', 'sum_valor_conta'));
    }

    public function show($params) {
        return redirect(route("empresa.index"));
    }

    public function store() {
        $conta = ContaPagar::create($_POST);
        return redirect(back());
    }

    public function change_status($params) {
        $conta = ContaPagar::find_or_fail($params['conta']);

        $conta->update([
            'pago' => $conta->pago == 1 ? 0 : 1
        ]);

        return redirect(back());
        
    }

    public function delete($params) {
        ContaPagar::find_or_fail($params['conta'])->delete();
        return redirect(back());
    }
}