<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/newClienteModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class newClienteController {
        public function handle($view){

            // dados de login usuario
            // se nao tiver logado redirecionar para login
            MiddlewareAuth::checkAuth('/login');
            // mensagens do sistema
            $errorMessage = "";
            $successMessage = "";

            // Inicializa com array vazio para evitar warnings caso haja erro
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Aqui você pode processar os dados do formulário enviados via POST

                // Dados do Cliente (sanitizados)
                $cpf = isset($_POST['cpf']) ? trim($_POST['cpf']) : '';
                $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
                $telefone = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
                $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';

                // Endereço do Cliente
                $cidade = isset($_POST['cidade']) ? trim($_POST['cidade']) : '';
                $bairro = isset($_POST['bairro']) ? trim($_POST['bairro']) : '';
                $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';
                $cep = isset($_POST['cep']) ? trim($_POST['cep']) : '';
                $rua = isset($_POST['rua']) ? trim($_POST['rua']) : '';

                // Ativo
                $ativo = isset($_POST['ativo']) ? trim($_POST['ativo']) : '';

                // Cria um "formData" em PHP (array associativo / objeto) para uso posterior
                $formData = (object) [
                    'cpf'      => $cpf,
                    'nome'     => $nome,
                    'telefone' => $telefone,
                    'email'    => $email,
                    'cidade'   => $cidade,
                    'bairro'   => $bairro,
                    'estado'   => $estado,
                    'cep'      => $cep,
                    'rua'      => $rua,
                    'ativo'    => $ativo
                ];
                // Exemplo: transformar em JSON (opcional)
                // $formDataJson = json_encode($formData);

                try {
                    // Aqui você pode processar esses dados, como inseri-los em um banco de dados, etc.
                    // Obtém a conexão PDO
                    $pdo = Database::getConnection();

                    // Assegure que o PDO lance exceções (caso getConnection não configure)
                    if ($pdo instanceof PDO) {
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }

                    // Insere os dados na tabela Cliente
                    $novoCliente = new newClientesModel($pdo);
                    $novoCliente->setNovoCliente($formData);

                    // Insere os dados na tabela Endereco
                    $novoClienteEndereco = new newClientesModel($pdo);
                    $novoClienteEndereco->setNovoClienteEndereco($formData);
                    // mensageem de sucesso
                    $successMessage = "Cliente cadastrado com sucesso!";

                    // echo json_encode($getTodosClientes);
                } catch (PDOException $e) {
                    // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                    error_log('DB error in clientes.php: ' . $e->getMessage());

                    // Opcional: definir uma mensagem genérica para exibir na UI
                    $errorMessage = 'Erro ao adicionar clientes. Contate o administrador.';
                }
            }

            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de newCliente com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ newCliente ]
             * @var string $successMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var string $errorMessage - Mensagem a ser exibida na página  -> [ $successMessage ]
             */
            // Renderiza a view com os dados
   
            RenderView::renderPage($view, [
                'successMessage' => $successMessage,
                'errorMessage' => $errorMessage
            ]);

            exit;

        }
    }
?>
