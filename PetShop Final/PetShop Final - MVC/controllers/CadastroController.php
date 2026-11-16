<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/CadastroModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class CadastroController {
        public function handle($view){

            session_start();
           // se tiver logado redirecionar para dashboard
            MiddlewareAuth::isAuthenticated('/dashboard');

            // Mensagem de feedback
            $mensagem = "";

            // Verifica se o formulário foi enviado
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // Conecta ao banco SQLite
                // Obtém a conexão PDO
                $db = Database::getConnection();

                // Pega os dados do formulário
                $nome = trim($_POST['nome']);
                $email = trim($_POST['email']);
                $data_nascimento = $_POST['data-nascimento'];
                $senha = $_POST['senha'];
                $confirmar_senha = $_POST['confirmar-senha'];

                // Valida se as senhas conferem
                if ($senha !== $confirmar_senha) {
                    $mensagem = "As senhas não conferem!";
                } else {
                    // Verifica se o email já existe
                    $verificarEmail = new CadastroModel($db);
                    $emailExiste = $verificarEmail->verificaEmailExiste($email);
                    if ($emailExiste) {
                        $mensagem = "Este email já está cadastrado!";
                    } else {
                        // Hash da senha
                        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

                        // Insere o usuário no banco
                        $novoUsuario = new CadastroModel($db);
                        $adicionadoNovoUsuario =  $novoUsuario->setNovoUsuario($nome, $data_nascimento, $email, $senha_hash);

                        if ($adicionadoNovoUsuario > 0) {
                            $mensagem = "Cadastro realizado com sucesso!";
                            // Armazena a mensagem na sessão para exibir no HTML
                            $_SESSION['mensagem'] = $mensagem;
                            // Salva a mensagem na variavel global
                        } else {
                            $mensagem = "Ocorreu um erro ao cadastrar. Tente novamente.";
                        }
                    }
                }

                // Redireciona para a mesma página para evitar reenvio do formulário
            }

            // Inclue a rederização da view juntamente com os dados do banco

            /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de cadastro com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ cadastro ]
             * @var string $mensagem  Mensagem a ser exibida na página  -> [ $mensagem ]
             */
            RenderView::renderPage($view, [
                'mensagem'=> $mensagem
            ]);
            // Renderiza a view com os dados
            exit;
        }
    }

?>