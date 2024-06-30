<?php

namespace app\traits;

use app\exceptions\ViewNotExistException;

trait View {

    private $view_path = '../views/';
    public function view($view, $data) {
        $data = (object) $data;
        $view =  str_replace('.', '/', $view) . '.php';
        $template = $this->view_path . $view;
        
        if (!file_exists($template)) {
            throw new ViewNotExistException("View '{$view}' não encontrado.");
        }
        $conteudo = file_get_contents($template);
        $conteudo = str_replace(["{{", "}}"], ["<?php echo ", " ?>"], $conteudo);
        
        ob_start();
        eval('?>' . $conteudo);
        $conteudo = ob_get_clean();

        return $conteudo;
    }
}