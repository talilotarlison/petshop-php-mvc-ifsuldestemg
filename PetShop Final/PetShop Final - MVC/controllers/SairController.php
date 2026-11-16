<?php

    // Inclui o arquivo de conexão com o banco de dados
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class SairController {
        public function handle($view){
            session_start();

            // Limpa todas as variáveis de sessão
            $_SESSION = [];

            // Destroi a sessão
            session_destroy();

            // Redireciona para a página de login
            // Inclue a rederização da view juntamente com os dados do banco
            /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de login com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ login ]
             * @var array  $dados  Mensagem a ser exibida na página  -> [  ]
             */
            // Renderiza a view com os dados

            RenderView::renderRouter('./login');
        }
    }


?>
