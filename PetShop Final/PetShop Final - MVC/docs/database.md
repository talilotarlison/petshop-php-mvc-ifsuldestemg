```
Usuario (id_usuario, nome, data, email, senha)

Cliente (id_cpf, nome, telefone, email, endereco, status) 
Endereco (id[Cliente_id_cpf], cidade, bairro, estado, cep, rua) 
Pet (id_registro, nome, especie, raca, dono[Cliente_id_cpf]) 

TiposDeServicos ( id_servico, nome, preco) 
ServicoContratado (id, TiposDeServicos[id_servico], descricao, Pet[id_registro], Cliente[d_cpf], DataSolicitada, status) .

 Seguindo essa modelagem de dados crie as tabelas no banco de dados com sqlite para mim seguindo as orientações:

- O cliente tem endereço que fica separado em outra tabela, a tabela endereço tem como id a chave primaria da tabela clientes id_cpf;
- a tabela pet o dono e chave primaria da tabela cliente Cliente_id_cpf;
- ServicoContratado  tem como TiposDeServicos o id_servico chave primaria da tabela TiposDeServicos , Pet chave priaria da tabela pet id_registro a mesma coisa em cliente;

- crie em sqlite as querys conforme a modelagem do banco.
```
Com base na modelagem de dados que você forneceu, vou criar as consultas SQL em SQLite para criar as tabelas conforme solicitado. Aqui estão as queries:

### 1. Criação da Tabela `Usuario`:

```sql
CREATE TABLE Usuario (
    id_usuario INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    data DATE NOT NULL,
    email TEXT NOT NULL UNIQUE,
    senha TEXT NOT NULL
);
```

### 2. Criação da Tabela `Cliente`:

```sql
CREATE TABLE Cliente (
    id_cpf TEXT PRIMARY KEY,
    nome TEXT NOT NULL,
    telefone TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    endereco TEXT,
    status TEXT NOT NULL
);
```

### 3. Criação da Tabela `Endereco`:

Aqui, a tabela `Endereco` tem como chave primária o `id_cpf` que faz referência à chave primária de `Cliente`.

```sql
CREATE TABLE Endereco (
    id_cpf TEXT PRIMARY KEY,
    cidade TEXT NOT NULL,
    bairro TEXT NOT NULL,
    estado TEXT NOT NULL,
    cep TEXT NOT NULL,
    rua TEXT NOT NULL,
    FOREIGN KEY(id_cpf) REFERENCES Cliente(id_cpf)
);
```

### 4. Criação da Tabela `Pet`:

A tabela `Pet` tem um relacionamento com a tabela `Cliente` através da chave `Cliente_id_cpf`, que é uma chave estrangeira que aponta para a chave primária de `Cliente`.

```sql
CREATE TABLE Pet (
    id_registro INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    especie TEXT NOT NULL,
    raca TEXT NOT NULL,
    dono TEXT NOT NULL,
    FOREIGN KEY(dono) REFERENCES Cliente(id_cpf)
);
```

### 5. Criação da Tabela `TiposDeServicos`:

Aqui, criamos a tabela de serviços com um identificador único para cada tipo de serviço e o preço associado.

```sql
CREATE TABLE TiposDeServicos (
    id_servico INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    preco REAL NOT NULL
);
```

### 6. Criação da Tabela `ServicoContratado`:

Esta tabela faz referência às tabelas `TiposDeServicos`, `Pet` e `Cliente`. Cada serviço contratado é associado a um tipo de serviço, um pet e um cliente.

```sql
CREATE TABLE ServicoContratado (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    id_servico INTEGER NOT NULL,
    descricao TEXT NOT NULL,
    id_registro INTEGER NOT NULL,
    id_cpf TEXT NOT NULL,
    DataSolicitada DATE NOT NULL,
    status TEXT NOT NULL,
    FOREIGN KEY(id_servico) REFERENCES TiposDeServicos(id_servico),
    FOREIGN KEY(id_registro) REFERENCES Pet(id_registro),
    FOREIGN KEY(id_cpf) REFERENCES Cliente(id_cpf)
);
```

