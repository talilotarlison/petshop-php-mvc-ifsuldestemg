-- 1. Criação da Tabela Usuario:
CREATE TABLE Usuario (
    id_usuario INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    data DATE NOT NULL,
    email TEXT NOT NULL UNIQUE,
    senha TEXT NOT NULL
);

-- 2. Criação da Tabela Cliente:
CREATE TABLE Cliente (
    id_cliente INTEGER PRIMARY KEY AUTOINCREMENT,
    id_cpf TEXT NOT NULL UNIQUE,
    nome TEXT NOT NULL,
    telefone TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    status TEXT NOT NULL
);

-- 3. Criação da Tabela Endereco:

-- A tabela Endereco tem como chave primária o id_cpf que faz referência à chave primária de Cliente.
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


-- 4. Criação da Tabela Pet:

-- A tabela Pet tem um relacionamento com a tabela Cliente através da chave Cliente_id_cpf, que é uma chave estrangeira que aponta para a chave primária de Cliente.

CREATE TABLE Pet (
    id_registro INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    especie TEXT NOT NULL,
    raca TEXT NOT NULL,
    dono TEXT NOT NULL,
    FOREIGN KEY(dono) REFERENCES Cliente(id_cpf)
);

-- 5. Criação da Tabela TiposDeServicos:

-- A tabela de serviços com um identificador único para cada tipo de serviço e o preço associado.

CREATE TABLE TiposDeServicos (
    id_servico INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    preco REAL NOT NULL
);

-- 6. Criação da Tabela ServicoContratado:

-- Esta tabela faz referência às tabelas TiposDeServicos, Pet e Cliente. Cada serviço contratado é associado a um tipo de serviço, um pet e um cliente.

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

