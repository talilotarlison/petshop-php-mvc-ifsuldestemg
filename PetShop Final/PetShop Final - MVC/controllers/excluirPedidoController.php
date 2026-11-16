<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/excluirPedidoModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class excluirPedidoController {
        public function handle($view){
            // Dados de login usuario
            // Se nao tiver logado redirecionar para login
            MiddlewareAuth::checkAuth('/login');

            $successMessage = "";
            $errorMessage = "";

            // Processo de exclusão do serviço
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_pedido']) && isset($_POST['cpf_cliente'])) {
                // ID do pet a ser excluído
                $idToDelete = $_POST['id_pedido'];
                $cpfToDelete = $_POST['cpf_cliente'];

                try {
                    // Obtém a conexão PDO
                    $pdo = Database::getConnection();

                    // Assegure que o PDO lance exceções (caso getConnection não configure)
                    if ($pdo instanceof PDO) {
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }

                    // Exclui o serviço associado ao cliente
                    $deleteServico = new excluirPedidoModel($pdo);
                    $deleteServico->excluirPedidoId($idToDelete);
                    // Redireciona de volta para a página de clientes após a exclusão
                    // header("Location: ./pedidos.php");
                    $successMessage = "Serviço Excluido com sucesso!";
                    $errorMessage = null;
                } catch (PDOException $e) {
                    // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                    error_log('DB error in delete Serviço: ' . $e->getMessage());

                    // Opcional: definir uma mensagem genérica para exibir na UI
                    $errorMessage = 'Erro ao excluir Serviço. Contate o administrador.';
                    $successMessage = null;
                }
            }

            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de excluirPedido com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ excluirPedido ]
             * @var string $successMessage  Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var string $errorMessage  Mensagem a ser exibida na página  -> [ $errorMessage ]
             */
            // Renderiza a view com os dados

            RenderView::renderPage($view, [
                'successMessage' => $successMessage,
                'errorMessage' => $errorMessage
            ]);

            exit;
        }
    }