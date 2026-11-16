<?php
class PetsModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
    public function getTodosPets(){
        // busca dados do pets
        $queryBuscarTodosPets = 'SELECT p.id_registro, p.dono, p.nome as nome_pet,  p.especie, p.raca, c.nome as nome_cliente, c.id_cpf as cpf
                FROM Pet AS p
                JOIN Cliente AS c ON p.dono = c.id_cpf ORDER by p.id_registro ASC';
        $stmt = $this->db->prepare($queryBuscarTodosPets);
        $stmt->execute();
        $getTodosPets = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return  $getTodosPets;
    }
}

?>