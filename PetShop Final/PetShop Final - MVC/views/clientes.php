<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes - Petshop</title>
    <!-- Inclui Boxicons para os ícones, pois são leves e modernos (alternativa ao Lucide/FontAwesome) -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../public/css/clientes.css">
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
            <a href="./dashboard" class="nav-link">
                <i class='bx bxs-dashboard'></i>
                Dashboard
            </a>
            <a href="./pedidos" class="nav-link ">
                <i class='bx bx-cart'></i>
                Pedidos
            </a>
            <a href="./pets" class="nav-link ">
                <i class='bx bx-home-heart'></i>
                Pets
            </a>
            <a href="./clientes" class="nav-link active">
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
                Gerar Relatorios
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
            <h2>Todos os Clientes</h2>

            <!-- Link de cadastrar cliente -->
            <a class="period-selector" href="./newCliente" style="text-decoration: none;">
                Cadastrar Cliente
                <i class='bx bx-user-plus'></i> <!-- Ícone de adicionar cliente -->
            </a>
        </header>

        <!-- Seção de Tabela -->
        <section class="table-section">
            <!-- Container da Tabela -->
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>CPF</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <!-- As linhas serão inseridas aqui pelo JavaScript -->

                            <!-- se lista vazia -->
                            <?=isset($getTodosClientes) && count($getTodosClientes) > 0 ? "" : "<tr><td>Lista vazia!!</td></tr>";?>
                            <!-- // Supondo que $getTodosClientes é o resultado da consulta SQLite, com os dados já recuperados. -->
                            <?php foreach ($getTodosClientes as $cliente):?>
                                    <tr>
                                        <td><?= htmlspecialchars($cliente['id_cliente']);?></td>
                                        <td><?= htmlspecialchars($cliente['id_cpf']);?></td>
                                        <td><?= htmlspecialchars($cliente['nome']);?></td>
                                        <td><?= htmlspecialchars($cliente['telefone']);?></td>
                                        <td><?= htmlspecialchars($cliente['email']);?></td>
                                        <td><?= htmlspecialchars($cliente['status']);?></td>
                                        <td>
                                            <a href="./verCliente?id=<?=htmlspecialchars($cliente['id_cliente']);?>" class="edit-button visualizar">
                                                <i class="bx bx-show"></i> Ver
                                            </a>
                                            <a href="./editCliente?id=<?=htmlspecialchars($cliente['id_cliente']);?>" class="edit-button">
                                                <i class="bx bx-edit"></i> Editar
                                            </a>
                                            <form action="./excluirCliente" method="POST" class="edit-button excluir-btn">
                                                <input type="hidden" name="id_cliente" value="<?=($cliente['id_cliente'] ?? '')?>">
                                                <input type="hidden" name="cpf_cliente" value="<?=($cliente['id_cpf'] ?? '')?>">
                                                <button type="submit" class="btn-submit" <?=($cliente['status'] == 'Ativo' ? 'disabled' : "")?>
                                                    onclick="return confirm('Tem certeza que deseja excluir este cliente? Exclui todos os dados relacionados ao cliente.');">
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

</html>