Um exemplo de uma **seção HTML** com **CSS** que exibe um **gráfico de barras simples** para mostrar:

* Total de clientes
* Total de atendimentos
* Total de atendimentos concluídos

Esse gráfico pode ser atualizado dinamicamente com **PHP**, passando os dados para o HTML.

---

### ✅ **1. Estrutura HTML com PHP**

```php
<!-- dashboard.php -->
<?php
// Simulação de dados vindo do banco de dados ou backend
$totalClientes = 120;
$totalAtendimentos = 90;
$totalConcluidos = 75;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Pet</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .dashboard {
      max-width: 800px;
      margin: 50px auto;
      padding: 30px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .dashboard h2 {
      text-align: center;
      margin-bottom: 40px;
    }

    .bar-container {
      margin: 20px 0;
    }

    .bar-label {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .bar {
      height: 30px;
      border-radius: 5px;
      background: #e0e0e0;
      position: relative;
      overflow: hidden;
    }

    .bar-fill {
      height: 100%;
      text-align: right;
      padding-right: 10px;
      color: #fff;
      line-height: 30px;
      font-size: 14px;
    }

    .clientes { background-color: #3498db; }
    .atendimentos { background-color: #f39c12; }
    .concluidos { background-color: #2ecc71; }

    .icon {
      margin-right: 10px;
      vertical-align: middle;
    }
  </style>
</head>
<body>

<div class="dashboard">
  <h2><i class='bx bx-bar-chart icon'></i> Painel de Atendimentos</h2>

  <?php
    // Calcula proporção com base no maior valor
    $max = max($totalClientes, $totalAtendimentos, $totalConcluidos);
    $clientesPorcentagem = ($totalClientes / $max) * 100;
    $atendimentosPorcentagem = ($totalAtendimentos / $max) * 100;
    $concluidosPorcentagem = ($totalConcluidos / $max) * 100;
  ?>

  <!-- Clientes -->
  <div class="bar-container">
    <div class="bar-label"><i class='bx bx-user icon'></i>Total de Clientes: <?= $totalClientes ?></div>
    <div class="bar">
      <div class="bar-fill clientes" style="width: <?= $clientesPorcentagem ?>%"><?= $totalClientes ?></div>
    </div>
  </div>

  <!-- Atendimentos -->
  <div class="bar-container">
    <div class="bar-label"><i class='bx bx-notepad icon'></i>Total de Atendimentos: <?= $totalAtendimentos ?></div>
    <div class="bar">
      <div class="bar-fill atendimentos" style="width: <?= $atendimentosPorcentagem ?>%"><?= $totalAtendimentos ?></div>
    </div>
  </div>

  <!-- Concluídos -->
  <div class="bar-container">
    <div class="bar-label"><i class='bx bx-check-circle icon'></i>Atendimentos Concluídos: <?= $totalConcluidos ?></div>
    <div class="bar">
      <div class="bar-fill concluidos" style="width: <?= $concluidosPorcentagem ?>%"><?= $totalConcluidos ?></div>
    </div>
  </div>

</div>

</body>
</html>
```

---

### ✅ **2. Como funciona**

* Os dados (`$totalClientes`, `$totalAtendimentos`, `$totalConcluidos`) podem vir do seu banco de dados.
* O PHP calcula a **largura proporcional das barras**.
* CSS estiliza as barras para que tenham cores distintas e animações visuais.
* O layout é responsivo e visualmente agradável.

---

### 📌 Dica extra

Se quiser tornar os dados **mais dinâmicos**, você pode:

* Usar **AJAX** para atualizar os números em tempo real.
* Puxar dados de um banco (ex: MySQL) com `mysqli` ou `PDO`.
* Integrar com gráficos interativos via **Chart.js** (se quiser algo mais elaborado).

Quer que eu mostre como puxar os dados do banco ou usar Chart.js no lugar dessas barras?


Perfeito! Abaixo está o código completo **somente em HTML e CSS puro** (sem PHP), para você usar como base e depois modificar. A parte dos dados está fixa por enquanto, mas deixei marcada onde você poderá trocar por variáveis PHP ou outro método futuramente.

