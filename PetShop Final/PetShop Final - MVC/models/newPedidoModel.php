<?php
    class newPedidoModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
        public function getTiposPedidosForm(){
            // pega todos os tipos de serviço
            $queryServico = 'SELECT * FROM TiposDeServicos';
            $stmt = $this->db->prepare($queryServico);
            $stmt->execute();
            $getTiposPedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $getTiposPedidos;
        }
        public function getTodosPetsForm(){
            // pega todos os petes
            $queryPets = 'SELECT id_registro, nome FROM Pet';
            $stmt = $this->db->prepare($queryPets);
            $stmt->execute();
            $getTodosPets = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $getTodosPets;
         }
          public function getTodosClientesForm(){
            // pega todos os clientes
            $queryClientes = 'SELECT id_cpf, nome FROM Cliente';
            $stmt = $this->db->prepare($queryClientes);
            $stmt->execute();
            $getTodosClientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return  $getTodosClientes;
        }
        
         public function setNewPedido($formData){
            // Insere os dados na tabela ServicoContratado
            $queryServico = "INSERT INTO ServicoContratado (id_servico, descricao, id_registro, id_cpf, DataSolicitada, status)
                            VALUES (:id_servico, :descricao_servico, :pet_id, :cliente_id, :data_cadastro, :status)";

            $stmt = $this->db->prepare($queryServico);
            $stmt->bindParam(':id_servico', $formData->id_servico, PDO::PARAM_INT);
            $stmt->bindParam(':descricao_servico', $formData->descricao_servico, PDO::PARAM_STR);
            $stmt->bindParam(':pet_id', $formData->pet_id, PDO::PARAM_INT);
            $stmt->bindParam(':cliente_id', $formData->cliente_id, PDO::PARAM_STR);
            $stmt->bindParam(':data_cadastro', $formData->data_cadastro, PDO::PARAM_STR);
            $stmt->bindParam(':status', $formData->status, PDO::PARAM_STR);
            // Executa a query
            $stmt->execute();
        }
    }
?>
