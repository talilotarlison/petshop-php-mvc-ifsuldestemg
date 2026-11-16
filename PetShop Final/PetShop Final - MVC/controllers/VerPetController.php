<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/editPetModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class verPetController {
        public function handle($view){
            // dados de login usuario
            // se nao tiver logado redirecionar para login
            MiddlewareAuth::checkAuth('/login');

            // dados do sistema
            $errorMessage = "";
            $errorMessage= "";
            $pet = "";
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
                    // pega dados do pet seleciodo para apresentação
                    $getPetData = new editPetModel($pdo);
                    $pet = $getPetData->getPet($id);
                    // Echo json_encode($pet);
                    if(!$pet){
                        $errorMessage = "Pet não encontrado!";
                        $successMessage = null;
                    }else{
                        $successMessage = "Pet encontrado com sucesso!";
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
                 * Renderiza a view de ediPet com os dados necessários.
                 *
                 * @var string $view - Nome da pedidos a ser renderizada -> [ ediPet ]
                 * @var string $successMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
                 * @var string $errorMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
                 * @var array $pet - Mensagem a ser exibida na página  -> [ $pet ]
                 */
                // Renderiza a view com os dados

                RenderView::renderPage($view, [
                    'pet'=> $pet,
                    'successMessage' => $successMessage,
                    'errorMessage' => $errorMessage
                ]);

                exit;
        }
    }