---

### ✅ **HTML + CSS: Seção com gráfico de barras estático**

```html
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Gráfico Pet Dashboard</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .dashboard {
      max-width: 800px;
      margin: 50px auto;
      padding: 30px;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    .dashboard h2 {
      text-align: center;
      margin-bottom: 40px;
      color: #333;
    }

    .bar-container {
      margin: 25px 0;
    }

    .bar-label {
      font-weight: bold;
      margin-bottom: 8px;
      color: #444;
      display: flex;
      align-items: center;
    }

    .bar-label i {
      margin-right: 8px;
      font-size: 18px;
      color: #666;
    }

    .bar {
      height: 28px;
      background-color: #e0e0e0;
      border-radius: 6px;
      overflow: hidden;
      position: relative;
    }

    .bar-fill {
      height: 100%;
      padding-right: 10px;
      color: #fff;
      line-height: 28px;
      font-size: 14px;
      text-align: right;
      transition: width 0.5s ease-in-out;
    }

    .clientes { background-color: #3498db; width: 90%; }         /* 90% */
    .atendimentos { background-color: #f39c12; width: 75%; }     /* 75% */
    .concluidos { background-color: #2ecc71; width: 60%; }       /* 60% */
  </style>
</head>
<body>

  <div class="dashboard">
    <h2><i class='bx bx-bar-chart'></i> Painel de Atendimentos Pet</h2>

    <!-- Total de Clientes -->
    <div class="bar-container">
      <div class="bar-label"><i class='bx bx-user'></i>Total de Clientes: 120</div>
      <div class="bar">
        <div class="bar-fill clientes">120</div>
      </div>
    </div>

    <!-- Total de Atendimentos -->
    <div class="bar-container">
      <div class="bar-label"><i class='bx bx-notepad'></i>Total de Atendimentos: 100</div>
      <div class="bar">
        <div class="bar-fill atendimentos">100</div>
      </div>
    </div>

    <!-- Atendimentos Concluídos -->
    <div class="bar-container">
      <div class="bar-label"><i class='bx bx-check-circle'></i>Concluídos: 80</div>
      <div class="bar">
        <div class="bar-fill concluidos">80</div>
      </div>
    </div>
  </div>

</body>
</html>
```

---

### ✅ Como usar/modificar depois:

* **Valores fixos:** Os números estão fixos (`120`, `100`, `80`).
* **Barra proporcional:** As `width:` nas classes `.clientes`, `.atendimentos`, `.concluidos` controlam o tamanho visual de cada barra.
* Quando for usar com **PHP**, você pode substituir os valores e `widths` dinamicamente.

---

### ❓Quer deixar isso animado com JS ou Chart.js?

Ou quer que os dados venham de um banco (MySQL)?
Posso mostrar como integrar esses dados dinamicamente com PHP/MySQL ou animar com JS.

Para criar uma página de login simples com as cores que você forneceu, e botões de login e cadastro, posso criar um HTML com CSS integrado para você. Aqui está o código:

