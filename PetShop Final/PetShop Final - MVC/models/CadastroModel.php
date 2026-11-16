  <?php
    class CadastroModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
        public function verificaEmailExiste($email){
                $stmt =  $this->db->prepare("SELECT id_usuario FROM Usuario WHERE email = :email");
                $stmt->bindValue(':email', $email, PDO::PARAM_STR);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                return $resultado ? true : false;
        }
        public function setNovoUsuario($nome, $data_nascimento, $email, $senha_hash){
                $stmt =  $this->db->prepare("INSERT INTO Usuario (nome, data, email, senha) VALUES (:nome, :data, :email, :senha)");
                $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
                $stmt->bindValue(':data', $data_nascimento, PDO::PARAM_STR);
                $stmt->bindValue(':email', $email, PDO::PARAM_STR);
                $stmt->bindValue(':senha', $senha_hash, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->rowCount();
        }
    }
?>