<?php
    class editPetModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
        public function getPet($id){
            // pega dados do pet seleciodo para apresentação
            $query = 'SELECT * FROM Pet WHERE id_registro = :id';
            $stmt =$this->db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function verificaSePetExiste($formData){
             // verifica se tem pet no banco
            $query = "SELECT * FROM Pet WHERE id_registro = :id_registro";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id_registro', $formData->id_registro, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        public function updateDadosPet($formData){
            // Atualizar o pet se existir no banco
            $queryPet = "UPDATE Pet SET  nome = :nome, especie = :especie, raca = :raca WHERE id_registro = :id_registro";
            $stmt =  $this->db->prepare($queryPet);
            $stmt->bindParam(':nome', $formData->nome_pet);
            $stmt->bindParam(':especie', $formData->especie);
            $stmt->bindParam(':raca', $formData->raca);
            $stmt->bindParam(':id_registro', $formData->id_registro, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
?>