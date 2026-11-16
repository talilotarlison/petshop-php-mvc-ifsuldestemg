<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Novo Pedido - Petshop</title>
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
            <h2>Novo Pedido </h2>

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
                <form action="./newPedido" method="POST" class="form-servico">
                    <h3>Cadastro de Novo Serviço</h3>
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
                    <!-- Tipo de Serviço -->
                    <div class="form-group">
                        <label for="servicos">Selecione o Serviço:</label>
                        <select name="id_servico" id="id_servico">
                            <?php foreach ($getTiposPedidos as $servico): ?>
                                <option value="<?= htmlspecialchars($servico['id_servico']) ?>"
                                        id-valor="<?= htmlspecialchars($servico['preco']) ?>">
                                    <?= htmlspecialchars($servico['nome']) ?> - R$ <?= number_format($servico['preco'], 2, ',', '.') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="valor_servico">Valor do Serviço (R$):</label>
                        <input type="number" id="valor_servico" name="valor_servico" step="0.01" min="0"
                            placeholder="Digite o valor do serviço" required readonly>
                    </div>

                    <div class="form-group">
                        <label for="descricao_servico">Descrição do Serviço:</label>
                        <textarea id="descricao_servico" name="descricao_servico" rows="4"
                            placeholder="Digite a descrição do serviço" required readonly></textarea>
                    </div>

                    <!-- Dados do Serviço -->

                    <!-- Pet Relacionado -->
                      <div class="form-group">
                        <label for="pet_id">Selecione o Pet:</label>
                        <select id="pet_id" name="pet_id" required>
                            <option value="">Selecione um pet</option>
                            <?php foreach ($getTodosPets as $pet): ?>
                                <option
                                    value="<?= htmlspecialchars($pet['id_registro']) ?>">
                                    <?= htmlspecialchars($pet['nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div style="font-size: 12px;color: #e617089a;"> Valido apenas Nome de clientes cadastrado no sistema.</div>
                    </div>

                  <!-- Cliente Relacionado -->
                      <div class="form-group">
                        <label for="cliente_id">Cliente (Responsavel):</label>
                        <select id="cliente_id" name="cliente_id" required>
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
                    <div class="form-group">
                        <label for="data_cadastro">Agendamento (Dia/Hora):</label>
                        <input type="datetime-local" id="data_cadastro" name="data_cadastro" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status do Serviço:</label>
                        <select id="status" name="status" required>
                            <option value="Pendente">Pendente</option>
                            <option value="Em andamento">Em Andamento</option>
                            <option value="Concluído">Concluído</option>
                        </select>
                    </div>

                    <!-- Botão de Enviar -->
                    <div class="form-group">
                        <button type="submit" class="btn-submit">Cadastrar Serviço</button>
                    </div>
                </form>

            </div>

        </section>

    </main>

</body>

<script src="../public/js/newPedido.js"></script>
</html>