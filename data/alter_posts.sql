-- ============================================================================
-- Migração da tabela `posts` — campos de SEO/GEO do editor de blog.
-- Aplicar UMA vez no banco de produção já existente.
--   docker compose exec -T db mysql -ualinepoliti -p"$DB_PASS" alinepoliti < data/alter_posts.sql
-- MySQL 8 não suporta "ADD COLUMN IF NOT EXISTS"; rode só uma vez.
-- ============================================================================
USE alinepoliti;

ALTER TABLE posts
  ADD COLUMN meta_titulo    VARCHAR(70)  NULL AFTER capa,
  ADD COLUMN meta_descricao VARCHAR(180) NULL AFTER meta_titulo,
  ADD COLUMN keyword_foco   VARCHAR(120) NULL AFTER meta_descricao,
  ADD COLUMN tags           VARCHAR(600) NULL AFTER keyword_foco,
  ADD COLUMN tldr           TEXT NULL         AFTER tags,
  ADD COLUMN faq            MEDIUMTEXT NULL   AFTER tldr,
  ADD COLUMN fontes         TEXT NULL         AFTER faq;
