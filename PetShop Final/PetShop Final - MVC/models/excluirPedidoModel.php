<?php
    class excluirPedidoModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
    public function excluirPedidoId($idToDelete){
            // Exclui o serviço associado ao cliente
            $queryDeleteServico= "DELETE FROM ServicoContratado WHERE id = :id_registro";
            $stmt = $this->db->prepare($queryDeleteServico);
            $stmt->bindParam(':id_registro', $idToDelete, PDO::PARAM_STR);
            $stmt->execute();
    }
}

?>