### Resumo das Relacionamentos:

1. **Cliente → Endereco**: O endereço de um cliente é uma linha na tabela `Endereco`, identificada pelo `id_cpf`, que é a chave primária em `Cliente`.
2. **Cliente → Pet**: Cada `Pet` pertence a um `Cliente`, e isso é indicado pela chave estrangeira `dono` na tabela `Pet`, que aponta para o `id_cpf` em `Cliente`.
3. **ServicoContratado → TiposDeServicos, Pet, Cliente**: A tabela `ServicoContratado` faz referência ao tipo de serviço (via `id_servico`), ao pet (via `id_registro`) e ao cliente (via `id_cpf`).

Você pode usar a seguinte consulta SQL para inserir os dados de serviços na tabela `TiposDeServicos` no banco de dados SQLite. Para cada serviço do array `servicos`, geramos um `INSERT INTO` para a tabela `TiposDeServicos`:

```sql
INSERT INTO TiposDeServicos (nome, preco) VALUES
("Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos", 80.00),
("Tosa Higiênica (Orelhas e Região Íntima)", 30.00),
("Tosa de Raças Específicas (Poodle, Shih Tzu, etc.)", 100.00),
("Higiene Bucal (Limpeza de Dentes)", 50.00),
("Corte de Unhas", 20.00),
("Limpeza de Ouvidos", 25.00),
("Escovação de Pelo", 40.00),
("Consultas Veterinárias", 60.00),
("Vacinação", 35.00),
("Vermifugação", 25.00),
("Esterilização (Castração)", 250.00),
("Análises Clínicas", 80.00),
("Emergências Veterinárias", 150.00),
("Hospedagem (Pet Hotel)", 100.00),
("Creche para Cães", 50.00);
```

Este `INSERT INTO` vai inserir todos os serviços do array no banco de dados na tabela `TiposDeServicos`.

Se for usar isso em um script JavaScript com SQLite, o código seria algo assim (utilizando `sqlite3` como exemplo):

```javascript
const sqlite3 = require('sqlite3').verbose();
const db = new sqlite3.Database('seu_banco_de_dados.db');

const servicos = [
    { "nome": "Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos", "preco": 80.00 },
    { "nome": "Tosa Higiênica (Orelhas e Região Íntima)", "preco": 30.00 },
    { "nome": "Tosa de Raças Específicas (Poodle, Shih Tzu, etc.)", "preco": 100.00 },
    { "nome": "Higiene Bucal (Limpeza de Dentes)", "preco": 50.00 },
    { "nome": "Corte de Unhas", "preco": 20.00 },
    { "nome": "Limpeza de Ouvidos", "preco": 25.00 },
    { "nome": "Escovação de Pelo", "preco": 40.00 },
    { "nome": "Consultas Veterinárias", "preco": 60.00 },
    { "nome": "Vacinação", "preco": 35.00 },
    { "nome": "Vermifugação", "preco": 25.00 },
    { "nome": "Esterilização (Castração)", "preco": 250.00 },
    { "nome": "Análises Clínicas", "preco": 80.00 },
    { "nome": "Emergências Veterinárias", "preco": 150.00 },
    { "nome": "Hospedagem (Pet Hotel)", "preco": 100.00 },
    { "nome": "Creche para Cães", "preco": 50.00 }
];

servicos.forEach(servico => {
    const stmt = db.prepare("INSERT INTO TiposDeServicos (nome, preco) VALUES (?, ?)");
    stmt.run(servico.nome, servico.preco, (err) => {
        if (err) {
            console.log("Erro ao inserir serviço: ", err);
        } else {
            console.log(`Serviço "${servico.nome}" inserido com sucesso!`);
        }
    });
    stmt.finalize();
});

db.close();
```

Esse código prepara as instruções SQL para cada serviço e as insere no banco de dados.

