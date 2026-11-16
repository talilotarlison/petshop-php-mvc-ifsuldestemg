<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/newPedidoModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class newPedidoController {
        public function handle($view){

            // Dados de login usuario
            // Se nao tiver logado redirecionar para login
            MiddlewareAuth::checkAuth('/login');

            // Inicializa com array vazio para evitar warnings caso haja erro
            $getTiposPedidos = [];
            $getTodosClientes = [];
            $getTodosPets = [];
            $errorMessage = "";
            $successMessage = "";
            // dados para listar no select do dormulario
            try {
                // Obtém a conexão PDO
                $pdo =  Database::getConnection();

                // Assegure que o PDO lance exceções (caso getConnection não configure)
                if ($pdo instanceof PDO) {
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                // pega todos os tipos de serviço
                $tiposServicos = new newPedidoModel($pdo);
                $getTiposPedidos = $tiposServicos->getTiposPedidosForm();
                // pega todos os petes
                $todospets = new newPedidoModel($pdo);
                $getTodosPets = $todospets->getTodosPetsForm();
                // pega todos os clientes
                $todosClientes = new newPedidoModel($pdo);
                $getTodosClientes = $todosClientes->getTodosClientesForm();

                // echo json_encode($getTiposPedidos); // Para depuração rápida
            } catch (PDOException $e) {
                // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                error_log('DB error in pedidos.php: ' . $e->getMessage());

                // Opcional: definir uma mensagem genérica para exibir na UI
                $errorMessage = 'Erro ao carregar tipos de serviço. Contate o administrador.';
            }

            // Inicializa com array vazio para evitar warnings caso haja erro
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Dados do Serviço (sanitizados)
                $id_servico = isset($_POST['id_servico']) ? trim($_POST['id_servico']) : '';
                $descricao_servico = isset($_POST['descricao_servico']) ? trim($_POST['descricao_servico']) : '';
                $pet_id = isset($_POST['pet_id']) ? trim($_POST['pet_id']) : '';
                $cliente_id = isset($_POST['cliente_id']) ? trim($_POST['cliente_id']) : '';
                $data_cadastro = isset($_POST['data_cadastro']) ? trim($_POST['data_cadastro']) : '';
                $status = isset($_POST['status']) ? trim($_POST['status']) : '';

                // Cria um "formData" em PHP (array associativo / objeto) para uso posterior
                $formData = (object) [
                    'id_servico'      => $id_servico,
                    'descricao_servico' => $descricao_servico,
                    'pet_id'          => $pet_id,
                    'cliente_id'      => $cliente_id,
                    'data_cadastro'   => $data_cadastro,
                    'status'          => $status
                ];

                try {
                    // Obtém a conexão PDO
                    $pdo =  Database::getConnection();

                    // Assegure que o PDO lance exceções (caso getConnection não configure)
                    if ($pdo instanceof PDO) {
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }

                    // Insere os dados na tabela ServicoContratado
                    $novoServico = new newPedidoModel($pdo);
                    $novoServico ->setNewPedido($formData);

                    $successMessage = "Serviço cadastrado com sucesso!";
                } catch (PDOException $e) {
                    // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                    error_log('DB error in cadastrar_servico: ' . $e->getMessage());

                    // Opcional: definir uma mensagem genérica para exibir na UI
                    $errorMessage = 'Erro ao adicionar o serviço. Contate o administrador.';
                }
            }

            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de newPedido com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ newPedido ]
             * @var string $successMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var string $errorMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var array $getTodosPets - Mensagem a ser exibida na página  -> [ $getTodosPets ]
             * @var array $getTodosClientes - Mensagem a ser exibida na página  -> [ $getTodosClientes ]
             * @var array $getTiposPedidos - Mensagem a ser exibida na página  -> [ $getTiposPedidos ]
             */
            // Renderiza a view com os dados

            RenderView::renderPage($view, [
                'getTiposPedidos'=> $getTiposPedidos,
                'getTodosClientes' => $getTodosClientes,
                'getTodosPets'=> $getTodosPets,
                'successMessage' => $successMessage,
                'errorMessage' => $errorMessage
            ]);

            exit;
        }
    }

?>