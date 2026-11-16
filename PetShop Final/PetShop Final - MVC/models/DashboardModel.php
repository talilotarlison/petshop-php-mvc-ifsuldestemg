  <?php
    class DashboardModel {
        private $db;
        public function __construct($db){
            $this->db = $db;
        }
        public function getTotalCliente(){
                // busca total cliente
                $queryTotalCliente = 'SELECT COUNT(*) AS totalCliente from Cliente';
                $stmt =  $this->db->prepare($queryTotalCliente);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getTotalDeAtendimentos(){
                // busca total de atendimentos
                $queryTotalAtendimentos = 'SELECT COUNT(*) AS totalAtendimentos from ServicoContratado';
                $stmt = $this->db->prepare($queryTotalAtendimentos);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function getTotalAtendimentosConcluidos(){
             // busca total de atendimentos concluidos
                $queryTotalAtendimentosConcluidos = 'SELECT COUNT(*) AS totalAtendimentosConcluidos from ServicoContratado  WHERE status = "Concluído"';
                $stmt = $this->db->prepare($queryTotalAtendimentosConcluidos);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
         public function getTotalAtendimentosAndamento(){
                // busca total de atendimentos em andamento
                $queryTotalAtendimentosAndamento = 'SELECT COUNT(*) AS totalAtendimentosAndamento from ServicoContratado  WHERE status = "Em andamento"';
                $stmt = $this->db->prepare($queryTotalAtendimentosAndamento);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
         }
          public function getTotalAtendimentosPendente(){
                // busca total de atendimentos em andamento
                $queryTotalAtendimentosPendente = 'SELECT COUNT(*) AS totalAtendimentosPendente from ServicoContratado  WHERE status = "Pendente"';
                $stmt = $this->db->prepare($queryTotalAtendimentosPendente);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
          }
          public function getTodosServicosConcluidos(){
                // todos os serviços concluidos
                $queryTodosServicosConcluidos = 'SELECT s.id,
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
                            WHERE s.status = "Concluído"
                            ORDER BY s.DataSolicitada DESC';
                $stmt = $this->db->prepare($queryTodosServicosConcluidos);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
          }
    }




