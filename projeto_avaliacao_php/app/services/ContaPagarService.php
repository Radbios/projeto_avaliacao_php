<?php

namespace app\services;

class ContaPagarService {
    public static function summary($obj) {
        $summary = [
            "pago" => [
                "quantidade" => 0,
                "valor" => 0
            ],
            "nao_pago" => [
                "quantidade" => 0,
                "valor" => 0
            ]
        ];

        foreach ($obj as $item) {
            $value = $item->valor;

            if($item->data_pagar > date('Y-m-d')) {
                $value *= 1.1;
            }
            elseif($item->data_pagar < date('Y-m-d')) {
                $value *= 0.95;
            }

            $group = $item->pago ? "pago" : "nao_pago";

            $summary[$group]["quantidade"]++;
            $summary[$group]["valor"] += $value;
        }
        return $summary;
    }
}