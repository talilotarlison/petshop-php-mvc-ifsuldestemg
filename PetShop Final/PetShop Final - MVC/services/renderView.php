<?php
    // Função para renderizar uma view com dados opcionais
    class RenderView {
       static function renderPage($view, $dados = []) {
            extract($dados);
            include $view;
        }
        static function renderRouter($router){
            header("Location:". $router);
        }
    }
?>