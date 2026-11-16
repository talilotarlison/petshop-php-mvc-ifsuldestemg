
## Descrição:
### Criem um site em PHP para controle de um PetShop realizando funções de Banco de Dados, onde é possível o usuário:

- Cadastrar um serviço ao Pet - ex. banho e tosa;

- Alterar e Verificar status do serviço - ex. em espera, em andamento, aguardando busca do pet;

- Verificar o valor para o cliente.

- O sitema deve permitir cadastrar os clientes  com seus dados , e nome do pet e codigo id do pet, deve cadastrar tambem valor tipo do serviço, status.


## Planejamento
Vamos trabalhar como em um processo de **engenharia de requisitos**, organizando e documentando tudo que é necessário para criar um sistema funcional e alinhado às expectativas do cliente. Para isso, vamos seguir uma abordagem profissional, estruturada em etapas:

---

## ✅ Etapas para Levantamento e Definição de Requisitos

### 1. **Entendimento do Negócio**

Antes de qualquer coisa, preciso que você me diga:

* Qual é o **segmento de atuação do cliente** (ex: educação, saúde, varejo, logística)?
* Qual é o **problema que ele quer resolver** ou qual é o **objetivo do sistema**?

---

### 2. **Definição dos Stakeholders**

Liste:

* Quem são os **usuários finais**?
* Quem é o **cliente pagante**?
* Existem outros interessados (ex: administradores, parceiros, órgãos reguladores)?

---

### 3. **Escopo Inicial do Sistema**

Vamos responder perguntas como:

* O que o sistema **deve fazer**?
* O que ele **não precisa fazer** (escopo fora)?
* Há **sistemas legados** ou **integrações externas** envolvidas?

---

### 4. **Requisitos Funcionais (RF)**

São as **funcionalidades esperadas** do sistema, como:

* Cadastro de usuários
* Emissão de relatórios
* Login com autenticação por e-mail ou biometria
* Fluxo de aprovação para pedidos

Vamos listá-los com uma estrutura básica:

```
RF01 – O sistema deve permitir o cadastro de novos usuários com nome, e-mail e senha.
RF02 – O sistema deve enviar um e-mail de confirmação após o cadastro.
RF03 – O sistema deve permitir login via redes sociais (Google/Facebook).
RF04 – O sistema deve gerar relatórios mensais em PDF.
```

---

### 5. **Requisitos Não Funcionais (RNF)**

São restrições ou características que o sistema deve ter, por exemplo:

* Desempenho (tempo de resposta)
* Segurança (criptografia, autenticação)
* Escalabilidade
* Usabilidade
* Compatibilidade com navegadores

Exemplo:

```
RNF01 – O sistema deve estar disponível 24h por dia, 7 dias por semana.
RNF02 – O tempo de resposta para login não deve exceder 2 segundos.
RNF03 – Toda comunicação deve ser feita via HTTPS.
RNF04 – O sistema deve estar compatível com dispositivos móveis.
```

---

### 6. **Casos de Uso ou User Stories**

Aqui descrevemos **como os usuários interagem** com o sistema. Pode ser feito em linguagem técnica ou em forma de histórias:

```
Como [usuário],
Quero [ação desejada],
Para que [benefício ou resultado].

Exemplo:
Como cliente,
Quero acompanhar o status do meu pedido,
Para que eu saiba quando ele será entregue.
```

---

### 7. **Regras de Negócio**

São regras específicas da empresa que impactam o funcionamento do sistema:

* Validações
* Fórmulas de cálculo
* Regras de acesso
* Prazos ou limites

Exemplo:

```
RN01 – Um pedido só pode ser cancelado em até 24h após a compra.
RN02 – O CPF informado deve ser válido segundo a fórmula oficial de validação.
RN03 – Um gerente pode aprovar pedidos acima de R$ 10.000,00.
```

---

### 8. **Protótipo ou Wireframes (opcional)**

Depois de tudo isso, é comum criar protótipos de baixa fidelidade para validar a navegação do sistema com o cliente antes de começar o desenvolvimento.

---

## ✅ Próximo passo:

Para eu te ajudar de forma prática, preciso que você me diga:

1. Qual é o **tipo de sistema** que o cliente quer? (ex: sistema de agendamento, e-commerce, controle de estoque etc.)
2. Há alguma **informação que você já tem** do cliente (ex: reunião, briefing, ideias)?
3. Você quer que a gente **comece levantando requisitos juntos** ou prefere um modelo genérico como exemplo?

Com base na descrição que você forneceu, vamos construir **um conjunto estruturado de requisitos de sistema para um sistema web de controle de serviços para um PetShop**. Farei isso usando boas práticas da engenharia de requisitos, segmentando os tipos de requisitos e detalhando os fluxos principais.

---

## 🧾 Visão Geral do Sistema

### 🐶 **Objetivo**:

Desenvolver um **sistema web em PHP** com banco de dados para controle de serviços prestados a pets em um PetShop, com funcionalidades de cadastro de serviços, clientes e pets, controle de status dos atendimentos e visualização de valores.

---

## 👥 1. Stakeholders

