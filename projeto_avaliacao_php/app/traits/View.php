<?php

namespace app\traits;
use app\exceptions\ViewNotExistException;
use DirectoryIterator;

trait View {

    private $view_path = '../views/';
    public function view($view, $data) {
        $data = (object) $data;

        $template = $this->view_path . str_replace('.', '/', $view) . '.php';

        if (!file_exists($template)) {
            throw new ViewNotExistException("View {$template} não encontrado.");
        }
        $conteudo = file_get_contents($template);
        $conteudo = str_replace(["{{", "}}"], ["<?php echo ", " ?>"], $conteudo);
        
        ob_start();
        eval('?>' . $conteudo);
        $conteudo = ob_get_clean();

        return $conteudo;
    }
}