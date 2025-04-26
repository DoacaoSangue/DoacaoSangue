-- Banco de dados: `doacao_sangue`

CREATE TABLE `tipos_sanguineos` (
  `id_tipo` SERIAL PRIMARY KEY,
  `tipo` VARCHAR(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `restricoes` (
  `id_tipo_doador` BIGINT UNSIGNED NOT NULL,
  `id_tipo_recebedor` BIGINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id_tipo_doador`, `id_tipo_recebedor`),
  CONSTRAINT `fk_doador_tipo` FOREIGN KEY (`id_tipo_doador`) REFERENCES `tipos_sanguineos`(`id_tipo`) ON DELETE CASCADE,
  CONSTRAINT `fk_recebedor_tipo` FOREIGN KEY (`id_tipo_recebedor`) REFERENCES `tipos_sanguineos`(`id_tipo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `usuarios` (
  `id_usuario` SERIAL PRIMARY KEY,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `nome` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(20) NOT NULL,
  `endereco` TEXT NOT NULL,
  `id_tipo_sanguineo` BIGINT UNSIGNED,
  `alergias` VARCHAR(255) DEFAULT NULL,
  `tipo_usuario` TINYINT(4) DEFAULT 0,
  `criado_em` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  CONSTRAINT `fk_usuario_tipo_sanguineo` FOREIGN KEY (`id_tipo_sanguineo`) REFERENCES `tipos_sanguineos`(`id_tipo`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE `doacoes` (
  `id_doacao` SERIAL PRIMARY KEY,
  `id_doador` BIGINT UNSIGNED NOT NULL,
  `id_recebedor` BIGINT UNSIGNED NOT NULL,
  `data` DATE NOT NULL,
  FOREIGN KEY (`id_doador`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `fk_doacao_recebedor` FOREIGN KEY (`id_recebedor`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO tipos_sanguineos (tipo) VALUES
('A+'),
('A-'),
('B+'),
('B-'),
('AB+'),
('AB-'),
('O+'),
('O-');


-- Inserção das restrições (somente incompatibilidades!)
INSERT INTO restricoes (id_tipo_doador, id_tipo_recebedor)
SELECT id_tipo_doador, id_tipo_recebedor FROM (
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'A-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'B-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'AB-') AS id_tipo_recebedor
    UNION ALL
    SELECT
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O+') AS id_tipo_doador,
        (SELECT id_tipo FROM tipos_sanguineos WHERE tipo = 'O-') AS id_tipo_recebedor
) AS sub;


INSERT INTO usuarios (
  email,
  nome,
  senha,
  telefone,
  endereco,
  id_tipo_sanguineo,
  alergias,
  tipo_usuario
) VALUES (
  'joao@gmail.com',
  'João da Silva',
  'Senha123@', -- normalmente aqui vai a senha já *criptografada* (hash)
  '(11) 91234-5678',
  'Rua das Flores, 123 - São Paulo, SP',
  NULL,
  NULL,
  1
);