No seu modelo, o campo `endereco` na tabela `Cliente` não deve armazenar o CPF nem um número incrementado. Isso porque a tabela `Endereco` já possui um campo de chave estrangeira (`id_cpf`) que referencia o CPF do cliente, enquanto o campo `endereco` na tabela `Cliente` não seria necessário, já que a relação entre `Cliente` e `Endereco` é feita de forma separada.

### Correção para a Tabela `Cliente`:

A tabela `Cliente` não precisa ter o campo `endereco`. A relação entre `Cliente` e `Endereco` será estabelecida via o campo `id_cpf` na tabela `Endereco`, que é a chave estrangeira apontando para o `id_cpf` da tabela `Cliente`.

Aqui está como a tabela `Cliente` deve ficar:

```sql
CREATE TABLE Cliente (
    id_cpf TEXT PRIMARY KEY,  -- CPF do cliente (único e chave primária)
    nome TEXT NOT NULL,
    telefone TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    status TEXT NOT NULL
);
```

### Tabela `Endereco`:

Como já discutimos, a tabela `Endereco` é que vai armazenar o `id_cpf` como chave estrangeira que faz referência ao `Cliente`, e o campo `id_endereco` será a chave primária.

```sql
CREATE TABLE Endereco (
    id_endereco INTEGER PRIMARY KEY AUTOINCREMENT,  -- Identificador único do endereço
    id_cpf TEXT NOT NULL,                           -- CPF do cliente (chave estrangeira)
    cidade TEXT NOT NULL,
    bairro TEXT NOT NULL,
    estado TEXT NOT NULL,
    cep TEXT NOT NULL,
    rua TEXT NOT NULL,
    FOREIGN KEY(id_cpf) REFERENCES Cliente(id_cpf)  -- Chave estrangeira referenciando a tabela Cliente
);
```

### Como funciona:

* **Tabela `Cliente`**: Não contém um campo `endereco`, pois a tabela `Endereco` já mantém o relacionamento com o `Cliente` através do `id_cpf`.
* **Tabela `Endereco`**: A tabela `Endereco` contém o campo `id_cpf`, que é uma chave estrangeira referenciando o `id_cpf` da tabela `Cliente`. Assim, cada cliente pode ter um ou mais endereços.

### Exemplo de inserção de um cliente e endereço:

1. **Inserir um cliente**:

```sql
INSERT INTO Cliente (id_cpf, nome, telefone, email, status)
VALUES ('12345678900', 'João Silva', '1234-5678', 'joao.silva@email.com', 'Ativo');
```

2. **Inserir o endereço do cliente**:

```sql
INSERT INTO Endereco (id_cpf, cidade, bairro, estado, cep, rua)
VALUES ('12345678900', 'São Paulo', 'Centro', 'SP', '12345-678', 'Rua Exemplo, 123');
```

### Conclusão:

Na tabela `Cliente`, você **não deve** incluir um campo chamado `endereco`. O relacionamento é feito pela tabela `Endereco`, onde o campo `id_cpf` na tabela `Endereco` se torna a chave estrangeira que liga o endereço ao cliente. Isso mantém a normalização do banco de dados e a relação correta entre as tabelas.

Para adicionar um pet na tabela `Pet`, você precisa inserir um registro fornecendo o nome do pet, espécie, raça e o `id_cpf` do dono (cliente). Como o campo `dono` é uma chave estrangeira que referencia o `id_cpf` de um cliente, você precisa garantir que o cliente já exista antes de inserir o pet.

### Exemplo de inserção de um pet:

Vamos supor que você tem um cliente com o CPF `12345678900`. Vamos adicionar um pet para esse cliente.

```sql
-- Insere um pet para o cliente com CPF '12345678900'
INSERT INTO Pet (nome, especie, raca, dono) 
VALUES ('Rex', 'Cão', 'Labrador', '12345678900');
```

### Explicações:

