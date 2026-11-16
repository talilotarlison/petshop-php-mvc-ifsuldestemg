<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/ClientesModel.php';
    include_once 'models/newPetModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class newPetController {
        public function handle($view){

            // dados de login usuario
            // se nao tiver logado redirecionar para login
            MiddlewareAuth::checkAuth('/login');

            // Inicializa com array vazio para evitar warnings caso haja erro
            $getTodosClientes = [];
            $errorMessage = "";
            $successMessage = "";
            // pega todos os clientes
            try {
                // Obtém a conexão PDO
                $pdo = Database::getConnection();

                // Assegure que o PDO lance exceções (caso getConnection não configure)
                if ($pdo instanceof PDO) {
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                // busca todos os clientes pra exibir no formulario
                $getTodosClientesForm = new ClientesFormNewPetModel($pdo);
                $getTodosClientes = $getTodosClientesForm->getTodosClientes();

                // echo json_encode($getTodosClientes); // Para depuração rápida
            } catch (PDOException $e) {
                // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                error_log('DB error in pets.php: ' . $e->getMessage());

                // Opcional: definir uma mensagem genérica para exibir na UI
                $errorMessage = 'Erro ao carregar Clientes. Contate o administrador.';
            }

            // Inicializa com array vazio para evitar warnings caso haja erro
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Aqui você pode processar os dados do formulário enviados via POST

                // Dados do Pet (sanitizados)
                $nomePet = isset($_POST['nome_pet']) ? trim($_POST['nome_pet']) : '';
                $especie = isset($_POST['especie']) ? trim($_POST['especie']) : '';
                $raca = isset($_POST['raca']) ? trim($_POST['raca']) : '';
                $donoCPF = isset($_POST['cliente_id']) ? trim($_POST['cliente_id']) : '';

                // Cria um "formData" em PHP (array associativo / objeto) para uso posterior
                $formData = (object) [
                    'nomePet'     => $nomePet,
                    'especie'  => $especie,
                    'raca'     => $raca,
                    'donoCPF'     => $donoCPF
                ];
                // Exemplo: transformar em JSON (opcional)
                // $formDataJson = json_encode($formData);

                try {
                    // Aqui você pode processar esses dados, como inseri-los em um banco de dados, etc.
                    // Obtém a conexão PDO
                    $pdo =  Database::getConnection();

                    // Assegure que o PDO lance exceções (caso getConnection não configure)
                    if ($pdo instanceof PDO) {
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }

                    // Insere os dados na tabela Pet
                    $newPet = new newPetModel($pdo);
                    $newPet->setNewPet($formData);

                    $successMessage = "Pet cadastrado com sucesso!";

                    // echo json_encode($getTodosPets); // Para depuração rápida
                } catch (PDOException $e) {
                    // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                    error_log('DB error in Pets: ' . $e->getMessage());

                    // Opcional: definir uma mensagem genérica para exibir na UI
                    $errorMessage = 'Erro ao adicionar Pet. CPF do cliente inválido. Contate o administrador.';
                }
        }

            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de newPet com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ newPet ]
             * @var string $successMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var string $errorMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var array $getTodosClientes - Mensagem a ser exibida na página  -> [ $getTodosClientes ]
             */
            // Renderiza a view com os dados

            RenderView::renderPage($view, [
                'successMessage' => $successMessage,
                'errorMessage' => $errorMessage,
                'getTodosClientes' => $getTodosClientes
            ]);

        }
    }