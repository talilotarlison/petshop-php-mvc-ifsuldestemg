-- insere dados dos tipos de serviços oferecidos
-- insere dados dos tipos de serviços oferecidos
INSERT INTO TiposDeServicos (nome, preco) VALUES
('Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos', 80.00),
('Tosa Higiênica (Orelhas e Região Íntima)', 30.00),
('Tosa de Raças Específicas (Poodle, Shih Tzu, etc.)', 100.00),
('Higiene Bucal (Limpeza de Dentes)', 50.00),
('Corte de Unhas', 20.00),
('Limpeza de Ouvidos', 25.00),
('Escovação de Pelo', 40.00),
('Consultas Veterinárias', 60.00),
('Vacinação', 35.00),
('Vermifugação', 25.00),
('Esterilização (Castração)', 250.00),
('Análises Clínicas', 80.00),
('Emergências Veterinárias', 150.00),
('Hospedagem (Pet Hotel)', 100.00),
('Creche para Cães', 50.00);

-- add cliente
INSERT INTO Cliente (id_cpf, nome, telefone, email, status)
VALUES ('12345678900', 'João Silva', '1234-5678', 'joao.silva@email.com', 'Ativo');

--  add endereço
INSERT INTO Endereco (id_cpf, cidade, bairro, estado, cep, rua)
VALUES ('12345678900', 'São Paulo', 'Centro', 'SP', '12345-678', 'Rua Exemplo, 123');

-- busca clientes
SELECT * FROM Cliente join Endereco WHERE Cliente.id_cpf = Endereco.id_cpf;

-- Insere um pet para o cliente com CPF '12345678900'
INSERT INTO Pet (nome, especie, raca, dono)
VALUES ('Rex', 'Cão', 'Labrador', '12345678900');

-- busca todos os pets
SELECT * FROM Pet;

-- Insere um serviço contratado para o pet "Rex" do cliente "João Silva"
INSERT INTO ServicoContratado (id_servico, descricao, id_registro, id_cpf, DataSolicitada, status)
VALUES (1, 'Banho Completo e Tosa (Corte de Pelos) para Cães e Gatos', 1, '12345678900', '2025-10-21', 'Em Andamento');


-- sabe quem e o dono do cao
SELECT *  from ServicoContratado join Pet WHERE ServicoContratado.id_registro == Pet.id_registro;

-- sabe o tipo de serviço contratado

SELECT *  from ServicoContratado join TiposDeServicos WHERE TiposDeServicos.id_servico == ServicoContratado.id_servico;

-- busca servico contratado
SELECT s.id, p.nome, s.id_cpf, s.DataSolicitada, s.status
FROM ServicoContratado AS s
JOIN Pet AS p ON s.id_registro = p.id_registro;

-- busca servico contratado
SELECT
    s.id,
    p.nome AS nome_pet,
    c.nome AS nome_cliente,
    s.id_cpf,
    s.DataSolicitada,
    s.status
FROM ServicoContratado AS s
JOIN Pet AS p ON s.id_registro = p.id_registro
JOIN Cliente AS c ON s.id_cpf = c.id_cpf;

--- busca dados dos pets e clientes
SELECT p.id_registro, p.nome,  p.especie, p.raca, c.nome
FROM Pet AS p
JOIN Cliente AS c ON p.dono = c.id_cpf ORDER by p.id_registro ASC;

-- busca tipos de serviço
SELECT
    s.id,
    p.nome AS nome_pet,
    c.nome AS nome_cliente,
    t.nome AS nome_servico,
    t.preco AS preco_servico,
    s.id_cpf,
    s.descricao,
    s.DataSolicitada,
    s.status
FROM ServicoContratado AS s
JOIN Pet AS p ON s.id_registro = p.id_registro
JOIN Cliente AS c ON s.id_cpf = c.id_cpf
JOIN TiposDeServicos AS t ON s.id_servico = t.id_servico
ORDER BY s.DataSolicitada ASC;

-- busca serviços concluidos
SELECT s.id,
        p.nome AS nome_pet,
        c.nome AS nome_cliente,
        t.nome AS nome_servico,
        t.preco AS preco_servico,
        s.id_cpf,
        s.descricao,
        s.DataSolicitada,
        s.status
    FROM ServicoContratado AS s
    JOIN Pet AS p ON s.id_registro = p.id_registro
    JOIN Cliente AS c ON s.id_cpf = c.id_cpf
    JOIN TiposDeServicos AS t ON s.id_servico = t.id_servico
    WHERE s.status = "Concluído"
    ORDER BY s.DataSolicitada DESC;

