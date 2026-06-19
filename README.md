# Site Aline Politi — PHP + MySQL

Reescrita do design feito no Lovable (TanStack/React) para **PHP 8 puro + MySQL**,
pronto para hospedagem compartilhada (cPanel/Hostinger/Hostgator). Sem build, sem Node.

## Stack
- **PHP 8.x** (PDO) — sem framework, front controller + roteador próprio.
- **MySQL/MariaDB** — FAQ, blog e mensagens de contato. *(O site funciona mesmo sem banco: FAQ cai para conteúdo padrão e o blog mostra "em construção".)*
- **Tailwind via CDN** (config inline) + ícones SVG inline. Fontes Google (Cormorant Garamond, Fraunces, Manrope).

## Estrutura
```
site/
├── public/              ← docroot (apontar o servidor para CÁ)
│   ├── index.php        ← front controller (rotas + SEO + contato + sitemap.xml)
│   ├── .htaccess        ← rotas amigáveis
│   ├── robots.txt
│   └── assets/          ← logo e imagens (placeholders SVG — troque pelas reais)
├── app/
│   ├── config.php       ← credenciais do banco + dados de contato (FONTE ÚNICA)
│   ├── db.php           ← conexão PDO (resiliente)
│   ├── helpers.php      ← e(), url(), icon(), nav, faq_items(), blog_posts()
│   ├── components.php   ← header, footer, page_hero, cta_section, prose
│   └── layout.php       ← shell HTML + <head> (meta, OG, JSON-LD, Tailwind)
├── views/               ← uma página por rota (conteúdo)
└── schema.sql           ← banco + seed do FAQ
```

## Rodar localmente
```bash
cd site
php -S localhost:8000 -t public
# abra http://localhost:8000
```
Funciona **sem MySQL** (conteúdo padrão). Para ativar o banco:
```bash
mysql -u root -p < schema.sql
# edite app/config.php com DB_NAME/DB_USER/DB_PASS  (ou use variáveis de ambiente)
```

## Publicar em hospedagem compartilhada
1. Suba a pasta `site/` para o servidor.
2. **Aponte o docroot do domínio para `site/public`** (ideal).
   - Se não for possível mudar o docroot, use o `.htaccess` da raiz (já incluído) que encaminha para `/public`.
3. Crie o banco no painel (phpMyAdmin → Importar `schema.sql`).
4. Edite `app/config.php` com as credenciais do banco da hospedagem.
5. Confirme `mod_rewrite` ativo (padrão na maioria dos Apache).

## Onde editar o quê
- **Telefone / WhatsApp / e-mail / Instagram / endereço / CRP** → `app/config.php` (muda no site inteiro).
- **Textos das páginas** → arquivos em `views/`.
- **FAQ** → tabela `faq` no banco (ou `faq_default()` em `app/helpers.php`).
- **Blog** → tabela `posts` (cria `/blog/{slug}` automaticamente). Sem posts → mostra "em construção".
- **Imagens** → troque os SVGs em `public/assets/` (`logo.svg`, `logo-negativo.svg`, `portrait.svg`, `banner.svg`) pelas reais. Pode usar `.jpg/.png` — ajuste o caminho em `views/home.php`, `views/a-psicologa/index.php` e `app/components.php`.

## SEO / GEO já incluídos
- `<title>`, meta description e **canonical** por página.
- Open Graph + Twitter Card.
- **JSON-LD** `Psychologist` em todo o site + `FAQPage` na página de perguntas.
- `sitemap.xml` dinâmico (`/sitemap.xml`) + `robots.txt` liberando robôs de IA.

## Para produção (recomendado depois)
- **Compilar o Tailwind** em vez do CDN (melhor performance / sem flash). Use o
  binário standalone do Tailwind (não exige Node) para gerar um `app.css` e troque
  o `<script src="cdn.tailwindcss.com">` por `<link rel="stylesheet">`.
- Trocar os placeholders SVG por fotos reais (e gerar um `og-default.jpg` 1200×630).
- Conferir o envio de e-mail do formulário (a função `mail()` depende do servidor;
  se necessário, plugar SMTP).

> Contato: as mensagens são gravadas na tabela `contatos` **e** enviadas por e-mail
> (best effort) para `atendimento@alinepoliti.com.br`.