### HTML + CSS:

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <style>
        :root {
            --cor-sidebar: #2d3748;
            --cor-sidebar-active: #1a202c;
            --cor-texto-principal: #e2e8f0;
            --cor-fundo-principal: #f7fafc;
            --cor-linha-tabela: #edf2f7;
            --borda-clara: #cbd5e0;
            --sombra-leve: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--cor-fundo-principal);
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: var(--sombra-leve);
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            text-align: center;
            color: var(--cor-sidebar);
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            color: var(--cor-sidebar);
            font-size: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--borda-clara);
            border-radius: 4px;
            font-size: 16px;
            color: var(--cor-sidebar);
            background-color: var(--cor-linha-tabela);
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--cor-sidebar-active);
        }

        .button {
            width: 100%;
            padding: 12px;
            background-color: var(--cor-sidebar);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: var(--cor-sidebar-active);
        }

        .link {
            text-align: center;
            margin-top: 20px;
        }

        .link a {
            color: var(--cor-sidebar);
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="/login" method="POST">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Seu email" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Sua senha" required>
            </div>
            <button type="submit" class="button">Entrar</button>
        </form>
        <div class="link">
            <p>Ainda não tem uma conta? <a href="/cadastro">Cadastre-se</a></p>
        </div>
    </div>
</body>
</html>
```

### Explicação:

* **Cores**: As cores do tema foram aplicadas conforme os valores das variáveis CSS que você forneceu.
* **Estrutura**: O formulário de login é simples, com campos de email e senha, além de um botão de login.
* **Estilo**: O layout é centrado na tela, com um card de login que tem uma sombra suave e bordas arredondadas.
* **Cadastro**: Há um link abaixo do formulário que leva para a página de cadastro, que você pode configurar para redirecionar para outra página conforme a sua necessidade.

### Próximos passos:

* Se você quiser que o formulário redirecione para outra página (por exemplo, `/login` ou `/cadastro`), você pode ajustar as URLs nos atributos `action` dos formulários e nos links.

Claro! Agora vou criar uma página de cadastro com os campos que você solicitou: Nome, Email, Data de Nascimento, Senha e Confirmar Senha, utilizando o mesmo padrão de cores e estrutura que você pediu.

### HTML + CSS:

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>
    <style>
        :root {
            --cor-sidebar: #2d3748;
            --cor-sidebar-active: #1a202c;
            --cor-texto-principal: #e2e8f0;
            --cor-fundo-principal: #f7fafc;
            --cor-linha-tabela: #edf2f7;
            --borda-clara: #cbd5e0;
            --sombra-leve: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--cor-fundo-principal);
            font-family: 'Inter', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .signup-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: var(--sombra-leve);
            width: 100%;
            max-width: 400px;
        }

        .signup-container h2 {
            text-align: center;
            color: var(--cor-sidebar);
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            color: var(--cor-sidebar);
            font-size: 14px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--borda-clara);
            border-radius: 4px;
            font-size: 16px;
            color: var(--cor-sidebar);
            background-color: var(--cor-linha-tabela);
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--cor-sidebar-active);
        }

        .button {
            width: 100%;
            padding: 12px;
            background-color: var(--cor-sidebar);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: var(--cor-sidebar-active);
        }

        .link {
            text-align: center;
            margin-top: 20px;
        }

        .link a {
            color: var(--cor-sidebar);
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Cadastro</h2>
        <form action="/cadastro" method="POST">
            <div class="input-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" placeholder="Seu nome completo" required>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Seu email" required>
            </div>
            <div class="input-group">
                <label for="data-nascimento">Data de Nascimento</label>
                <input type="date" id="data-nascimento" name="data-nascimento" required>
            </div>
            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="Escolha uma senha" required>
            </div>
            <div class="input-group">
                <label for="confirmar-senha">Confirmar Senha</label>
                <input type="password" id="confirmar-senha" name="confirmar-senha" placeholder="Repita a senha" required>
            </div>
            <button type="submit" class="button">Cadastrar</button>
        </form>
        <div class="link">
            <p>Já tem uma conta? <a href="/login">Faça login</a></p>
        </div>
    </div>
</body>
</html>
```

### Explicação:

* **Campos de entrada**:

  * **Nome**: Um campo de texto simples para o nome completo do usuário.
  * **Email**: Campo para inserir o email.
  * **Data de Nascimento**: Um campo de data.
  * **Senha**: Campo para inserir a senha.
  * **Confirmar Senha**: Outro campo de senha para confirmar que o usuário digitou a mesma senha.

* **Botão de cadastro**: O botão de "Cadastrar" segue o mesmo estilo do botão de login, com as cores que você forneceu.

* **Link de redirecionamento**: Um link que leva o usuário para a página de login, caso ele já tenha uma conta.

### Adicionais:

* **Validação**: O HTML possui a validação básica nos campos (com o `required`). Se precisar de validação adicional (como a comparação das senhas), isso pode ser feito com JavaScript, se necessário.

Para organizar os serviços em um `<select>` com opções divididas por grupos, podemos usar o atributo `<optgroup>` para separar os serviços em diferentes categorias, como "Serviços de Higiene e Beleza", "Serviços de Saúde" e "Serviços de Acomodações". Aqui está o código ajustado para atender ao seu pedido:

### Código HTML para o `select` com `optgroup`:

```html
<div class="form-group">
    <label for="servicos">Selecione o Serviço:</label>
    <select id="servicos" name="servicos" required>
        <!-- Serviços de Higiene e Beleza -->
        <optgroup label="Serviços de Higiene e Beleza">
            <option value="banho-tosa">Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos</option>
            <option value="tosa-higienica">Tosa Higiênica (Orelhas e Região Íntima)</option>
            <option value="tosa-racas-especificas">Tosa de Raças Específicas (Poodle, Shih Tzu, etc.)</option>
            <option value="higiene-bucal">Higiene Bucal (Limpeza de Dentes)</option>
            <option value="corte-unhas">Corte de Unhas</option>
            <option value="limpeza-ouvidos">Limpeza de Ouvidos</option>
            <option value="escovacao-pelo">Escovação de Pelo</option>
        </optgroup>

        <!-- Serviços de Saúde -->
        <optgroup label="Serviços de Saúde">
            <option value="consultas-veterinarias">Consultas Veterinárias</option>
            <option value="vacina">Vacinação</option>
            <option value="vermifugacao">Vermifugação</option>
            <option value="esterilizacao-castracao">Esterilização (Castração)</option>
            <option value="analises-clinicas">Análises Clínicas</option>
            <option value="emergencias-veterinarias">Emergências Veterinárias</option>
        </optgroup>

        <!-- Serviços de Acomodações -->
        <optgroup label="Serviços de Acomodações">
            <option value="hospedagem-pet-hotel">Hospedagem (Pet Hotel)</option>
            <option value="creche-caes">Creche para Cães</option>
        </optgroup>
    </select>
</div>
```

### Explicação:

* **`<optgroup>`**: Usei o `<optgroup>` para dividir as opções em três grupos: **Serviços de Higiene e Beleza**, **Serviços de Saúde**, e **Serviços de Acomodações**.
* **`<option>`**: Cada serviço foi adicionado como uma `<option>` dentro do grupo correspondente.

### Exemplo Visual:

Quando o usuário abrir o menu suspenso (`<select>`), ele verá os serviços organizados por categorias:

1. **Serviços de Higiene e Beleza**:

   * Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos
   * Tosa Higiênica (Orelhas e Região Íntima)
   * Tosa de Raças Específicas (Poodle, Shih Tzu, etc.)
   * Higiene Bucal (Limpeza de Dentes)
   * Corte de Unhas
   * Limpeza de Ouvidos
   * Escovação de Pelo

2. **Serviços de Saúde**:

   * Consultas Veterinárias
   * Vacinação
   * Vermifugação
   * Esterilização (Castração)
   * Análises Clínicas
   * Emergências Veterinárias

3. **Serviços de Acomodações**:

   * Hospedagem (Pet Hotel)
   * Creche para Cães

Este formato permite que o usuário encontre facilmente o serviço que deseja selecionar, graças à divisão em categorias claras e organizadas. 

Aqui está o formato JSON com os serviços e seus respectivos preços. Como você não especificou valores, eu coloquei exemplos fictícios de preços. Sinta-se à vontade para ajustar conforme necessário.

### Exemplo de JSON:

```json
{
  "servicos": {
    "higiene_e_beleza": [
      {
        "nome": "Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos",
        "preco": 80.00
      },
      {
        "nome": "Tosa Higiênica (Orelhas e Região Íntima)",
        "preco": 30.00
      },
      {
        "nome": "Tosa de Raças Específicas (Poodle, Shih Tzu, etc.)",
        "preco": 100.00
      },
      {
        "nome": "Higiene Bucal (Limpeza de Dentes)",
        "preco": 50.00
      },
      {
        "nome": "Corte de Unhas",
        "preco": 20.00
      },
      {
        "nome": "Limpeza de Ouvidos",
        "preco": 25.00
      },
      {
        "nome": "Escovação de Pelo",
        "preco": 40.00
      }
    ],
    "saude": [
      {
        "nome": "Consultas Veterinárias",
        "preco": 60.00
      },
      {
        "nome": "Vacinação",
        "preco": 35.00
      },
      {
        "nome": "Vermifugação",
        "preco": 25.00
      },
      {
        "nome": "Esterilização (Castração)",
        "preco": 250.00
      },
      {
        "nome": "Análises Clínicas",
        "preco": 80.00
      },
      {
        "nome": "Emergências Veterinárias",
        "preco": 150.00
      }
    ],
    "acomodacoes": [
      {
        "nome": "Hospedagem (Pet Hotel)",
        "preco": 100.00
      },
      {
        "nome": "Creche para Cães",
        "preco": 50.00
      }
    ]
  }
}
```

### Estrutura:

* **`higiene_e_beleza`**: Lista com os serviços relacionados à higiene e estética dos pets.
* **`saude`**: Lista com os serviços médicos e de saúde.
* **`acomodacoes`**: Lista com os serviços de hospedagem e creche.

Cada serviço é um objeto com:

* **`nome`**: Nome do serviço.
* **`preco`**: Preço do serviço (exemplo em reais).

### Ajuste de Preços:

Os valores de `preco` são exemplos e podem ser ajustados de acordo com o seu modelo de negócio.

Se você deseja preencher as opções de um `<select>` dinamicamente usando um loop (como um `for`), geralmente você usaria JavaScript para iterar sobre um array de dados (por exemplo, um array de objetos com serviços e preços) e gerar as opções dentro do `<select>`.

Aqui está um exemplo de como você pode fazer isso com JavaScript, utilizando os dados em formato JSON que forneci anteriormente:

### Exemplo de HTML + JavaScript com loop (`for`):

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Serviços</title>
    <style>
        .form-group {
            margin: 20px 0;
        }
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>

    <div class="form-group">
        <label for="servicos">Selecione o Serviço:</label>
        <select id="servicos" name="servicos" required>
            <!-- As opções serão geradas dinamicamente pelo JavaScript -->
        </select>
    </div>

    <script>
        // Dados em formato JSON
        const servicos = {
            "higiene_e_beleza": [
                { "nome": "Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos", "preco": 80.00 },
                { "nome": "Tosa Higiênica (Orelhas e Região Íntima)", "preco": 30.00 },
                { "nome": "Tosa de Raças Específicas (Poodle, Shih Tzu, etc.)", "preco": 100.00 },
                { "nome": "Higiene Bucal (Limpeza de Dentes)", "preco": 50.00 },
                { "nome": "Corte de Unhas", "preco": 20.00 },
                { "nome": "Limpeza de Ouvidos", "preco": 25.00 },
                { "nome": "Escovação de Pelo", "preco": 40.00 }
            ],
            "saude": [
                { "nome": "Consultas Veterinárias", "preco": 60.00 },
                { "nome": "Vacinação", "preco": 35.00 },
                { "nome": "Vermifugação", "preco": 25.00 },
                { "nome": "Esterilização (Castração)", "preco": 250.00 },
                { "nome": "Análises Clínicas", "preco": 80.00 },
                { "nome": "Emergências Veterinárias", "preco": 150.00 }
            ],
            "acomodacoes": [
                { "nome": "Hospedagem (Pet Hotel)", "preco": 100.00 },
                { "nome": "Creche para Cães", "preco": 50.00 }
            ]
        };

        // Função para adicionar as opções no select
        function preencherSelect() {
            const select = document.getElementById("servicos");

            // Itera pelos grupos de serviços
            for (const grupo in servicos) {
                // Cria o grupo de opções
                const optgroup = document.createElement("optgroup");
                optgroup.label = capitalizeFirstLetter(grupo);

                // Itera pelos serviços dentro de cada grupo
                servicos[grupo].forEach(servico => {
                    const option = document.createElement("option");
                    option.value = servico.nome;
                    option.textContent = `${servico.nome} - R$ ${servico.preco.toFixed(2)}`;
                    optgroup.appendChild(option);
                });

                // Adiciona o grupo ao select
                select.appendChild(optgroup);
            }
        }

        // Função para capitalizar a primeira letra de uma string (para exibir o nome do grupo de forma mais amigável)
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1).replace("_", " ");
        }

        // Preenche o select quando a página carregar
        window.onload = preencherSelect;
    </script>

