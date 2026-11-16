<?php
    class excluirPetModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
        public function deleteServicoPet($idToDelete){
            // Exclui o serviço associado ao cliente
            $queryDeleteServico= "DELETE FROM ServicoContratado WHERE id_registro = :id_registro";
            $stmt =  $this->db->prepare($queryDeleteServico);
            $stmt->bindParam(':id_registro', $idToDelete, PDO::PARAM_STR);
            $stmt->execute();
        }
        public function deletePet($idToDelete){
            // Exclui o pet associado ao cliente
            $queryDeletePet= "DELETE FROM Pet WHERE id_registro = :id_registro";
            $stmt =  $this->db->prepare($queryDeletePet);
            $stmt->bindParam(':id_registro', $idToDelete, PDO::PARAM_STR);
            $stmt->execute();
        }
    }
?>