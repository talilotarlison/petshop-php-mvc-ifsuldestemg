<?php
    class newPetModel {
            private $db;
            public function __construct($db){
                $this->db = $db;
            }
        public function setNewPet($formData){
            // Insere os dados na tabela Pet
            $queryPet = "INSERT INTO Pet (nome, especie, raca, dono) VALUES ('{$formData->nomePet}', '{$formData->especie}', '{$formData->raca}', '{$formData->donoCPF}');";
            $stmt = $this->db->prepare($queryPet);
            $stmt->execute();
        }
    }