* **`nome`**: Nome do pet, neste caso, "Rex".
* **`especie`**: Espécie do pet, neste caso, "Cão".
* **`raca`**: Raça do pet, neste caso, "Labrador".
* **`dono`**: O CPF do cliente que é o dono do pet. Neste exemplo, o CPF é `12345678900`, e ele já deve estar presente na tabela `Cliente`.

### Inserindo um Cliente e depois o Pet:

1. **Inserir um Cliente (caso ainda não exista)**:

```sql
-- Insere um cliente com CPF '12345678900'
INSERT INTO Cliente (id_cpf, nome, telefone, email, status)
VALUES ('12345678900', 'João Silva', '1234-5678', 'joao.silva@email.com', 'Ativo');
```

2. **Inserir o Pet para esse Cliente**:

```sql
-- Insere um pet para o cliente com CPF '12345678900'
INSERT INTO Pet (nome, especie, raca, dono)
VALUES ('Rex', 'Cão', 'Labrador', '12345678900');
```

Agora, o pet "Rex" será associado ao cliente "João Silva", e o CPF dele será usado como chave estrangeira para o campo `dono` na tabela `Pet`.

Se você quiser adicionar mais pets, basta repetir o processo e garantir que o `id_cpf` do cliente esteja correto.
Para adicionar um serviço na tabela `ServicoContratado`, você precisa inserir um registro fornecendo o `id_servico` (que referencia a tabela `TiposDeServicos`), o `id_registro` (que referencia a tabela `Pet`), o `id_cpf` (que referencia a tabela `Cliente`), a `DataSolicitada` e o `status` do serviço.

### Exemplo de Inserção de um Serviço:

Vamos adicionar um serviço contratado para o pet "Rex" do cliente "João Silva". O serviço escolhido será "Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos".

### Passos:

1. **Primeiro, precisamos verificar o `id_servico`** para o serviço desejado. Nesse caso, vamos supor que o serviço "Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos" tenha `id_servico = 1` (isso pode ser verificado consultando a tabela `TiposDeServicos`).
2. **Obtemos o `id_registro` do pet**: O pet "Rex" tem o `id_registro` que você inseriu anteriormente (vamos supor que o `id_registro` de "Rex" seja `1`).
3. **Obtemos o `id_cpf` do cliente**: O cliente "João Silva" tem o `id_cpf = '12345678900'`.

Agora, podemos inserir o serviço solicitado para o pet.

### Consulta SQL para inserir o serviço contratado:

```sql
-- Insere um serviço contratado para o pet "Rex" do cliente "João Silva"
INSERT INTO ServicoContratado (id_servico, descricao, id_registro, id_cpf, DataSolicitada, status)
VALUES (1, 'Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos', 1, '12345678900', '2025-10-21', 'Agendado');
```

### Explicação dos campos:

* **`id_servico`**: O ID do serviço escolhido (no caso, `1` para o serviço "Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos").
* **`descricao`**: A descrição do serviço (neste caso, a descrição do serviço que foi contratado).
* **`id_registro`**: O ID do pet que está contratando o serviço (neste caso, `1`, que é o `id_registro` do pet "Rex").
* **`id_cpf`**: O CPF do cliente que está contratando o serviço (neste caso, `'12345678900'`).
* **`DataSolicitada`**: A data em que o serviço foi solicitado (neste caso, `2025-10-21`).
* **`status`**: O status do serviço (neste caso, `'Agendado'`, mas pode ser alterado conforme o andamento do serviço).

### Verificando o ID do serviço e do pet:

Caso queira verificar o ID do serviço e o ID do pet, você pode executar as seguintes consultas:

1. **Verificar o `id_servico`** para "Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos":

```sql
SELECT id_servico, nome FROM TiposDeServicos WHERE nome = 'Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos';
```

2. **Verificar o `id_registro`** para o pet "Rex":

```sql
SELECT id_registro, nome FROM Pet WHERE nome = 'Rex';
```

Após essas verificações, você pode ajustar o código de inserção conforme os valores reais de `id_servico` e `id_registro`.

Se precisar de mais ajuda ou quiser fazer outro tipo de inserção, é só avisar!
