DROP DATABASE IF EXISTS saborCaseiro;
CREATE DATABASE saborCaseiro;
USE saborCaseiro;

DROP TABLE IF EXISTS produtos;
CREATE TABLE produtos(
    id INT UNSIGNED AUTO_INCREMENT NOT NULL,
    nome VARCHAR(30) NOT NULL,
    tipo ENUM("1", "2", "3") NOT NULL,
    preco DECIMAL(5, 2) NOT NULL CHECK(preco >= 1 AND preco <= 999.99),
    PRIMARY KEY(id)
);

DROP VIEW IF EXISTS consultarProdutos;
CREATE VIEW consultarProdutos AS
SELECT id AS idProduto, nome AS nomeProduto, tipo AS tipoProduto, preco AS precoProduto
FROM produtos;

DELIMITER //

DROP PROCEDURE IF EXISTS cadastrarProduto //
CREATE PROCEDURE cadastrarProduto(
    IN nomeProcedure VARCHAR(30), 
    IN tipoProcedure ENUM("1", "2", "3"), 
    IN precoProcedure DECIMAL(5, 2)
)
BEGIN
    INSERT INTO produtos(
        nome, 
        tipo, 
        preco
    ) VALUES(nomeProcedure, tipoProcedure, precoProcedure);
END //

DROP PROCEDURE IF EXISTS checarProdutoExiste //
CREATE PROCEDURE checarProdutoExiste(
    IN nomeProcedure VARCHAR(30), 
    IN tipoProcedure ENUM("1", "2", "3")
)
BEGIN
    SELECT nome AS nomeProduto
    FROM produtos
    WHERE nome = nomeProcedure AND tipo = tipoProcedure;
END //

DROP PROCEDURE IF EXISTS checarProdutoExisteID //
CREATE PROCEDURE checarProdutoExisteID(IN idProcedure INT)
BEGIN
    SELECT nome AS nomeProduto
    FROM produtos
    WHERE id = idProcedure;
END //

DROP PROCEDURE IF EXISTS editarProduto //
CREATE PROCEDURE editarProduto(
    IN idProcedure INT,
    IN nomeProcedure VARCHAR(30), 
    IN tipoProcedure ENUM("1", "2", "3"), 
    IN precoProcedure DECIMAL(5, 2)
)
BEGIN
    UPDATE produtos
    SET nome = nomeProcedure, tipo = tipoProcedure, preco = precoProcedure
    WHERE id = idProcedure;
END //

DROP PROCEDURE IF EXISTS deletarProduto //
CREATE PROCEDURE deletarProduto(IN idProcedure INT)
BEGIN
    DELETE FROM produtos WHERE id = idProcedure;
END //

DELIMITER ;

-- Teste 1: Inserir um produto válido
CALL cadastrarProduto('Produto A', '1', 15.00);

-- Verifique se o produto foi inserido corretamente
SELECT * FROM produtos WHERE nome = 'Produto A';

-- Teste 2: Checar se um produto existe por nome e tipo
CALL checarProdutoExiste('Produto A', '1');

-- Verifique o resultado retornado
SELECT * FROM produtos WHERE nome = 'Produto A' AND tipo = '1';

-- Suponha que o ID do produto inserido anteriormente é 1
CALL checarProdutoExisteID(1);

-- Verifique o resultado retornado
SELECT * FROM produtos WHERE id = 1;

-- Teste 3: Editar um produto existente
CALL editarProduto(1, 'Produto A Editado', '2', 20.00);

-- Verifique se o produto foi atualizado corretamente
SELECT * FROM produtos WHERE id = 1;

-- Teste 4: Deletar um produto
CALL deletarProduto(1);

-- Verifique se o produto foi excluído corretamente
SELECT * FROM produtos WHERE id = 1;

-- Teste 5: Verifique a estrutura da tabela produtos
DESCRIBE produtos;

-- Teste 6: Verifique a visualização consultarProdutos
SELECT * FROM consultarProdutos;
