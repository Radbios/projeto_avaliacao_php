<?php

namespace app\models;

use app\models\Model;

class ContaPagar extends Model {

    protected static $table = 'contas_pagar';

    protected static $primary_key = 'id_conta_pagar';

    protected $fillable = [
        "id_empresa",
        "pago",
        "valor",
        "data_pagar"
    ];
}