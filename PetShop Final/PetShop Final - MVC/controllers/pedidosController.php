<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/PedidosModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class pedidosController {
        public function handle($view){

            // dados de login usuario
            // se nao tiver logado redirecionar para login
            MiddlewareAuth::checkAuth('/login');

            // Inicializa com array vazio para evitar warnings caso haja erro
            $getTodosPedidos = [];
            $errorMessage = "";
            $successMessage = "";

            try {
                // Obtém a conexão PDO
                $pdo =  Database::getConnection();

                // Assegure que o PDO lance exceções (caso getConnection não configure)
                if ($pdo instanceof PDO) {
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                // busca dados dos serviços
                $todosPedidos = new PedidosModel($pdo);
                $getTodosPedidos = $todosPedidos->getTodosPedidos();

                // echo json_encode($getTodosPedidos); // Para depuração rápida
            } catch (PDOException $e) {
                // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                error_log('DB error in pedidos: ' . $e->getMessage());

                // Opcional: definir uma mensagem genérica para exibir na UI
                $errorMessage = 'Erro ao carregar pedidos. Contate o administrador.';
            }

            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de pedidos com os dados necessários.
             *
             * @var string $view - Nome da pedidos a ser renderizada -> [ pedidos ]
             * @var string $successMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var string $errorMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var array $getTodosPedidos - Mensagem a ser exibida na página  -> [ $getTodosPedidos ]
             */
            // Renderiza a view com os dados

            RenderView::renderPage($view, [
                'successMessage' => $successMessage,
                'errorMessage' => $errorMessage,
                'getTodosPedidos' => $getTodosPedidos
            ]);
        }
    }
?>