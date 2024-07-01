<?php

namespace app\requests;

class ContaPagarRequest extends Request{

    protected $data;
    public function __construct($data) {
        $this->data = $data;
    }

    protected function rules() {
        return [
            'data_pagar' => 'required',
            'valor' => 'required',
            'id_empresa' => 'required',
        ];
    }
}