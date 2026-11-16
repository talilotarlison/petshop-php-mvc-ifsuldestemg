<?php
    class excluirClientesModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
        public function deleteServicoCliente($cpfToDelete){
            // Exclui o serviço associado ao cliente
            $queryDeleteServico= "DELETE FROM ServicoContratado WHERE id_cpf = :id_cpf";
            $stmt =  $this->db->prepare($queryDeleteServico);
            $stmt->bindParam(':id_cpf', $cpfToDelete, PDO::PARAM_STR);
            $stmt->execute();
        }

        public function deletePetCliente($cpfToDelete){
            // Exclui o pet associado ao cliente
            $queryDeletePet= "DELETE FROM Pet WHERE dono = :id_cpf";
            $stmt =  $this->db->prepare($queryDeletePet);
            $stmt->bindParam(':id_cpf', $cpfToDelete, PDO::PARAM_STR);
            $stmt->execute();
        }
         public function deleteEnderecoCliente($cpfToDelete){
            // Exclui o endereço da tabela Endereco
            $queryDeleteEndereco = "DELETE FROM Endereco WHERE id_cpf = :id_cpf";
            $stmt = $this->db->prepare($queryDeleteEndereco);
            $stmt->bindParam(':id_cpf', $cpfToDelete, PDO::PARAM_STR);
            $stmt->execute();
         }
          public function deleteCliente($idToDelete){
            // Exclui o cliente da tabela Cliente
            $queryDeleteCliente = "DELETE FROM Cliente WHERE id_cliente = :id";
            $stmt =  $this->db->prepare($queryDeleteCliente);
            $stmt->bindParam(':id', $idToDelete, PDO::PARAM_INT);
            $stmt->execute();
          }
    }
?>

