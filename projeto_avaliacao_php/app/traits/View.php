<?php

namespace app\traits;
use DirectoryIterator;

trait View {

    private $view_path = '../views/';
    public function view($view, $data) {  
        $template = $this->view_path . str_replace('.', '/', $view) . '.php';
        
        ob_start();
        include $template;
        $conteudo = ob_get_clean();

        return $conteudo;
    }
}