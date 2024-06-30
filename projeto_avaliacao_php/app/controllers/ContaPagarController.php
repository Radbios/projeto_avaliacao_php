<?php

namespace app\controllers;
use app\models\ContaPagar;
use app\models\Empresa;
use app\services\ContaPagarService;

class ContaPagarController extends Controller{
    public function index() {
        $contas = ContaPagar::with('empresa')->get();
        $empresas = Empresa::all();
        $resumo = ContaPagarService::summary($contas);

        return $this->view("index", compact('contas', 'empresas', 'resumo'));
    }

    public function search() {
        $contas = ContaPagar::where('data_pagar', $_GET['data_pagar'])
                            ->where('id_empresa', $_GET['id_empresa']);
        if(isset($_GET['condicao'])) $contas->where("valor", $_GET['condicao'], $_GET['valor']);
        $contas = $contas->get();
        $empresas = Empresa::all();
        $resumo = ContaPagarService::summary($contas);

        return $this->view("index", compact('contas', 'empresas', 'resumo'));
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

    public function edit($params) {
        $conta = ContaPagar::find_or_fail($params['conta']);
        $empresas = Empresa::all();

        return $this->view("edit", compact("conta", "empresas"));
    }

    public function update($params) {
        $conta = ContaPagar::find_or_fail($params['conta']);
        $conta->update($_POST);

        return redirect(route("conta.index"));
    }

    public function delete($params) {
        ContaPagar::find_or_fail($params['conta'])->delete();
        return redirect(back());
    }
}