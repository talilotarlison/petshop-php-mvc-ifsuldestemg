<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/editPedidoModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class editPedidoController {
        public function handle($view){

            // dados de login usuario
            // se nao tiver logado redirecionar para login
             MiddlewareAuth::checkAuth('/login');

            // dasdos da aplicação
            $successMessage = "";
            $errorMessage = "";
            $servico = "";
            $getTiposPedidos = [];
            // pega dados e mostra no formulario
            try {
                $pdo = Database::getConnection();
                if ($pdo instanceof PDO) {
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }

                // Carregar lista de tipos de serviço para o select
                $todosTiposServicos = new editPedidoModel($pdo);
                $getTiposPedidos =  $todosTiposServicos->getTiposServicoForm();

                // Se for GET, buscar os dados do serviço para mostrar no formulário
                if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                    $id = $_GET['id'];

                    $getServicoId = new editPedidoModel($pdo);
                    $servico = $getServicoId->getServicoForm($id);
                    $successMessage = "Serviço encontrado com sucesso!";

                    if (!$servico) {
                        $errorMessage = "Serviço não encontrado!";
                    }
                }

            } catch (PDOException $e) {
                error_log('DB error in servico.php: ' . $e->getMessage());
                $errorMessage = 'Erro ao acessar banco de dados. Contate o administrador.';
            }

            // Se for POST, atualizar os dados do serviço escolhido
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                try {
                    $pdo = Database::getConnection();
                    if ($pdo instanceof PDO) {
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }
                    // Se for POST, atualizar os dados do serviço
                    // Dados sanitizados
                    $id = $_POST['id'] ?? null;
                    $id_servico = $_POST['id_servico'] ?? null;
                    $valor_servico = $_POST['valor_servico'] ?? null;
                    $descricao_servico = $_POST['descricao_servico'] ?? null;
                    $pet_id = $_POST['pet_id'] ?? null;
                    $cliente_id = $_POST['cliente_id'] ?? null;
                    $data_cadastro = $_POST['data_cadastro'] ?? null;
                    $status = $_POST['status'] ?? null;

                    // Cria um array com os dados
                    $formDataArray = [
                        'id' => $id,
                        'id_servico' => $id_servico,
                        'valor_servico' => $valor_servico,
                        'descricao_servico' => $descricao_servico,
                        'pet_id' => $pet_id,
                        'cliente_id' => $cliente_id,
                        'data_cadastro' => $data_cadastro,
                        'status' => $status
                    ];

                    // Converte o array em objeto com cast (type cast)
                    $formData = (object) $formDataArray;

                    // Atualiza serviço escolhido
                    $updatePedido = new editPedidoModel($pdo);
                    $atualizouPedido = $updatePedido->updateServico($formData);

                    if ($atualizouPedido > 0) {
                        $successMessage = "Serviço atualizado com sucesso!";
                        $errorMessage = null;

                        // Recarrega os dados atualizados para mostrar no formulário
                        $getServicoId = new editPedidoModel($pdo);
                        $servico = $getServicoId->getServicoForm($formData->id);
                    } else {
                        $errorMessage = "Falha ao atualizar o serviço.";
                        $successMessage = null;
                    }

            } catch (PDOException $e) {
                error_log('DB error in servico.php: ' . $e->getMessage());
                $errorMessage = 'Erro ao acessar banco de dados. Contate o administrador.';
            }
        }
            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de newPedido com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ newPedido ]
             * @var string $successMessage  Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var string $errorMessage  Mensagem a ser exibida na página  -> [ $errorMessage ]
             * @var array  $getTiposPedidos  Mensagem a ser exibida na página  -> [ $getTiposPedidos ]
             * @var array  $servico  Mensagem a ser exibida na página  -> [ $servico ]
             */
             // Renderiza a view com os dados

            RenderView::renderPage($view, [
                'getTiposPedidos'=> $getTiposPedidos,
                'servico' => $servico,
                'successMessage' => $successMessage,
                'errorMessage' => $errorMessage
            ]);

            exit;
        }
    }

    ?>