<?php
    class editPedidoModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
        public function getTiposServicoForm(){
            // Carregar lista de tipos de serviço para o select
            $stmt = $this->db->query("SELECT * FROM TiposDeServicos");
            $getTiposPedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $getTiposPedidos;
        }

        public function getServicoForm($id){
            $query = "SELECT s.*, t.nome AS nome_servico, t.preco AS preco_servico
                    FROM ServicoContratado s
                    JOIN TiposDeServicos t ON s.id_servico = t.id_servico
                    WHERE s.id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $servico = $stmt->fetch(PDO::FETCH_ASSOC);
            return $servico;
        }
        public function updateServico($formData){
            // Atualiza serviço escolhido
            $updateQuery = "UPDATE ServicoContratado SET
                id_servico = :id_servico,
                descricao = :descricao,
                id_registro = :pet_id,
                id_cpf = :cliente_id,
                DataSolicitada = :data_cadastro,
                status = :status
                WHERE id = :id";

            $stmt =  $this->db->prepare($updateQuery);
            $stmt->bindParam(':id_servico', $formData->id_servico, PDO::PARAM_INT);
            $stmt->bindParam(':descricao', $formData ->descricao_servico);
            $stmt->bindParam(':pet_id', $formData->pet_id, PDO::PARAM_INT);
            $stmt->bindParam(':cliente_id', $formData->cliente_id);
            $stmt->bindParam(':data_cadastro', $formData->data_cadastro);
            $stmt->bindParam(':status', $formData->status);
            $stmt->bindParam(':id', $formData->id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        }
    }
?>