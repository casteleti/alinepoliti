<?php
declare(strict_types=1);

/*
 * Configuração central — Aline Politi (PHP + MySQL)
 * Em hospedagem compartilhada: edite os valores de DB_* abaixo
 * (ou defina variáveis de ambiente DB_HOST/DB_NAME/DB_USER/DB_PASS).
 */

// Caminho base ('' se o site fica na raiz do domínio).
const BASE_URL = '';

// ---- Banco de dados (MySQL) ----
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_NAME', getenv('DB_NAME') ?: 'alinepoliti');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_CHARSET', 'utf8mb4');

// ---- Dados de contato (FONTE ÚNICA — mude aqui e reflete no site todo) ----
const SITE_NAME             = 'Aline Politi';
const SITE_TAGLINE          = 'Psicologia & Terapia Cognitivo-Comportamental';
const SITE_CRP              = 'CRP 06/113904';
const SITE_WHATSAPP_NUMBER  = '5516996044043';           // (16) 99604-4043
const SITE_WHATSAPP_MSG     = 'Olá Aline, gostaria de agendar uma consulta.';
const SITE_EMAIL            = 'atendimento@alinepoliti.com.br';
const SITE_PHONE_E164       = '+551632024733';            // (16) 3202-4733
const SITE_PHONE_LABEL      = '(16) 3202-4733';
const SITE_INSTAGRAM_URL    = 'https://instagram.com/alinepoliti';
const SITE_INSTAGRAM_HANDLE = '@alinepoliti';
const SITE_ADDRESS          = 'Avenida 15 de Novembro, 418 — Centro, Jaboticabal/SP · CEP 14870-600';
const SITE_THEME_COLOR      = '#117B7F';

// URL canônica de produção (usada no sitemap e nas tags canonical absolutas).
// ⚠️ Confirme/ajuste se o domínio final for outro.
const SITE_ORIGIN = 'https://www.alinepoliti.com.br';

// Google Analytics 4 (gtag). Deixe vazio para desativar (ex.: em testes locais).
const GA_MEASUREMENT_ID = 'G-KD55BQNYBC';

// Google Tag Manager. Deixe vazio para desativar.
// ⚠️ NÃO crie tag de page_view do GA4 dentro do GTM (o gtag acima já faz) — evita pageview duplicado.
const GTM_CONTAINER_ID = 'GTM-N9KKF9ZT';

// Ambiente
define('IS_DEV', (getenv('APP_ENV') ?: 'dev') === 'dev');
error_reporting(E_ALL);
ini_set('display_errors', IS_DEV ? '1' : '0');
