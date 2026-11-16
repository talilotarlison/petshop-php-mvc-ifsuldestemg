<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/editClienteModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class editClienteController {
        public function handle($view){
            // Dados de login usuario
            // Se nao tiver logado redirecionar para login
             MiddlewareAuth::checkAuth('/login');

            // mensagens do sistema
            $successMessage = "";
            $errorMessage = "";
            $cliente = "";

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

                    // busca dados do cliente para mostrar na tela
                    $buscaCliente = new editClienteModel($pdo);
                    $cliente = $buscaCliente->getCliente($id);

                    // Echo json_encode($cliente);
                    if(!$cliente){
                        $errorMessage = "Cliente não encontrado!";
                        $successMessage = null;
                    }else{
                        $successMessage = "Cliente encontrado com sucesso!";
                        $errorMessage= null;
                    }

                } catch (PDOException $e) {
                    // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                    error_log('DB error in clientes.php: ' . $e->getMessage());

                    // Opcional: definir uma mensagem genérica para exibir na UI
                    $errorMessage = 'Erro ao buscar cliente. Contate o administrador.';
                }
            }

             // Processo de atualização do cliente
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Aqui você pode processar os dados do formulário enviados via POST

                // Dados do Cliente (sanitizados)
                $id_cliente = isset($_POST['id_cliente']) ? trim($_POST['id_cliente']) : '';
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
                    'id_cliente' => $id_cliente,
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
                    $pdo =  Database::getConnection();

                    // Assegure que o PDO lance exceções (caso getConnection não configure)
                    if ($pdo instanceof PDO) {
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    }

                    // Primeiro, verificar se o cliente existe no banco
                    $verificaCliente = new editClienteModel($pdo);
                    // Tente pegar um único resultado e verificar se existe
                    $clienteExistente = $verificaCliente->verificaSeClienteExiste($formData);
                    if ($clienteExistente) {
                        // Cliente encontrado, pode proceder com a atualização

                        // Atualizar o cliente
                        $verificaCliente = new editClienteModel($pdo);

                        // Atualizar o endereço
                        $verificaClienteEndereco = new editClienteModel($pdo);

                        // var_dump($verificaClienteEndereco->updateEnderecoCliente($formData));
                        // echo json_encode($getTodosClientes);
                        if (($verificaCliente->updateDadosCliente($formData)) > 0 || ($verificaClienteEndereco->updateEnderecoCliente($formData)) > 0) {
                            $successMessage = "Cliente atualizado com sucesso!";
                            $errorMessage = null;

                            // pegar dados pra apresentar no formulario
                            // busca dados do cliente
                            $pdo =  Database::getConnection();

                            $buscaCliente = new editClienteModel($pdo);
                            $cliente = $buscaCliente->getCliente( $formData->id_cliente);
                        } else {
                            $successMessage = "O cliente já estava com os dados atualizados!";
                            $errorMessage = null;
                        }

                    }else{
                        $successMessage = null;
                        $errorMessage= "Cliente não encontrado!";
                    }

                } catch (PDOException $e) {
                    // Loga o erro no log do servidor (não exibe detalhes ao usuário)
                    error_log('DB error in clientes.php: ' . $e->getMessage());

                    // Opcional: definir uma mensagem genérica para exibir na UI
                    $errorMessage = 'Erro ao atualizar cliente. Contate o administrador.';
                }
            }

            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de newCliente com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ newCliente ]
             * @var string $successMessage  Mensagem a ser exibida na página  -> [ $successMessage ]
             * @var string $errorMessage  Mensagem a ser exibida na página  -> [ $errorMessage ]
             * @var array  $cliente  Mensagem a ser exibida na página  -> [ $cliente ]
             */
            // Renderiza a view com os dados

            RenderView::renderPage($view, [
                'cliente'=> $cliente,
                'successMessage' => $successMessage,
                'errorMessage' => $errorMessage
            ]);

            exit;
        }
    }

?>
