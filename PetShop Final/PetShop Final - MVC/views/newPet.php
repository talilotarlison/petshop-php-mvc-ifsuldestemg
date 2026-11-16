<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Novo Pet - Petshop</title>
    <!-- Inclui Boxicons para os ícones, pois são leves e modernos (alternativa ao Lucide/FontAwesome) -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../public/css/formPet.css">
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
            <h2>Novo Pet</h2>

            <!-- Link voltar -->
            <a class="period-selector" href="./pets" style="text-decoration: none;">
                Voltar
                <i class='bx bx-arrow-back'></i> <!-- Ícone de seta para a esquerda (voltar) -->
            </a>
        </header>

        <!-- Seção de Tabela -->
        <section class="table-section">
            <!-- Container da Tabela -->
            <div class="table-container">
                <!-- Formulário de Cadastro de Pet -->
                <form action="./newPet" method="POST" class="form-pet">
                    <h3>Cadastro Pet</h3>
                   <span class="success-message">
                        <?php
                        if (isset($successMessage)) {
                            echo htmlspecialchars($successMessage);
                            $successMessage = null; // Limpa a mensagem após exibir
                        }
                        ?>
                    </span>
                    <span class="error-message">
                        <?php
                        if (isset($errorMessage)) {
                            echo htmlspecialchars($errorMessage);
                            $errorMessage = null; // Limpa a mensagem após exibir
                        }
                        ?>
                    </span>
                    <!-- Dados do Pet -->
                    <div class="form-group">
                        <label for="nome_pet">Nome do Pet:</label>
                        <input type="text" id="nome_pet" name="nome_pet" placeholder="Digite o nome do pet" required>
                    </div>

                    <div class="form-group">
                        <label for="especie">Espécie:</label>
                        <input type="text" id="especie" name="especie" placeholder="Digite a espécie (Ex: Cão, Gato)"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="raca">Raça:</label>
                        <input type="text" id="raca" name="raca" placeholder="Digite a raça do pet" required>
                    </div>

                    <!-- Cliente Relacionado -->
                      <div class="form-group">
                        <label for="cliente_nome">Cliente (Responsavel):</label>
                        <select id="cliente_nome" name="cliente_nome" required>
                            <option value="">Selecione um cliente</option>
                            <?php foreach ($getTodosClientes as $cliente): ?>
                                <option
                                    value="<?= htmlspecialchars($cliente['id_cpf']) ?>">
                                    <?= htmlspecialchars($cliente['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div style="font-size: 12px;color: #e617089a;"> Valido apenas Nome de clientes cadastrado no sistema.</div>
                    </div>
                    <!-- cpf -->
                    <div class="form-group">
                        <label for="cliente_id">CPF Cliente:</label>
                        <input type="text" id="cliente_id" name="cliente_id"
                            placeholder="Digite o CPF do cliente (Responsável)" required readonly>
                        <span style="font-size: 12px;color: #e617089a;"> Valido apenas CPF de clientes cadastrado no
                            sistema.</span>
                    </div>

                    <!-- Botão de Enviar -->
                    <div class="form-group">
                        <button type="submit" class="btn-submit">Cadastrar Pet</button>
                        <button type="reset" class="btn-reset" style="background-color: #f0f0f0;color: #333;">Limpar</button>
                    </div>
                </form>

            </div>

        </section>

    </main>

</body>
<script src="../public/js/newPet.js"></script>
</html>