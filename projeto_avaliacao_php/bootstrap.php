<?php
use app\classes\Bind;

require "vendor/autoload.php";

$config = require "config.php";

Bind::set('config', $config);