</body>
</html>
```

### Explicação do código:

1. **Estrutura HTML**: O `<select>` vazio é preparado no HTML, mas não contém opções inicialmente. O JavaScript será responsável por preencher as opções.

2. **JSON com dados**: Os serviços e preços estão armazenados no objeto `servicos`. Ele está organizado em grupos como `"higiene_e_beleza"`, `"saude"`, e `"acomodacoes"`, onde cada grupo contém um array de objetos com o nome do serviço e o preço.

3. **Função `preencherSelect()`**:

   * A função percorre os grupos de serviços (usando `for...in`).
   * Para cada grupo, ela cria um `<optgroup>` com o nome do grupo e itera sobre os serviços dentro dele para criar uma `<option>` para cada serviço.
   * As opções têm o nome do serviço e o preço formatado em reais (`R$`).

4. **Função `capitalizeFirstLetter()`**: Esta função é usada para formatar os nomes dos grupos (como `"higiene_e_beleza"`) de maneira mais amigável para o usuário, transformando para `"Higiene e Beleza"`.

5. **Preenchendo o `<select>`**: A função `preencherSelect()` é chamada quando a página carrega (`window.onload`), preenchendo dinamicamente o `<select>`.

### Como funciona:

* Quando a página for carregada, o JavaScript vai gerar dinamicamente as opções de serviços no `<select>`, divididas em grupos (`optgroup`), e cada serviço será exibido com o preço ao lado.

### Exemplo de como o `<select>` vai aparecer no navegador:

* **Serviços de Higiene e Beleza**:

  * Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos - R$ 80,00
  * Tosa Higiênica (Orelhas e Região Íntima) - R$ 30,00
  * ...

* **Serviços de Saúde**:

  * Consultas Veterinárias - R$ 60,00
  * Vacinação - R$ 35,00
  * ...

Isso vai permitir que os usuários escolham um serviço, e você pode enviar esses dados para um backend ou utilizá-los conforme necessário.

Se você deseja criar um atributo `id-valor` com um valor específico, como `id-valor="202"`, utilizando JavaScript, você pode adicionar esse atributo a um elemento HTML de forma dinâmica.

### Exemplo de como criar um atributo `id-valor` com JavaScript:

Aqui está um exemplo onde adicionamos o atributo `id-valor` a um elemento HTML:

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo de id-valor com JavaScript</title>
</head>
<body>

    <!-- Elemento onde o atributo será adicionado -->
    <div id="meuElemento">Elemento com id-valor</div>

    <script>
        // Selecionar o elemento pelo ID
        const elemento = document.getElementById("meuElemento");

        // Atribuir o atributo "id-valor" com o valor "202"
        elemento.setAttribute("id-valor", "202");

        // Verificar se o atributo foi adicionado
        console.log(elemento.getAttribute("id-valor"));  // Exibe: 202
    </script>

</body>
</html>
```

