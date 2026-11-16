<?php
    class newClientesModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
        public function setNovoCliente($formData){
            // Insere os dados na tabela Cliente
            $queryCliente = "INSERT INTO Cliente (id_cpf, nome, telefone, email, status) VALUES ({$formData->cpf}, '{$formData->nome}', '{$formData->telefone}', '{$formData->email}', '{$formData->ativo}');";
            $stmt = $this->db->prepare($queryCliente);
            $stmt->execute();
        }
        public function setNovoClienteEndereco($formData){
            // Insere os dados na tabela Endereco
            $queryEndereco = "INSERT INTO Endereco (id_cpf, cidade, bairro, estado, cep, rua) VALUES ('{$formData->cpf}', '{$formData->cidade}', '{$formData->bairro}', '{$formData->estado}', '{$formData->cep}', '{$formData->rua}');";
            $stmt = $this->db->prepare($queryEndereco);
            $stmt->execute();
        }
    }
?>