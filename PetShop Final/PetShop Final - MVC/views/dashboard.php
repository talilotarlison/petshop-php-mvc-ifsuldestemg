<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrativo - Petshop</title>
    <!-- Inclui Boxicons para os ícones, pois são leves e modernos (alternativa ao Lucide/FontAwesome) -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../public/css/dashboard.css">
</head>

<body>
    <!-- Botão de Menu para Mobile -->
    <button class="menu-button" style="display: none;"
        onclick="document.querySelector('.sidebar').classList.toggle('open')">
        <i class='bx bx-menu'></i>
    </button>

    <!-- 1. Sidebar de Navegação (Esquerda) -->
    <aside class="sidebar">

        <!-- Header da Empresa -->
        <div class="sidebar-header">
            <h1>Company Petshop</h1>
        </div>

        <!-- Links Principais -->
        <nav class="sidebar-nav">

            <!-- Grupo Principal -->
            <a href="./dashboard" class="nav-link active">
                <i class='bx bxs-dashboard'></i>
                Dashboard
            </a>
            <a href="./pedidos" class="nav-link">
                <i class='bx bx-cart'></i>
                Pedidos
            </a>
            <a href="./pets" class="nav-link">
                <i class='bx bx-home-heart'></i>
                Pets
            </a>
            <a href="./clientes" class="nav-link">
                <i class='bx bx-group'></i>
                Clientes
            </a>
            <a href="#" class="nav-link">
                <i class='bx bx-list-ul'></i>
                Buscar
            </a>
            <a href="#" class="nav-link">
                <i class='bx bx-zap'></i>
                Integrações
            </a>

            <!-- Linha Divisória para Relatórios Salvos -->
            <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(255, 255, 255, 0.1);"></div>

            <!-- Relatórios Salvos -->
            <div class="sidebar-subtitle">
                Gerar Relatórios
            </div>

            <div style="margin-top: 4px;">
                <a href="#" class="nav-link-sub">
                    Mês atual
                </a>
                <a href="#" class="nav-link-sub">
                    Mês anterior
                </a>
                <a href="#" class="nav-link-sub">
                    Ano atual
                </a>

            </div>
        </nav>

        <!-- Links de Utilidade (Rodapé) -->
        <div class="sidebar-footer">
            <a href="#" class="nav-link">
                <i class='bx bx-cog'></i>
                Configurações
            </a>
            <a href="./sair" class="nav-link">
                <i class='bx bx-log-out'></i>
                Sair
            </a>
        </div>

    </aside>

    <!-- 2. Conteúdo Principal (Direita) -->
    <main class="main-content">

        <!-- Header do Conteúdo -->
        <header class="content-header">
            <h2>Dashboard</h2>

            <!-- Seletor de Período -->

            <div class="period-selector">
                <select name="select" class="select-data">
                    <option value="1" selected>Listar Todos </option>
                    <option value="2">Listar Concluídos </i></option>
                    <option value="3">Listar em Andamento</i></option>
                </select>
                <i class='bx bx-calendar'></i>
            </div>
        </header>

        <!-- Seção de Tabela -->
        <section>
            <div class="dashboard">
                <h2><i class='bx bx-bar-chart'></i> Painel de Atendimentos</h2>

                <!-- Total de Clientes -->
                <div class="bar-container">
                    <div class="bar-label"><i class='bx bx-user'></i>Total de Clientes: <?=$dashboard->totalCliente[0]['totalCliente'];?></div>
                    <div class="bar">
                        <div class="bar-fill clientes"> <?=$dashboard->totalCliente[0]['totalCliente'];?></div>
                    </div>
                </div>

                <!-- Total de Atendimentos -->
                <div class="bar-container">
                    <div class="bar-label"><i class='bx bx-notepad'></i>Total de Atendimentos: <?=$dashboard->totalAtendimentos[0]['totalAtendimentos'];?></div>
                    <div class="bar">
                        <div class="bar-fill atendimentos"><?=$dashboard->totalAtendimentos[0]['totalAtendimentos'];?></div>
                    </div>
                </div>

                <!-- Atendimentos Concluídos -->
                <div class="bar-container">
                    <div class="bar-label"><i class='bx bx-check-circle'></i>Concluídos: <?=$dashboard->concluidos[0]['totalAtendimentosConcluidos'];?></div>
                    <div class="bar">
                        <div class="bar-fill concluidos"><?=$dashboard->concluidos[0]['totalAtendimentosConcluidos'];?></div>
                    </div>
                </div>
                <!-- Atendimentos Em andamento-->
                <div class="bar-container">
                    <div class="bar-label"><i class='bx bx-hourglass'></i> Em Andamento: <?=$dashboard->emAndamento[0]['totalAtendimentosAndamento'];?></div>
                    <div class="bar">
                        <div class="bar-fill andamento"><?=$dashboard->emAndamento[0]['totalAtendimentosAndamento'];?></div>
                    </div>
                </div>
                <!-- Aguardando busca do pet-->
                <div class="bar-container">
                    <div class="bar-label"><i class='bx bx-time'></i>Pedentes: <?=$dashboard->pendente[0]['totalAtendimentosPendente'];?></div>
                    <div class="bar">
                        <div class="bar-fill pendente"><?=$dashboard->pendente[0]['totalAtendimentosPendente'];?></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="table-section">
            <h3>Ultimos concluidos </h3>

            <!-- Container da Tabela -->
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>Pet</th>
                            <th>Cliente</th>
                            <th>Tipo Serviço</th>
                            <th>Preço</th>
                            <th>Agendado(Data/Hora)</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                         <?=isset($getTodosPedidos) && count($getTodosPedidos) > 0 ? "" : "<tr><td>Lista vazia!!</td></tr>"?>
                        <!-- As linhas serão inseridas aqui pelo php -->
                             <?php foreach ($getTodosPedidos as $pedido): ?>
                                <tr>
                                    <td><?= htmlspecialchars($pedido['id']) ?></td>
                                    <td><?= htmlspecialchars($pedido['nome_pet']) ?></td>
                                    <td><?= htmlspecialchars($pedido['nome_cliente']) ?></td>
                                    <td><?= htmlspecialchars($pedido['nome_servico']) ?></td>
                                    <td>R$ <?= number_format($pedido['preco_servico'], 2, ',', '.') ?></td>
                                    <td><?= date('d/m/Y - H:i', strtotime($pedido['DataSolicitada'])) ?></td>
                                    <td><?= htmlspecialchars($pedido['status']) ?></td>
                                    <td>
                                    <a href="verPedido?id=<?=htmlspecialchars($pedido['id']);?>" class="edit-button visualizar">
                                        <i class="bx bx-show"></i> Ver
                                    </a>
                                        <a href="editPedido?id=<?= urlencode($pedido['id']) ?>" class="edit-button">
                                            <i class='bx bx-edit'></i> Editar
                                        </a>
                                        <form action="./excluirPedido" method="POST" class="edit-button excluir-btn">
                                            <input type="hidden" name="id_pedido" value="<?=($pedido['id'] ?? '')?>">
                                            <input type="hidden" name="cpf_cliente" value="<?=($pedido['id_cpf'] ?? '')?>">
                                            <button type="submit" class="btn-submit"
                                                onclick="return confirm('Tem certeza que deseja excluir este pedido?')">
                                                <i class="bx bx-trash"></i> Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </section>

    </main>
</body>
<script src="../public/js/dashboard.js"></script>
</html>