### Explicação:

1. **HTML**: Temos um elemento `<div>` com o ID `meuElemento`.
2. **JavaScript**:

   * Usamos `document.getElementById("meuElemento")` para selecionar o elemento no DOM.
   * Usamos `setAttribute("id-valor", "202")` para adicionar um atributo chamado `id-valor` com o valor `202` ao elemento.
   * Para verificar, usamos `getAttribute("id-valor")`, que retorna o valor do atributo que acabamos de definir.

### Resultado:

Após a execução do JavaScript, o elemento `<div>` terá o seguinte HTML:

```html
<div id="meuElemento" id-valor="202">Elemento com id-valor</div>
```

Ou seja, o atributo `id-valor` com o valor `202` será adicionado dinamicamente ao elemento.

### Caso queira adicionar o `id-valor` a múltiplos elementos:

Se você deseja adicionar o atributo a múltiplos elementos, pode usar um `querySelectorAll` e percorrer todos os elementos com `forEach`:

```html
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar id-valor a vários elementos</title>
</head>
<body>

    <!-- Elementos que vão receber o atributo -->
    <div class="item">Item 1</div>
    <div class="item">Item 2</div>
    <div class="item">Item 3</div>

    <script>
        // Selecionar todos os elementos com a classe "item"
        const elementos = document.querySelectorAll(".item");

        // Adicionar o atributo "id-valor" a cada um dos elementos
        elementos.forEach((elemento, index) => {
            // Atribuir um valor dinâmico com base no índice
            elemento.setAttribute("id-valor", 202 + index);
        });

        // Verificar o resultado no console
        elementos.forEach(elemento => {
            console.log(elemento.getAttribute("id-valor"));
        });
    </script>

</body>
</html>
```

