CREATE DATABASE IF NOT EXISTS av1_daw CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE av1_daw;

CREATE TABLE IF NOT EXISTS perguntas (
    id        INT PRIMARY KEY,
    pergunta  VARCHAR(255) NOT NULL,
    resposta1 VARCHAR(255) NOT NULL,
    resposta2 VARCHAR(255) NOT NULL,
    resposta3 VARCHAR(255) NOT NULL,
    correta   TINYINT NOT NULL
);

CREATE TABLE IF NOT EXISTS perguntas_texto (
    id       INT PRIMARY KEY,
    pergunta VARCHAR(255) NOT NULL,
    resposta TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS usuarios (
    id    INT AUTO_INCREMENT PRIMARY KEY,
    nome  VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
);

INSERT INTO perguntas (id, pergunta, resposta1, resposta2, resposta3, correta) VALUES
(1, 'Qual é a capital da França?', 'Paris', 'Roma', 'Lisboa', 1),
(2, 'Qual o diminutivo de sapo?', 'Sapeto', 'Sapinho', 'Sapão', 2),
(3, 'Quanto é 25 + 47?', '66', '72', '62', 2),
(4, 'Qual é o menor país do mundo?', 'Andorra', 'Lichtenstein', 'Vaticano', 3),
(5, 'Quanto é 5000kg em litros?', '5 litros', '500 litros', '5000 litros', 3);

INSERT INTO perguntas_texto (id, pergunta, resposta) VALUES
(1, 'O que é liderança?', 'Capacidade de orientar uma equipe'),
(2, 'O que é planejamento?', 'Processo de definir objetivos e ações');

INSERT INTO usuarios (nome, email, senha) VALUES
('Henrique Jorge', 'henrique@gmail.com', '2000'),
('Natan', 'natan1522@gmail.com', '12345');
