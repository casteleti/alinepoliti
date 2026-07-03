-- ============================================================================
-- Migração da tabela `contatos` — adiciona telefone, assunto e origem.
-- Aplicar UMA vez no banco de produção (que já existe e não roda o initdb de novo).
--
-- No servidor (dentro da pasta do projeto):
--   docker compose exec -T db mysql -ualinepoliti -p"$DB_PASS" alinepoliti < data/alter_contatos.sql
--
-- MySQL 8 não suporta "ADD COLUMN IF NOT EXISTS"; rode só uma vez.
-- ============================================================================
USE alinepoliti;

ALTER TABLE contatos
  ADD COLUMN telefone VARCHAR(40)  NOT NULL DEFAULT ''        AFTER email,
  ADD COLUMN assunto  VARCHAR(80)  NULL                        AFTER telefone,
  ADD COLUMN origem   VARCHAR(40)  NOT NULL DEFAULT 'contato'  AFTER assunto;
