<?php

function dd($dump) {
    var_dump($dump);

    die();
}

function view($file, $data) {
    $path = "../../" . $file;
    echo "\nview\n";
}