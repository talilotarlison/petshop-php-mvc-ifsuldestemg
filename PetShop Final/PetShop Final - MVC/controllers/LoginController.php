<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once('database/conection.php');
    include_once 'models/loginModel.php';
    include_once 'services/renderView.php';
    include_once 'services/middlewareAuth.php';

    class LoginController {
        public function handle($view){

            session_start();
           // se tiver logado redirecionar para dashboard
            MiddlewareAuth::isAuthenticated('/dashboard');

            // Inicializa a mensagem
            $mensagem = "";

            // Verifica se o formulário foi enviado
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                // Conecta ao banco SQLite
                $db = Database::getConnection();

                // Pega os dados do formulário
                $email = trim($_POST['email']);
                $senha = $_POST['senha'];

                // Consulta o usuário pelo email
                $buscaUsuario = new LoginModel($db);
                $usuario =  $buscaUsuario->getUsuarioDadosPorEmail($email );

                if ($usuario && password_verify($senha, $usuario['senha'])) {
                    // Login bem-sucedido
                    $_SESSION['login'] = $usuario['id_usuario'];
                    $_SESSION['usuario_nome'] = $usuario['nome'];
                    $mensagem = "Login realizado com sucesso!";

                    // Redireciona para uma página protegida, ex: dashboard.php
                    RenderView::renderRouter('./dashboard');
                    exit;
                } else {
                    // Login falhou
                    $mensagem = "Email ou senha incorretos!";
                }

                // Redireciona para a mesma página para evitar reenvio do formulário
            }

            // Inclue a rederização da view juntamente com os dados do banco
             /**
             * Renderiza a página de visualização (view) com os dados fornecidos
             * Renderiza a view de login com os dados necessários.
             *
             * @var string $view - Nome da view a ser renderizada -> [ login ]
             * @var string $mensagem - Mensagem a ser exibida na página  -> [ $mensagem ]
             */
            // Renderiza a view com os dados

            RenderView::renderPage($view, [
                'mensagem' => $mensagem
            ]);

            exit;
        }
    }
?>