<?php
    class editClienteModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
        public function getCliente($id){
            // pegar dados de um cliente
            $queryGetCliente = 'SELECT * FROM Cliente JOIN Endereco ON Cliente.id_cpf = Endereco.id_cpf WHERE Cliente.id_cliente = :id';
            $stmt = $this->db->prepare($queryGetCliente);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        // verifica se cliente exite no banco
        public function verificaSeClienteExiste($formData){
            // Primeiro, verificar se o cliente existe
            $sql = "SELECT id_cliente FROM Cliente WHERE id_cliente = :id_cliente";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_cliente', $formData->id_cliente, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
         }
         // atualiza cliente
        public function updateDadosCliente($formData){
            $queryUpdateCliente = "UPDATE Cliente SET  nome = :nome, telefone = :telefone, email = :email, status = :status WHERE id_cliente = :id_cliente";
            $stmt = $this->db->prepare($queryUpdateCliente);
            $stmt->bindParam(':nome', $formData->nome);
            $stmt->bindParam(':telefone', $formData->telefone);
            $stmt->bindParam(':email', $formData->email);
            $stmt->bindParam(':status', $formData->ativo);
            $stmt->bindParam(':id_cliente', $formData->id_cliente, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
          }

        public function updateEnderecoCliente($formData){
            $queryUpdateEndereco = "UPDATE Endereco SET cidade = :cidade, bairro = :bairro, estado = :estado, cep = :cep, rua = :rua WHERE id_cpf = :cpf";
            $stmt =  $this->db->prepare($queryUpdateEndereco);
            $stmt->bindParam(':cidade', $formData->cidade);
            $stmt->bindParam(':bairro', $formData->bairro);
            $stmt->bindParam(':estado', $formData->estado);
            $stmt->bindParam(':cep', $formData->cep);
            $stmt->bindParam(':rua', $formData->rua);
            $stmt->bindParam(':cpf', $formData->cpf, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
          }
    }

    /**
     * Classe verClienteModel
     *
     * @method mixed getCliente(int $id) Herdado de editClienteModel
     */
    class verClienteModel  extends editClienteModel{

    }
?>