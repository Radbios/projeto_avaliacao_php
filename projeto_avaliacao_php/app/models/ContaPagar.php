<?php

namespace app\models;

use app\models\Model;

class ContaPagar extends Model {

    protected static $table = 'contas_pagar';
    protected static $primary_key = 'id_conta_pagar';

    function __construct() {
        parent::__construct();
    }
}