<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/editClienteModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class verClienteController {
        public function handle($view){
            // dados de login usuario
            // se nao tiver logado redirecionar para login
            MiddlewareAuth::checkAuth('/login');

            // mensagens do sistema
            $successMessage = "";
            $errorMessage = "";
            $cliente = "";

            // pega o id do cliente a ser editado
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                // Aqui você pode processar os dados do formulário enviados via POST

                // id do Cliente pra atualização
                $id = $_GET['id'] ?? '';

                // echo "ID do Cliente a ser editado: " . htmlspecialchars($id);

                try {
                    // Aqui você pode processar esses dados, como inseri-los em um banco de dados, etc.
                    // Obtém a conexão PDO
                    $pdo = Database::getConnection();

                    // Assegure que o PDO lance exceções (caso getConnection não configure)
                    if ($pdo instanceof PDO) {
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }

                    // busca dados do cliente para mostrar na tela
                    $buscaCliente = new verClienteModel($pdo);
                    $cliente = $buscaCliente->getCliente($id);

                    // Echo json_encode($cliente);
                    if(!$cliente){
                        $errorMessage = "Cliente não encontrado!";
                        $successMessage = null;
                    }else{
                        $successMessage = "Cliente encontrado com sucesso!";
                        $errorMessage= null;
                    }

                } catch (PDOException $e) {
                    // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                    error_log('DB error in clientes: ' . $e->getMessage());

                    // Opcional: definir uma mensagem genérica para exibir na UI
                    $errorMessage = 'Erro ao buscar cliente. Contate o administrador.';
                }
            }

            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de cliente com os dados necessários.
             *
             * @var string $view - Nome da pedidos a ser renderizada -> [ cliente ]
             * @var string $successMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var string $errorMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var array $cliente - Mensagem a ser exibida na página  -> [ $cliente ]
             */
            // Renderiza a view com os dados

            RenderView::renderPage($view, [
                'cliente'=> $cliente,
                'successMessage' => $successMessage,
                'errorMessage' => $errorMessage
            ]);

            exit;
        }
    }
?>
