<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/PetsModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class PetsController {
        public function handle($view){

            // dados de login usuario
           // se nao tiver logado redirecionar para login
             MiddlewareAuth::checkAuth('/login');

            // Inicializa com array vazio para evitar warnings caso haja erro
            $getTodosPets = [];
            $errorMessage = "";
            $successMessage = "";

            try {
                // Obtém a conexão PDO
                $pdo = Database::getConnection();

                // Assegure que o PDO lance exceções (caso getConnection não configure)
                if ($pdo instanceof PDO) {
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                // busca dados do pets
                $TodosPets = new PetsModel($pdo);
                $getTodosPets = $TodosPets->getTodosPets();

                // echo json_encode($getTodosPets); // Para depuração rápida
            } catch (PDOException $e) {
                // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                error_log('DB error in pets: ' . $e->getMessage());

                // Opcional: definir uma mensagem genérica para exibir na UI
                $errorMessage = 'Erro ao carregar pets. Contate o administrador.';
            }

            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de pets com os dados necessários.
             *
             * @var string $view - Nome da pedidos a ser renderizada -> [ pets ]
             * @var string $successMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var string $errorMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var array $getTodosPets - Mensagem a ser exibida na página  -> [ $getTodosPets ]
             */
            // Renderiza a view com os dados

            RenderView::renderPage($view, [
                'successMessage' => $successMessage,
                'errorMessage' => $errorMessage,
                'getTodosPets' => $getTodosPets
            ]);
        }
    }
?>