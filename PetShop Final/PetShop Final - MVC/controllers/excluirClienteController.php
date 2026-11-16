<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/excluirClienteModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class excluirClienteController {
        public function handle($view){
            // Dados de login usuario
            // Se nao tiver logado redirecionar para login
            MiddlewareAuth::checkAuth('/login');

            $successMessage = "";
            $errorMessage = "";
            // Processo de exclusão do cliente
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_cliente']) && isset($_POST['cpf_cliente'])) {
                // ID do cliente a ser excluído
                $idToDelete = $_POST['id_cliente'];
                $cpfToDelete = $_POST['cpf_cliente'];

                try {
                    // Obtém a conexão PDO
                    $pdo = Database::getConnection();

                    // Assegure que o PDO lance exceções (caso getConnection não configure)
                    if ($pdo instanceof PDO) {
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }

                    // Exclui o serviço associado ao cliente
                    $deleteServico = new excluirClientesModel($pdo);
                    $deleteServico->deleteServicoCliente($cpfToDelete);

                    // Exclui o pet associado ao cliente
                    $deletePet = new excluirClientesModel($pdo);
                    $deletePet->deletePetCliente($cpfToDelete);

                    // Exclui o endereço da tabela Endereco
                    $deleteEndereco = new excluirClientesModel($pdo);
                    $deleteEndereco->deleteEnderecoCliente($cpfToDelete);

                    // Exclui o cliente da tabela Cliente
                    $deleteCliente = new excluirClientesModel($pdo);
                    $deleteCliente->deleteCliente($idToDelete);

                    // Redireciona de volta para a página de clientes após a exclusão
                    // header("Location: ./clientes.php");
                    $successMessage = "Cliente Excluido com sucesso!";
                    $errorMessage = null;

                } catch (PDOException $e) {
                    // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                    error_log('DB error in delete cliente: ' . $e->getMessage());

                    // Opcional: definir uma mensagem genérica para exibir na UI
                    $errorMessage = 'Erro ao excluir cliente. Contate o administrador.';
                }
            }

            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de newPedido com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ excluirCliente ]
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