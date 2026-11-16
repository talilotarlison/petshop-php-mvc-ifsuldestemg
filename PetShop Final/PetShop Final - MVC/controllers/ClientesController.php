<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/ClientesModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class ClientesController {
        public function handle($view){

            // dados de login usuario
            // se nao tiver logado redirecionar para login
            MiddlewareAuth::checkAuth('/login');

            // Inicializa com array vazio para evitar warnings caso haja erro
            $getTodosClientes = [];
            $successMessage = "";
            $errorMessage = "";

            try {
                // Obtém a conexão PDO
                $pdo = Database::getConnection();

                // Assegure que o PDO lance exceções (caso getConnection não configure)
                if ($pdo instanceof PDO) {
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }

                // busca todos os cliente
                $todosClientes = new ClientesModel($pdo);
                $getTodosClientes =  $todosClientes->getTodosClientes();

                // echo json_encode($getTodosClientes);
            } catch (PDOException $e) {
                // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                error_log('DB error in clientes.php: ' . $e->getMessage());

                // Opcional: definir uma mensagem genérica para exibir na UI
                $errorMessage = 'Erro ao carregar clientes. Contate o administrador.';
            }

            // Inclue a rederização da view juntamente com os dados do banco

            /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de Clientes com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ clientes ]
             * @var string $successMessage  Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var string $errorMessage  Mensagem a ser exibida na página  -> [ $errorMessage ]
             * @var array  $getTodosClientes  Mensagem a ser exibida na página  -> [ $getTodosClientes ]
             */
            // Renderiza a view com os dados
            RenderView::renderPage($view, [
                'successMessage' => $successMessage,
                'errorMessage' => $errorMessage,
                'getTodosClientes' => $getTodosClientes
            ]);

        }
    }

?>





