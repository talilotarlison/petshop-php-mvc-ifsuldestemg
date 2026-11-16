<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente - Petshop</title>
    <!-- Inclui Boxicons para os ícones, pois são leves e modernos (alternativa ao Lucide/FontAwesome) -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../public/css/formCliente.css">
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
            <h2>Atualizar Cliente</h2>

            <!-- Link voltar -->
            <a class="period-selector" href="./clientes" style="text-decoration: none;">
                Voltar
                <i class='bx bx-arrow-back'></i> <!-- Ícone de seta para a esquerda (voltar) -->
            </a>
        </header>

        <!-- Seção de Tabela -->
        <section class="table-section">
            <!-- Container da Tabela -->
            <div class="table-container">
                <!-- Formulário de Cadastro de Cliente -->
                <form action="./editCliente" method="POST" class="form-cliente">
                    <h3>Dados Cliente</h3>
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
                    <!-- Dados do Cliente -->
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" placeholder="Digite o CPF"  value="<?= $cliente['id_cpf'] ?? '' ?>" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" placeholder="Digite o nome completo" value="<?= $cliente['nome'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" placeholder="Digite o telefone" value="<?= $cliente['telefone'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Digite o email" value="<?= $cliente['email'] ?? '' ?>" required>
                    </div>

                    <!-- Endereço do Cliente -->
                    <div class="form-group">
                        <label for="cidade">Cidade:</label>
                        <input type="text" id="cidade" name="cidade" placeholder="Digite a cidade" value="<?= $cliente['cidade'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="bairro">Bairro:</label>
                        <input type="text" id="bairro" name="bairro" placeholder="Digite o bairro" value="<?= $cliente['bairro'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <input type="text" id="estado" name="estado" placeholder="Digite o estado" value="<?= $cliente['estado'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="text" id="cep" name="cep" placeholder="Digite o CEP" value="<?= $cliente['cep'] ?? '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="rua">Rua:</label>
                        <input type="text" id="rua" name="rua" placeholder="Digite o nome da rua" value="<?= $cliente['rua'] ?? '' ?>" required>
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="ativo">Status:</label>
                        <select id="ativo" name="ativo" required>
                            <option value="Ativo" <?= $cliente['status'] == 'Ativo' ? 'selected' : '' ?>>Ativo</option>
                            <option value="Inativo" <?= $cliente['status'] == 'Inativo' ? 'selected' : '' ?>>Inativo</option>
                        </select>
                    </div>
                    <div>
                        <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?? '' ?>">
                    </div>
                    <!-- Botão de Enviar -->
                    <div class="form-group">
                        <button type="submit" class="btn-submit">Atualizar Cliente</button>
                        <a href="./clientes" class="btn-cancel"
                            style="background-color: #9e9e9e; color: white;padding: 12px 12px; text-decoration: none; border-radius: 8px;">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </section>

    </main>

</body>

</html>