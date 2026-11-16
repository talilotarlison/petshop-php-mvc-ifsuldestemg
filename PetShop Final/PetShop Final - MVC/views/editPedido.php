<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Pedido - Petshop</title>
    <!-- Inclui Boxicons para os ícones, pois são leves e modernos (alternativa ao Lucide/FontAwesome) -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../public/css/formPedido.css">
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
            <a href="./pedidos" class="nav-link active">
                <i class='bx bx-cart'></i>
                Pedidos
            </a>
            <a href="./pets" class="nav-link ">
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
            <h2>Atualizar Serviço</h2>

            <!-- Link voltar -->
            <a class="period-selector" href="./pedidos" style="text-decoration: none;">
                Voltar
                <i class='bx bx-arrow-back'></i> <!-- Ícone de seta para a esquerda (voltar) -->
            </a>
        </header>

        <!-- Seção de Tabela -->
        <section class="table-section">
            <!-- Container da Tabela -->
            <div class="table-container">
                <!-- Formulário de Cadastro de Serviço -->

                <form action="./editPedido" method="POST" class="form-servico">
                        <h3>Dados Serviço</h3>

                        <span class="success-message">
                            <?= isset($successMessage) ? htmlspecialchars($successMessage) : '' ?>
                        </span>
                        <span class="error-message">
                            <?= isset($errorMessage) ? htmlspecialchars($errorMessage) : '' ?>
                        </span>

                        <!-- Tipo de Serviço -->
                        <div class="form-group">
                            <label for="id_servico">Selecione o Serviço:</label>
                            <select name="id_servico" id="id_servico" required>
                                <?php foreach ($getTiposPedidos as $tipo): ?>
                                    <option value="<?= htmlspecialchars($tipo['id_servico']) ?>"
                                        id-valor="<?= htmlspecialchars($tipo['preco']) ?>"
                                        <?= isset($servico['id_servico']) && $servico['id_servico'] == $tipo['id_servico'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($tipo['nome']) ?> - R$ <?= number_format($tipo['preco'], 2, ',', '.') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Valor do Serviço -->
                        <div class="form-group">
                            <label for="valor_servico">Valor do Serviço (R$):</label>
                            <input type="number" step="0.01" min="0" id="valor_servico" name="valor_servico"
                                value="<?= isset($servico['preco_servico']) ? htmlspecialchars($servico['preco_servico']) : '' ?>"
                                required readonly>
                        </div>

                        <!-- Descrição -->
                        <div class="form-group">
                            <label for="descricao_servico">Descrição do Serviço:</label>
                            <textarea id="descricao_servico" name="descricao_servico" rows="4" required readonly><?= isset($servico['descricao']) ? htmlspecialchars($servico['descricao']) : '' ?></textarea>
                        </div>

                        <!-- Código do Pet -->
                        <div class="form-group">
                            <label for="pet_id">Código do Pet:</label>
                            <input type="number" id="pet_id" name="pet_id" placeholder="Digite o código do pet"
                                value="<?= isset($servico['id_registro']) ? htmlspecialchars($servico['id_registro']) : '' ?>" required readonly>
                            <small style="color:#e617089a; font-size:12px;">Válido apenas código de PET cadastrado no sistema.</small>
                        </div>

                        <!-- CPF do Cliente -->
                        <div class="form-group">
                            <label for="cliente_id">CPF do Cliente (Responsavel):</label>
                            <input type="text" id="cliente_id" name="cliente_id" placeholder="Digite o CPF do cliente"
                                value="<?= isset($servico['id_cpf']) ? htmlspecialchars($servico['id_cpf']) : '' ?>" required readonly>
                            <small style="color:#e617089a; font-size:12px;">Válido apenas CPF de clientes cadastrado no sistema.</small>
                        </div>

                        <!-- Data da solicitação -->
                        <div class="form-group">
                            <label for="data_cadastro">Agendamento (Dia/Hora):</label>
                            <input type="datetime-local" id="data_cadastro" name="data_cadastro"
                                value="<?= isset($servico['DataSolicitada']) ? htmlspecialchars($servico['DataSolicitada']) : '' ?>" required>
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status do Serviço:</label>
                            <select id="status" name="status" required>
                                <option value="Pendente" <?= isset($servico['status']) && $servico['status'] == 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                                <option value="Em andamento" <?= isset($servico['status']) && $servico['status'] == 'Em andamento' ? 'selected' : '' ?>>Em andamento</option>
                                <option value="Concluído" <?= isset($servico['status']) && $servico['status'] == 'Concluído' ? 'selected' : '' ?>>Concluído</option>
                            </select>
                        </div>

                        <!-- Hidden ID do serviço -->
                        <input type="hidden" name="id" value="<?= isset($servico['id']) ? htmlspecialchars($servico['id']) : '' ?>">

                        <!-- Botão -->
                        <div class="form-group">
                            <button type="submit" class="btn-submit">Atualizar Serviço</button>
                            <a href="./pedidos" class="btn-cancel" style="background-color:#9e9e9e; color:white; padding:12px 12px; border-radius:8px; text-decoration:none;">Cancelar</a>
                        </div>
                </form>
            </div>

        </section>

    </main>

</body>

<script src="../public/js/newPedido.js"></script>
</html>