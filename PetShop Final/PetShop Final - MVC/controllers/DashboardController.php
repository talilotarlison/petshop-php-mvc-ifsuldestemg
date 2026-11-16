<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/DashboardModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class DashboardController {
        public function handle($view){

            // Dados de login usuario
           // se nao tiver logado redirecionar para login
             MiddlewareAuth::checkAuth('/login');

            // dados dashboard
            $dashboard = (object) [
                'totalCliente'      => 0,
                'totalAtendimentos' => 0,
                'concluidos'        => 0,
                'emAndamento'       => 0,
                'pendente'          => 0
            ];

            // Inicializa com array vazio para evitar warnings caso haja erro
            $getTodosPedidos = [];
            $successMessage = "";
            $errorMessage = "";

            try {
                // Obtém a conexão PDO
                $pdo = Database::getConnection();

                // Assegure que o PDO lance exceções (caso getConnection não configure)
                if ($pdo instanceof PDO) {
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                // busca total cliente
                $totalDeClientes = new DashboardModel($pdo);
                $dashboard->totalCliente = $totalDeClientes->getTotalCliente();

                // busca total de atendimentos
                $totalAtendimentos = new DashboardModel($pdo);
                $dashboard->totalAtendimentos = $totalAtendimentos->getTotalDeAtendimentos();

                // busca total de atendimentos concluidos
                $totalAtendimentosConcluidos = new DashboardModel($pdo);
                $dashboard->concluidos = $totalAtendimentosConcluidos->getTotalAtendimentosConcluidos();

                // busca total de atendimentos em andamento
                $totalAtendimentosAndamento = new DashboardModel($pdo);
                $dashboard->emAndamento = $totalAtendimentosAndamento->getTotalAtendimentosAndamento();

                // busca total de atendimentos em andamento
                $totalAtendimentosPendente = new DashboardModel($pdo);
                $dashboard->pendente =  $totalAtendimentosPendente->getTotalAtendimentosPendente();

                // todos os serviços concluidos
                $TodosServicosConcluidos = new DashboardModel($pdo);
                $getTodosPedidos = $TodosServicosConcluidos->getTodosServicosConcluidos();

                // echo json_encode($getTodosPedidos); // Para depuração rápida
            } catch (PDOException $e) {
                // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                error_log('DB error in pedidos: ' . $e->getMessage());

                // Opcional: definir uma mensagem genérica para exibir na UI
                $errorMessage = 'Erro ao carregar pedidos. Contate o administrador.';
            }

            // Inclue a rederização da view juntamente com os dados do banco
            /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de dashboard com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ dashboard ]
             * @var string $successMessage  Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var string $errorMessage  Mensagem a ser exibida na página  -> [ $errorMessage ]
             * @var array  $getTodosPedidos  Mensagem a ser exibida na página  -> [ $getTodosPedidos ]
             * @var array  $dashboardData  Mensagem a ser exibida na página  -> [ $dashboardData ]
             */
            // Renderiza a view com os dados
            RenderView::renderPage($view, [
                'dashboard' => $dashboard,
                'successMessage' => $successMessage,
                'errorMessage' => $errorMessage,
                'getTodosPedidos' => $getTodosPedidos
            ]);

            exit;
        }
    }

?>
