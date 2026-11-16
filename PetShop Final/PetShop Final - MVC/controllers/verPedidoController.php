<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/editPedidoModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class verPedidoController {
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
                error_log('DB error in servico: ' . $e->getMessage());
                $errorMessage = 'Erro ao acessar banco de dados. Contate o administrador.';
            }

            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de verPedido com os dados necessários.
             *
             * @var string $view - Nome da pedidos a ser renderizada -> [ verPedido ]
             * @var string $successMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var string $errorMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var array $servico - Mensagem a ser exibida na página  -> [ $servico ]
             * @var array $getTiposPedidos - Mensagem a ser exibida na página  -> [ $getTiposPedidos ]
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
