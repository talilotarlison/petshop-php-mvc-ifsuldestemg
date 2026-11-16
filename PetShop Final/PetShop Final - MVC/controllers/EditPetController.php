<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/editPetModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class EditPetController {
        public function handle($view){

            // Dados de login usuario
            // Se nao tiver logado redirecionar para login
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
                    error_log('DB error in pets: ' . $e->getMessage());

                    // Opcional: definir uma mensagem genérica para exibir na UI
                    $errorMessage = 'Erro ao buscar pets. Contate o administrador.';
                }
             }

            // Processo de atualização do pet
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Aqui você pode processar os dados do formulário enviados via POST

                // Dados do Pet (sanitizados)
                $id_registro = isset($_POST['id_registro']) ? trim($_POST['id_registro']) : '';
                $nome_pet = isset($_POST['nome_pet']) ? trim($_POST['nome_pet']) : '';
                $especie = isset($_POST['especie']) ? trim($_POST['especie']) : '';
                $raca = isset($_POST['raca']) ? trim($_POST['raca']) : '';
                $cliente_id = isset($_POST['cliente_id']) ? trim($_POST['cliente_id']) : '';

                // Cria um "formData" em PHP (array associativo / objeto) para uso posterior
                $formData = (object) [
                    'id_registro' => $id_registro,
                    'nome_pet'    => $nome_pet,
                    'especie'     => $especie,
                    'raca'        => $raca,
                    'cliente_id'  => $cliente_id
                ];
                // Exemplo: transformar em JSON (opcional)
                // $formDataJson = json_encode($formData);
                // echo json_encode($formData);

                try {
                    // Aqui você pode processar esses dados, como inseri-los em um banco de dados, etc.
                    // Obtém a conexão PDO
                    $pdo = Database::getConnection();

                    // Assegure que o PDO lance exceções (caso getConnection não configure)
                    if ($pdo instanceof PDO) {
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }

                    // verifica se tem pet no banco
                    $verificaDadosPet = new editPetModel($pdo);
                    $petExiste =  $verificaDadosPet->verificaSePetExiste($formData);

                    if($petExiste){
                        // Atualizar o pet se existir no banco

                        $verificaDadosPet->updateDadosPet($formData);

                        $successMessage = "Pet atualizado com sucesso!";
                        $errorMessage = null;
                        // Recarrega os dados atualizados para mostrar no formulário
                        // pega dados do pet seleciodo para apresentação
                        $getPetData = new editPetModel($pdo);
                        $pet = $getPetData->getPet($formData->id_registro);

                    }else{
                        $errorMessage = 'Pet não encontrado';
                        $successMessage = null;
                    }

                    // echo json_encode($getTodosClientes);
                } catch (PDOException $e) {
                    // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                    error_log('DB error in pets: ' . $e->getMessage());

                    // Opcional: definir uma mensagem genérica para exibir na UI
                    $errorMessage = 'Erro ao atualizar Pet. Contate o administrador.';
                }

            }
                // Inclue a rederização da view juntamente com os dados do banco
                /**
                 * Renderiza a página de visualização (view) com os dados fornecidos
                 * Renderiza a view de ediPet com os dados necessários.
                 *
                 * @var string $view - Nome da view a ser renderizada -> [ ediPet ]
                 * @var string $successMessage  Mensagem a ser exibida na página  -> [ $successMessage ]
                 * @var string $errorMessage  Mensagem a ser exibida na página  -> [ $errorMessage ]
                 * @var array  $pet  Mensagem a ser exibida na página  -> [ $pet ]
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