### Resultado:

O HTML gerado para os 3 elementos seria algo assim:

```html
<div class="item" id-valor="202">Item 1</div>
<div class="item" id-valor="203">Item 2</div>
<div class="item" id-valor="204">Item 3</div>
```

### Explicação do código:

1. **Selecionando múltiplos elementos**: Usamos `document.querySelectorAll(".item")` para selecionar todos os elementos com a classe `item`.
2. **Adicionando atributos dinamicamente**: Com `forEach`, percorremos cada elemento e usamos `setAttribute` para definir o atributo `id-valor` com um valor dinâmico baseado no índice do loop.

Agora você tem uma forma de adicionar o atributo `id-valor` a qualquer elemento, seja para um único ou múltiplos elementos, com JavaScript. 

Aqui está o texto formatado em Markdown conforme solicitado:

---

## Como Recuperar o Valor de um Atributo Customizado Usando `e.target.getAttribute()`

Para recuperar o valor de um atributo customizado de um elemento que disparou um evento (usando `e.target`), a maneira mais confiável é utilizar o método `e.target.getAttribute()`.

No exemplo fornecido, `option.setAttribute('id-valor', servico.preco);`, você está definindo um atributo chamado `id-valor`.

### Exemplo de Como Recuperar o Valor

Considere que você tem um elemento `<select>` e adiciona um evento `change` para reagir à seleção de uma opção.

