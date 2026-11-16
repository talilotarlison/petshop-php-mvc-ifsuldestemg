<?php
    class PedidosModel {
            private $db;
            public function __construct($db){
                $this->db = $db;
            }
        public function getTodosPedidos(){
                // busca dados dos serviços
                $query = 'SELECT s.id,
                                p.nome AS nome_pet,
                                c.nome AS nome_cliente,
                                t.nome AS nome_servico,
                                t.preco AS preco_servico,
                                s.id_cpf,
                                s.descricao,
                                s.DataSolicitada,
                                s.status
                            FROM ServicoContratado AS s
                            JOIN Pet AS p ON s.id_registro = p.id_registro
                            JOIN Cliente AS c ON s.id_cpf = c.id_cpf
                            JOIN TiposDeServicos AS t ON s.id_servico = t.id_servico
                            ORDER BY s.DataSolicitada DESC';
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
    }
?>