  <?php
    class LoginModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
        public function getUsuarioDadosPorEmail($email){
            $stmt = $this->db->prepare("SELECT id_usuario, nome, senha FROM Usuario WHERE email = :email");
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario;

        }
    }

    ?>