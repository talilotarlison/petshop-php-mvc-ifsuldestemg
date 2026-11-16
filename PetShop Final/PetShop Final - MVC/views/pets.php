<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os Pets - Petshop</title>
    <!-- Inclui Boxicons para os ícones, pois são leves e modernos (alternativa ao Lucide/FontAwesome) -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../public/css/pets.css">
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
            <a href="./pets" class="nav-link active">
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
            <h2>Todos os Pets</h2>

            <!-- Link de cadastrar cliente -->
            <a class="period-selector" href="./newPet" style="text-decoration: none;">
                Cadastrar Pet
                <i class='bx bx-plus'></i> <!-- Ícone de mais -->
            </a>
        </header>

        <!-- Seção de Tabela -->
        <section class="table-section">
            <!-- Container da Tabela -->
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width: 80px;">Código</th>
                            <th>Nome</th>
                            <th>Espécie</th>
                            <th>Raça</th>
                            <th>Responsável</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <?=isset($getTodosPets) && count($getTodosPets) > 0 ? "" : "<tr><td>Lista vazia!!</td></tr>"?>
                        <!-- As linhas serão inseridas aqui -->
                        <?php foreach ($getTodosPets as $pet): ?>
                            <tr>
                                <td><?= htmlspecialchars($pet['id_registro']) ?></td>
                                <td><?= htmlspecialchars($pet['nome_pet']) ?></td>
                                <td><?= htmlspecialchars($pet['especie']) ?></td>
                                <td><?= htmlspecialchars($pet['raca']) ?></td>
                                <td><?= htmlspecialchars($pet['nome_cliente']) ?></td>
                                <td>
                                    <a href="verPet?id=<?=htmlspecialchars($pet['id_registro']);?>" class="edit-button visualizar">
                                        <i class="bx bx-show"></i> Ver
                                    </a>
                                    <a href="editPet?id=<?= urlencode($pet['id_registro']) ?>" class="edit-button">
                                        <i class='bx bx-edit'></i> Editar
                                    </a>
                                    <form action="./excluirPet" method="POST" class="edit-button excluir-btn">
                                        <input type="hidden" name="id_pet" value="<?=($pet['id_registro'] ?? '')?>">
                                        <input type="hidden" name="cpf_cliente" value="<?=($pet['dono'] ?? '')?>">
                                        <button type="submit" class="btn-submit"
                                            onclick="return confirm('Tem certeza que deseja excluir este Pet? Exclui todos os dados relacionados ao Pet.')">
                                             <i class="bx bx-trash"></i>Excluir
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