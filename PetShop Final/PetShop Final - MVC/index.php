<?php
    require_once __DIR__ . '/controllers/DashboardController.php';
    require_once __DIR__ . '/controllers/ClientesController.php';
    require_once __DIR__ . '/controllers/newClienteController.php';
    require_once __DIR__ . '/controllers/editClienteController.php';
    require_once __DIR__ . '/controllers/excluirClienteController.php';
    require_once __DIR__ . '/controllers/verClienteController.php';
    require_once __DIR__ . '/controllers/PetsController.php';
    require_once __DIR__ . '/controllers/NewPetController.php';
    require_once __DIR__ . '/controllers/EditPetController.php';
    require_once __DIR__ . '/controllers/VerPetController.php';
    require_once __DIR__ . '/controllers/excluirPetController.php';
    require_once __DIR__ . '/controllers/pedidosController.php';
    require_once __DIR__ . '/controllers/newPedidoController.php';
    require_once __DIR__ . '/controllers/editPedidoController.php';
    require_once __DIR__ . '/controllers/verPedidoController.php';
    require_once __DIR__ . '/controllers/excluirPedidoController.php';
    require_once __DIR__ . '/controllers/CadastroController.php';
    require_once __DIR__ . '/controllers/LoginController.php';
    require_once __DIR__ . '/controllers/SairController.php';
    require_once __DIR__ . '/controllers/ErroController.php';
    // require_once __DIR__ . '/controllers/BuscaController.php';

    // Captura a rota da URL
    $request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Define rotas válidas
    $routesValidete = [
        '/dashboard' => 'views/dashboard.php',
        '/clientes' => 'views/clientes.php',
        '/newCliente' => 'views/newCliente.php',
        '/editCliente' => 'views/editCliente.php',
        '/excluirCliente' => 'views/verCliente.php',
        '/verCliente' => 'views/verCliente.php',
        '/pets' => 'views/pets.php',
        '/newPet' => 'views/newPet.php',
        '/editPet' => 'views/editPet.php',
        '/verPet' => 'views/verPet.php',
        '/excluirPet' => 'views/verPet.php',
        '/pedidos' => 'views/pedidos.php',
        '/newPedido' => 'views/newPedido.php',
        '/editPedido' => 'views/editPedido.php',
        '/verPedido'=> 'views/verPedido.php',
        '/excluirPedido'=> 'views/verPedido.php',
        '/cadastro'=> 'views/cadastro.php',
        '/login'=> 'views/login.php',
        '/sair'     => '',
        '/erro'     => 'views/error.php',
        '/' => 'views/login.php', // rota padrão para a raiz
    ];

    // class de rota
    class App {
        public $request;
        public $routesValidete;

        public function __construct($request, $routesValidete) {
            $this->request = $request;
            $this->routesValidete = $routesValidete;
        }


        function routeRequest($myRoute, $Controller) {
            // Remove barra final, exceto para a raiz
            // Normaliza a rota removendo barra final (exceto raiz)
            if ($this->request !== '/' && substr($this->request, -1) === '/') {
                $this->request = rtrim($this->request, '/');
            }

            // Verifica se a rota requisitada existe nas rotas válidas e se é igual à rota esperada
            if (array_key_exists($this->request, $this->routesValidete) && $this->request === $myRoute) {
                $controller = new $Controller();
                $controller->handle($this->routesValidete[$myRoute]);
                exit;
            }else{
                // Se a rota não for encontrada, redireciona para a página de erro
                http_response_code(404);
                include $this->routesValidete['/erro'];
                exit;
            }
        }
    }

    // Instancia a classe de rota
    $app = new App($request, $routesValidete);

    // Verifica e roteia a requisição
    if($request === '/cadastro'){
        /**
         * @var string @router -> [ /cadastro ]
         * */
        $app->routeRequest("/cadastro", "CadastroController");
        exit;
    }

    if($request === '/'){
        /**
         * @var string  @router -> [ / ]
         * */
        $app->routeRequest("/", "LoginController");
        exit;
    }

    if($request === '/login'){
        /**
         * @var string @router -> [ /login ]
         **/
        $app->routeRequest("/login", "LoginController");
        exit;
    }

    if($request === '/sair'){
        /**
         * @var string @router -> [ /sair ]
         * */
        $app->routeRequest("/sair", "SairController");
        exit;
    }

    if($request === '/dashboard'){
        /**
         * @var string @router -> [ /dashboard ]
         * */
        $app->routeRequest("/dashboard", "DashboardController");
        exit;
    }

    if($request === '/clientes'){
        /**
         * @var string @router -> [ /clientes ]
         * */
        $app->routeRequest("/clientes", "ClientesController");
        exit;
    }

    if($request === '/newCliente'){
        /**
         * @var string @router -> [ /newCliente ]
         * */
        $app->routeRequest("/newCliente", "newClienteController");
        exit;
    }

    if($request === '/editCliente'){
        /**
         * @var string @router -> [ /editCliente ]
         **/
        $app->routeRequest("/editCliente", "editClienteController");
        exit;
    }

    if($request === '/verCliente'){
        /**
         * @var string @router -> [ /editCliente ]
         * */
        $app->routeRequest("/verCliente", "verClienteController");
        exit;
    }

    if($request === '/excluirCliente'){
        /**
         * @var string @router -> [ /editCliente ]
         * */
        $app->routeRequest("/excluirCliente", "excluirClienteController");
        exit;
    }

    if($request === '/pets'){
        /**
         * @var string @router -> [ /pets ]
         * */
        $app->routeRequest("/pets", "PetsController");
        exit;
    }

    if($request === '/newPet'){
        /**
         * @var string  @router [ /newPet ]
         */
        $app->routeRequest("/newPet", "NewPetController");
        exit;
    }

    if($request === '/editPet'){
        /**
         * @var string  @router /editPet
         */
        $app->routeRequest("/editPet", "EditPetController");
        exit;
    }

    if($request === '/verPet'){
        /**
         * @var string @router /verPet
         */
        $app->routeRequest("/verPet", "VerPetController");
        exit;
    }

    if($request === '/excluirPet'){
        /**
         * @var string  @router -> [ /excluirPet ]
         * */
        $app->routeRequest("/excluirPet", "excluirPetController");
        exit;
    }

    if($request === '/pedidos'){
        /**
         * @var string  @router -> [ /pedidos ]
         * */
        $app->routeRequest("/pedidos", "pedidosController");
        exit;
    }


    if($request === '/newPedido'){
        /**
         * @var string @router -> [ /newPedido ]
         * */
        $app->routeRequest("/newPedido", "newPedidoController");
        exit;
    }

    if($request === '/editPedido'){
        /**
         * @var string @router -> [ /editPedido ]
         * */
        $app->routeRequest("/editPedido", "editPedidoController");
        exit;
    }

    if($request === '/verPedido'){
        /**
         * @var string @router -> [ /verPedido ]
         * */
        $app->routeRequest("/verPedido", "verPedidoController");
        exit;
    }

    if($request === '/excluirPedido'){
        /**
         * @var string @router -> [ /excluirPedido ]
         */
        $app->routeRequest("/excluirPedido", "excluirPedidoController");
        exit;
    }

    // Verifica se a rota existe nas rotas válidas
    if(!array_key_exists($request, $routesValidete) || $request === '/erro'){
        /**
         * @var string @router -> /erro
         * */
        http_response_code(404);
        $app->routeRequest("/erro", "ErroController");
        exit;
    }

    // Se não encontrar, tenta adicionar uma barra final e procurar novamente
    $altRequest = $request . '/';
    if (array_key_exists($altRequest, $routesValidete)) {
        include $routesValidete[$altRequest];
        exit;
    }

    exit;
?>