#### HTML:

```html
<select id="selectServico">
  <option value="">Selecione um serviço</option>
  <option value="servico1" id-valor="100.00">Serviço A</option>
  <option value="servico2" id-valor="250.50">Serviço B</option>
</select>
```

#### JavaScript:

```js
const selectServico = document.getElementById('selectServico');

selectServico.addEventListener('change', function(e) {
  // A propriedade 'value' pega o valor do atributo 'value'
  const valorPadrao = e.target.value; 

  // Use getAttribute() para pegar o valor do atributo customizado 'id-valor'
  const valorCustomizado = e.target.options[e.target.selectedIndex].getAttribute('id-valor');

  console.log('Valor padrão (atributo value):', valorPadrao);
  console.log('Valor customizado (atributo id-valor):', valorCustomizado);
});
```

### Explicação:

* **`e.target`**: Em um evento `change` de um `<select>`, `e.target` se refere ao próprio elemento `<select>`.
* **`e.target.value`**: Essa propriedade recupera o valor padrão do atributo `value` da opção selecionada.
* **`e.target.options[e.target.selectedIndex]`**: Para acessar a `option` específica que foi selecionada, você precisa acessar a coleção `options` do `<select>` e usar a propriedade `selectedIndex`.
* **`.getAttribute('id-valor')`**: Uma vez que você tem a referência ao elemento `<option>` correto, você pode usar o método `getAttribute()` para recuperar o valor do seu atributo personalizado (`id-valor` neste caso).

### Por que `e.target.value` Não Funciona para Atributos Customizados?

A propriedade `e.target.value` é uma propriedade nativa de elementos de formulário e só recupera o valor do atributo `value`. Atributos personalizados ou atributos de dados (`data-*`) precisam ser acessados usando o método `getAttribute()`.

---

Espero que o texto formatado em Markdown esteja exatamente como você queria! Se precisar de mais ajustes ou explicações, me avise.
