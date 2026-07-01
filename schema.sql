-- ============================================================================
-- Banco de dados — Aline Politi (MySQL 8 / MariaDB 10.4+)
-- Importe: mysql -u root -p < schema.sql   (ou via phpMyAdmin > Importar)
-- ============================================================================

CREATE DATABASE IF NOT EXISTS alinepoliti
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE alinepoliti;

-- ---- Perguntas frequentes ----
CREATE TABLE IF NOT EXISTS faq (
  id        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  pergunta  VARCHAR(255) NOT NULL,
  resposta  TEXT NOT NULL,
  ordem     INT NOT NULL DEFAULT 0,
  ativo     TINYINT(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---- Posts do blog ----
CREATE TABLE IF NOT EXISTS posts (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug          VARCHAR(200) NOT NULL UNIQUE,
  titulo        VARCHAR(255) NOT NULL,
  resumo        VARCHAR(500) NULL,
  conteudo      MEDIUMTEXT NOT NULL,
  capa          VARCHAR(255) NULL,
  publicado_em  DATETIME NULL,
  ativo         TINYINT(1) NOT NULL DEFAULT 1,
  criado_em     DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---- Mensagens do formulário de contato ----
CREATE TABLE IF NOT EXISTS contatos (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome       VARCHAR(150) NOT NULL,
  email      VARCHAR(190) NOT NULL,
  mensagem   TEXT NOT NULL,
  ip         VARCHAR(45) NULL,
  lido       TINYINT(1) NOT NULL DEFAULT 0,
  criado_em  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ---- Usuários da área restrita ----
CREATE TABLE IF NOT EXISTS usuarios (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nome       VARCHAR(120) NOT NULL,
  email      VARCHAR(190) NOT NULL UNIQUE,
  senha_hash VARCHAR(255) NOT NULL,
  criado_em  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Admin inicial — e-mail: atendimento@alinepoliti.com.br
-- A senha NÃO fica versionada (só o hash). TROQUE no primeiro acesso:
--   gere um novo hash com  php -r "echo password_hash('SUA_SENHA', PASSWORD_DEFAULT);"
--   e rode  UPDATE usuarios SET senha_hash='<hash>' WHERE email='atendimento@alinepoliti.com.br';
INSERT INTO usuarios (nome, email, senha_hash) VALUES
('Aline Politi', 'atendimento@alinepoliti.com.br', '$2y$10$/RZEHa84fkDyq.JDwa2ZhuI9qoZRk5fD9KwhGOQy8sxEssLumFsQi')
ON DUPLICATE KEY UPDATE email = email;

-- ---- Seed do FAQ (mesmo conteúdo do design) ----
INSERT INTO faq (pergunta, resposta, ordem) VALUES
('O que é a Terapia Cognitivo-Comportamental?', 'A TCC é uma abordagem psicológica estruturada e baseada em evidências, que entende que pensamentos, emoções e comportamentos estão interligados. O trabalho clínico foca em compreender e ressignificar padrões que geram sofrimento.', 1),
('Como funciona o atendimento online?', 'As sessões acontecem por videochamada em plataforma segura, com mesmo sigilo e qualidade do atendimento presencial — conforme a Resolução CFP 11/2018.', 2),
('Qual a duração de cada sessão?', 'As sessões duram em média 50 minutos e costumam ter periodicidade semanal, definida em conjunto após a entrevista inicial.', 3),
('Quanto tempo dura o processo terapêutico?', 'A TCC é considerada uma terapia de médio prazo. A duração depende da demanda, dos objetivos terapêuticos e do engajamento — sendo sempre revisada periodicamente.', 4),
('Você atende crianças?', 'Sim. O atendimento clínico individual é para crianças a partir de 10 anos, adolescentes, adultos e casais. Para crianças menores de 10 anos, ofereço o serviço de Orientação de Pais.', 5),
('Como faço para agendar a primeira consulta?', 'O primeiro contato pode ser feito pelo WhatsApp ou e-mail. Após uma breve conversa, agendamos a sessão inicial de acolhimento.', 6),
('Você atende Unimed ou algum outro convênio?', 'Com toda a transparência: no momento não atendo por convênios — incluindo a Unimed. Sei que isso pode pesar na sua decisão, e por isso a primeira sugestão é entrar em contato com o seu plano de saúde para conhecer os profissionais credenciados disponíveis.', 7),
('Você emite recibo para reembolso?', 'Sim. Emito recibo padrão que pode ser apresentado a planos de saúde e usado para Imposto de Renda.', 8);
