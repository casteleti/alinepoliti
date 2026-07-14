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
const SITE_PHONE_E164       = '+5516996044043';           // (16) 99604-4043 — WhatsApp, número canônico do NAP (= GMB)
const SITE_PHONE_LABEL      = '(16) 99604-4043';
const SITE_INSTAGRAM_URL    = 'https://www.instagram.com/aline_politi/';
const SITE_INSTAGRAM_HANDLE = '@aline_politi';
const SITE_ADDRESS          = 'Avenida 15 de Novembro, 418 — Centro, Jaboticabal/SP · CEP 14870-600';
const SITE_THEME_COLOR      = '#117B7F';

// URL canônica de produção (usada no sitemap, robots e nas tags canonical/OG absolutas).
// Host canônico = apex sem www (o www já redireciona 301 pro apex com cert válido).
const SITE_ORIGIN = 'https://alinepoliti.com.br';

// Google Analytics 4 (gtag). Deixe vazio para desativar (ex.: em testes locais).
const GA_MEASUREMENT_ID = 'G-KD55BQNYBC';

// Google Tag Manager. Deixe vazio para desativar.
// ⚠️ NÃO crie tag de page_view do GA4 dentro do GTM (o gtag acima já faz) — evita pageview duplicado.
const GTM_CONTAINER_ID = 'GTM-N9KKF9ZT';

// Meta Pixel (Facebook/Instagram Ads). Deixe vazio para desativar.
// Preencha com o ID do pixel para ativar rastreamento de PageView/Contact/Lead.
const META_PIXEL_ID = '';

// -------- Envio de e-mail (defina no ambiente do servidor — NUNCA versionar senhas) --------
// Preferência: 1) SMTP autenticado (caixa do próprio domínio) → 2) Resend → 3) mail() nativo.
//
// SMTP (recomendado — usa um e-mail real do domínio):
//   SMTP_HOST   ex.: smtp.hostinger.com / smtp.zoho.com / smtp.gmail.com / mail.seudominio
//   SMTP_PORT   587 (STARTTLS) ou 465 (SSL)
//   SMTP_SECURE 'tls' (para 587) ou 'ssl' (para 465)
//   SMTP_USER   caixa completa, ex.: atendimento@alinepoliti.com.br
//   SMTP_PASS   senha da caixa (ideal: senha de app)
define('SMTP_HOST',      getenv('SMTP_HOST') ?: '');
define('SMTP_PORT',      (int)(getenv('SMTP_PORT') ?: 587));
define('SMTP_SECURE',    getenv('SMTP_SECURE') ?: 'tls');
define('SMTP_USER',      getenv('SMTP_USER') ?: '');
define('SMTP_PASS',      getenv('SMTP_PASS') ?: '');
define('MAIL_FROM',      getenv('MAIL_FROM') ?: '');            // default: SMTP_USER
define('MAIL_FROM_NAME', getenv('MAIL_FROM_NAME') ?: 'Site Aline Politi');

// Resend (alternativa por API — opcional). Sem SMTP nem chave, cai no mail() nativo.
define('RESEND_API_KEY', getenv('RESEND_API_KEY') ?: '');
define('RESEND_FROM',    getenv('RESEND_FROM') ?: 'Site Aline Politi <contato@alinepoliti.com.br>');

// Ambiente
define('IS_DEV', (getenv('APP_ENV') ?: 'dev') === 'dev');
error_reporting(E_ALL);
ini_set('display_errors', IS_DEV ? '1' : '0');
