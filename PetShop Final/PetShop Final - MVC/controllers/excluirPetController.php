<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/excluirPetModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class excluirPetController {
        public function handle($view){
            // dados de login usuario
            // se nao tiver logado redirecionar para login
            MiddlewareAuth::checkAuth('/login');

            $successMessage = "";
            $errorMessage = "";

            // Processo de exclusão do pet
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_pet']) && isset($_POST['cpf_cliente'])) {
                // ID do pet a ser excluído
                $idToDelete = $_POST['id_pet'];
                $cpfToDelete = $_POST['cpf_cliente'];

                try {
                    // Obtém a conexão PDO
                    $pdo = Database::getConnection();

                    // Assegure que o PDO lance exceções (caso getConnection não configure)
                    if ($pdo instanceof PDO) {
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }

                    // Exclui o serviço associado ao cliente
                    $deleteServico = new excluirPetModel($pdo);
                    $deleteServico->deleteServicoPet($idToDelete);
                    // Exclui o pet associado ao cliente
                    $deletePet = new excluirPetModel($pdo);
                    $deletePet->deletePet($idToDelete);
                    // Redireciona de volta para a página de clientes após a exclusão
                    // header("Location: ./pets.php");
                    $successMessage = "Pet Excluido com sucesso!";
                    $errorMessage = null;
                } catch (PDOException $e) {
                    // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                    error_log('DB error in delete Pet: ' . $e->getMessage());

                    // Opcional: definir uma mensagem genérica para exibir na UI
                    $errorMessage = 'Erro ao excluir Pet. Contate o administrador.';
                    $successMessage = null;
                }
            }

            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de excluirPet com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ excluirPet ]
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