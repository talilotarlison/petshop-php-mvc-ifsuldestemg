<?php
    // Inclui o arquivo de conexão com o banco de dados
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class ErrorController {
        public function handle($view){
            // Inclue a rederização da view juntamente com os dados do banco

            // se nao tiver logado redirecionar para login
             MiddlewareAuth::checkAuth('/login');

            // Renderiza a view com os dados
            /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de erro com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ erro ]
             * @var array  $dados  Mensagem a ser exibida na página  -> [  ]
             */
             // Renderiza a view sem os dados
            RenderView::renderPage($view, []);
            exit;
        }
    }
    ?>