SHOW databases;

CREATE DATABASE IF NOT EXISTS teste_sql;

USE teste_sql;

CREATE TABLE IF NOT EXISTS produtos(
	cod_prod int(8),
	loj_prod int(8),
	desc_prod varchar(40),
	dt_inclu_prod date,
	preco_prod decimal(8,3),
	PRIMARY KEY (cod_prod, loj_prod)
	
);

SHOW tables;

INSERT INTO produtos 
(cod_prod, loj_prod, desc_prod, dt_inclu_prod, preco_prod)
VALUES 
(170, 2, 'LEITE CONDENSADO MOCOCA', "2010/12/30", 45.40);

SELECT * FROM produtos;

UPDATE produtos SET preco_prod = 95.40
WHERE cod_prod = 170 AND loj_prod = 2;

SELECT * FROM produtos WHERE loj_prod IN(1,2); 

SELECT MIN(dt_inclu_prod) AS menor_data, MAX(dt_inclu_prod) AS maior_data
FROM produtos;

SELECT *
FROM produtos
WHERE dt_inclu_prod = (SELECT MAX(dt_inclu_prod) FROM produtos)
OR dt_inclu_prod = (SELECT MIN(dt_inclu_prod) FROM produtos);

SELECT COUNT(*) AS quantidade_produtos
FROM produtos;

SELECT *
FROM produtos
WHERE desc_prod LIKE 'L%';

SELECT SUM(preco_prod) AS preco_total FROM produtos;

SELECT loj_prod, SUM(preco_prod)
AS valor_total_prod
FROM produtos
GROUP BY loj_prod
HAVING valor_total_prod > 100;

CREATE TABLE IF NOT EXISTS estoques(
	cod_prod int(8),
	loj_prod int(8),
	qtd_prod decimal(15,3),
	PRIMARY KEY (cod_prod, loj_prod)
);

CREATE TABLE IF NOT EXISTS lojas(
	loj_prod int(8),
	desc_loj varchar(40),
	PRIMARY KEY (loj_prod)
);

SELECT p.loj_prod,
l.desc_loj, p.cod_prod,
p.desc_prod, p.preco_prod,
e.qtd_prod
FROM produtos AS p
JOIN lojas AS l ON p.loj_prod = l.loj_prod
JOIN estoques AS e ON l.loj_prod = e.loj_prod AND e.cod_prod = p.cod_prod
WHERE l.loj_prod = 1;

SELECT * FROM produtos 
WHERE (cod_prod, loj_prod) NOT IN (
	SELECT cod_prod, loj_prod
	FROM estoques
)

#para saber a o produto q não existe em produtos com a desc_prod de outras lojas
SELECT p.desc_prod, e.* FROM estoques AS e
JOIN produtos AS p ON p.cod_prod = e.cod_prod 
WHERE (e.cod_prod , e.loj_prod) NOT IN (
	SELECT cod_prod, loj_prod
	FROM produtos
)

#para saber sem a desc_prod
SELECT * FROM estoques 
WHERE (cod_prod, loj_prod) NOT IN (
	SELECT cod_prod, loj_prod
	FROM produtos
)