| Tipo               | Descrição                          |
| ------------------ | ---------------------------------- |
| Usuário do sistema | Funcionário do PetShop             |
| Administrador      | Dono ou gerente do PetShop         |
| Cliente final      | Dono do pet (não acessa o sistema) |

---

## 🔍 2. Escopo Funcional (Alto Nível)

O sistema deve permitir:

* Cadastro de clientes e pets.
* Cadastro e gerenciamento de serviços.
* Atualização e verificação do status dos serviços.
* Consulta de valores dos serviços realizados.

---

## ✅ 3. Requisitos Funcionais (RF)

| Código | Requisito                                                                                                                                    |
| ------ | -------------------------------------------------------------------------------------------------------------------------------------------- |
| RF01   | O sistema deve permitir o cadastro de clientes com nome, telefone e e-mail.                                                                  |
| RF02   | O sistema deve permitir o cadastro de pets com nome, espécie, raça e associação ao cliente responsável.                                      |
| RF03   | O sistema deve gerar um identificador único (ID) para cada pet.                                                                              |
| RF04   | O sistema deve permitir o cadastro de tipos de serviço com nome (ex: banho, tosa), descrição e valor.                                        |
| RF05   | O sistema deve permitir o registro de um serviço solicitado para um pet, vinculando cliente, pet e tipo de serviço.                          |
| RF06   | O sistema deve permitir alterar o status de um serviço para um dos seguintes: “Em espera”, “Em andamento”, “Aguardando busca”, “Finalizado”. |
| RF07   | O sistema deve exibir a lista de serviços com seus respectivos status, valor e dados do pet.                                                 |
| RF08   | O sistema deve permitir buscar serviços por status, nome do pet ou nome do cliente.                                                          |

---

## 📐 4. Requisitos Não Funcionais (RNF)

| Código | Requisito                                                                                  |
| ------ | ------------------------------------------------------------------------------------------ |
| RNF01  | O sistema deve ser desenvolvido em PHP com acesso a banco de dados relacional (ex: MySQL). |
| RNF02  | O sistema deve utilizar HTTPS para comunicação segura (em produção).                       |
| RNF03  | O tempo de resposta para carregar uma página deve ser inferior a 2 segundos em média.      |
| RNF04  | O sistema deve estar acessível via navegadores modernos (Chrome, Firefox, Edge).           |
| RNF05  | O sistema deve ser responsivo e acessível em dispositivos móveis.                          |

---

## 📚 5. Regras de Negócio (RN)

| Código | Regra                                                                                                                 |
| ------ | --------------------------------------------------------------------------------------------------------------------- |
| RN01   | Um cliente pode ter mais de um pet cadastrado.                                                                        |
| RN02   | Cada pet deve ter um ID único no sistema.                                                                             |
| RN03   | Um serviço só pode ser cadastrado para pets já existentes no sistema.                                                 |
| RN04   | Os status dos serviços devem seguir a ordem lógica: “Em espera” → “Em andamento” → “Aguardando busca” → “Finalizado”. |
| RN05   | O valor do serviço é definido com base no tipo de serviço selecionado no momento do cadastro.                         |
| RN06   | Não é permitido alterar o valor do serviço depois que ele for cadastrado.                                             |

---

## 👤 6. Casos de Uso (User Stories)

### 💼 Cadastro de Cliente

```
Como funcionário do PetShop,
Quero cadastrar um novo cliente,
Para que ele possa vincular seus pets ao sistema.
```

### 🐾 Cadastro de Pet

```
Como funcionário,
Quero cadastrar um pet com os dados do cliente,
Para registrar corretamente os serviços solicitados.
```

### 🧼 Cadastro de Serviço

```
Como funcionário,
Quero registrar um serviço para um pet,
Para controlar o andamento do atendimento.
```

### 🔄 Alteração de Status

```
Como funcionário,
Quero atualizar o status do serviço,
Para indicar o progresso do atendimento ao pet.
```

### 💲 Consulta de Valores

```
Como funcionário,
Quero visualizar o valor de cada serviço solicitado,
Para informar corretamente o cliente no momento da entrega.
```

---

## 📊 7. Entidades e Relacionamentos (modelo lógico simplificado)

Você pode usar esse modelo lógico mais tarde para modelar o banco de dados:

```
Usuario (id_usuario, nome, data, email, senha)

Cliente (ID_cpf, Nome, Telefone, Email, endereco, ativo)
Endereco (Cliente_ID_cpf, cidade, bairro, estado, cep, rua)
Pet (ID, Nome, Espécie, Raça, Cliente_ID_cpf)

TiposDeServicos ( ID, nome, preco)
ServicoContratado (ID, TiposDeServicos_ID, Descrição, Pet_ID, Cliente_ID_cpf, DataSolicitada, Status)
```

---

## 📝 Próximos passos

1. Você deseja que eu te ajude agora a:

   * Detalhar os **casos de uso** com fluxos alternativos?
   * Especificar **telas e funcionalidades** (como wireframes ou descrições textuais)?
   * Criar **documentação de requisitos formal** (em formato PDF, DOC ou outro)?

2. Deseja incluir **login e controle de acesso** (admin, funcionário)?

