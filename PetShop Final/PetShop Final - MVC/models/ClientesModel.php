<?php
    class ClientesModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
    public function getTodosClientes(){
        // busca todos os cliente
        $queryTodosClientes = 'SELECT * FROM Cliente ORDER BY nome ASC';
        $stmt =  $this->db->prepare($queryTodosClientes);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

 class  ClientesFormNewPetModel extends ClientesModel {
        private $db;
        public function __construct($db){
                $this->db = $db;
            }
        public function getTodosClientes(){
            // busca todos os clientes e lista no formulario de pet
            $query = 'SELECT id_cpf, nome FROM Cliente';
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $getTodosClientesForm = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $getTodosClientesForm;
        }
 }

