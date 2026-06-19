<?php
declare(strict_types=1);

/* Front controller — Aline Politi (PHP + MySQL) */

define('ROOT', dirname(__DIR__));
define('APP', ROOT . '/app');
define('VIEWS', ROOT . '/views');

require APP . '/config.php';
require APP . '/db.php';
require APP . '/helpers.php';
require APP . '/components.php';

session_start();

/* ---- Resolve o caminho atual ---- */
$uri  = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';
$path = '/' . trim(urldecode($uri), '/');
if (BASE_URL !== '' && str_starts_with($path, BASE_URL)) {
    $path = '/' . trim(substr($path, strlen(BASE_URL)), '/');
}
if ($path === '') {
    $path = '/';
}
$GLOBALS['__path'] = $path;
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

/* ---- sitemap.xml ---- */
if ($path === '/sitemap.xml') {
    header('Content-Type: application/xml; charset=UTF-8');
    echo render_sitemap();
    exit;
}

/* ---- Envio do formulário de contato (POST → Redirect → GET) ---- */
if ($path === '/contato' && $method === 'POST') {
    handle_contato();
    exit;
}

/* ---- Área restrita ---- */
if ($path === '/admin' || str_starts_with($path, '/admin/')) {
    require APP . '/admin.php';
    admin_dispatch($path, $method);
    exit;
}

/* ---- Registro de rotas + metadados SEO ---- */
$routes = routes_table();

if (isset($routes[$path])) {
    $meta = $routes[$path];
    if ($path === '/perguntas-frequentes') {
        $meta['jsonld'] = build_faq_jsonld();
    }
    render($meta['view'], $meta);
} elseif (preg_match('#^/blog/([a-z0-9\-]+)$#', $path, $m) && ($post = find_post($m[1]))) {
    $GLOBALS['breadcrumb_leaf'] = $post['titulo'];
    render('blog-post.php', [
        'title'       => $post['titulo'] . ' | Blog — Aline Politi',
        'description' => $post['resumo'] ?: 'Artigo de Aline Politi sobre psicologia e TCC.',
        'canonical'   => '/blog/' . $post['slug'],
        'ogTitle'     => $post['titulo'],
        'jsonld'      => article_jsonld($post),
    ], ['post' => $post]);
} else {
    http_response_code(404);
    render('404.php', [
        'title'       => 'Página não encontrada — Aline Politi',
        'description' => 'A página que você procura não existe ou foi movida.',
    ]);
}

/* ========================================================================== */

function render(string $view, array $meta, array $vars = []): void
{
    extract($vars, EXTR_SKIP);
    ob_start();
    include VIEWS . '/' . $view;
    $content = ob_get_clean();
    include APP . '/layout.php';
}

function article_jsonld(array $post): string
{
    $pub = !empty($post['publicado_em']) ? date('c', strtotime((string)$post['publicado_em'])) : null;
    return json_encode(array_filter([
        '@context'      => 'https://schema.org',
        '@type'         => 'BlogPosting',
        'headline'      => $post['titulo'],
        'description'   => $post['resumo'] ?? null,
        'datePublished' => $pub,
        'inLanguage'    => 'pt-BR',
        'author'        => ['@type' => 'Person', 'name' => $post['autor'] ?? SITE_NAME],
        'publisher'     => ['@type' => 'Organization', 'name' => 'Aline Politi · Psicologia'],
        'mainEntityOfPage' => abs_url('/blog/' . $post['slug']),
    ]), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

function routes_table(): array
{
    return [
        '/' => [
            'view' => 'home.php',
            'title' => 'Aline Politi — Psicóloga Clínica & Terapia Cognitivo-Comportamental',
            'description' => 'Psicoterapia em TCC para adultos, orientação de pais e supervisão para psicólogos. Atendimento presencial e online com Aline Politi, CRP 06/113904.',
            'canonical' => '/', 'ogImage' => asset('og.jpg'),
        ],
        '/a-psicologa' => [
            'view' => 'a-psicologa/index.php',
            'title' => 'A Psicóloga | Aline Politi — Psicóloga Clínica em TCC',
            'description' => 'Conheça Aline Politi: trajetória acadêmica, especializações, pesquisas e os valores que guiam sua prática clínica em Terapia Cognitivo-Comportamental.',
            'canonical' => '/a-psicologa',
        ],
        '/a-psicologa/trajetoria' => [
            'view' => 'a-psicologa/trajetoria.php',
            'title' => 'Trajetória Acadêmica | Aline Politi',
            'description' => 'Formação acadêmica e profissional da psicóloga Aline Politi: graduação em Psicologia, especializações e prática clínica em TCC.',
            'canonical' => '/a-psicologa/trajetoria',
        ],
        '/a-psicologa/especializacoes' => [
            'view' => 'a-psicologa/especializacoes.php',
            'title' => 'Especializações | Aline Politi — TCC',
            'description' => 'Áreas de especialização da psicóloga Aline Politi em Terapia Cognitivo-Comportamental: ansiedade, depressão, orientação de pais e supervisão clínica.',
            'canonical' => '/a-psicologa/especializacoes',
        ],
        '/a-psicologa/pesquisas' => [
            'view' => 'a-psicologa/pesquisas.php',
            'title' => 'Pesquisas & Publicações | Aline Politi — Psicóloga',
            'description' => 'A produção acadêmica de Aline Politi: mestrado na USP (depressão materna e práticas parentais) e graduação na UNAERP (estilos parentais e adolescentes).',
            'canonical' => '/a-psicologa/pesquisas',
        ],
        '/a-psicologa/pesquisas/mestrado' => [
            'view' => 'a-psicologa/pesquisas-mestrado.php',
            'title' => 'Mestrado na USP: depressão materna e práticas parentais | Aline Politi',
            'description' => 'A pesquisa de mestrado de Aline Politi na USP (FFCLRP), sob orientação da Dra. Sônia Regina Loureiro: práticas educativas parentais e o comportamento de crianças que convivem com a depressão materna.',
            'canonical' => '/a-psicologa/pesquisas/mestrado',
        ],
        '/a-psicologa/pesquisas/graduacao' => [
            'view' => 'a-psicologa/pesquisas-graduacao.php',
            'title' => 'Graduação na UNAERP: estilos parentais e adolescentes | Aline Politi',
            'description' => 'A monografia de graduação de Aline Politi na UNAERP (2011): estilos parentais e comportamento de adolescentes — o início da sua linha de pesquisa em Psicologia.',
            'canonical' => '/a-psicologa/pesquisas/graduacao',
        ],
        '/a-psicologa/valores' => [
            'view' => 'a-psicologa/valores.php',
            'title' => 'Missão & Valores | Aline Politi',
            'description' => 'Os princípios éticos e os valores que orientam o cuidado psicológico oferecido por Aline Politi.',
            'canonical' => '/a-psicologa/valores',
        ],
        '/abordagem-tcc' => [
            'view' => 'abordagem-tcc/index.php',
            'title' => 'Abordagem TCC | Terapia Cognitivo-Comportamental — Aline Politi',
            'description' => 'Saiba o que é a Terapia Cognitivo-Comportamental (TCC), como funciona o atendimento presencial e online, orientação de pais e supervisão para psicólogos.',
            'canonical' => '/abordagem-tcc',
        ],
        '/abordagem-tcc/o-que-e' => [
            'view' => 'abordagem-tcc/o-que-e.php',
            'title' => 'O que é a TCC? | Terapia Cognitivo-Comportamental — Aline Politi',
            'description' => 'Entenda o que é a Terapia Cognitivo-Comportamental (TCC), como funciona o processo, sua duração e os benefícios comprovados.',
            'canonical' => '/abordagem-tcc/o-que-e',
        ],
        '/abordagem-tcc/terapias-contextuais' => [
            'view' => 'abordagem-tcc/terapias-contextuais.php',
            'title' => 'Terapias Contextuais (3ª onda da TCC) | ACT, DBT, Esquema e Compaixão — Aline Politi',
            'description' => 'As terapias contextuais — a 3ª onda da TCC: ACT (Hayes), DBT (Linehan), Terapia do Esquema (Young) e Terapia Focada na Compaixão (Gilbert, Neff). Abordagens atuais integradas à prática clínica.',
            'canonical' => '/abordagem-tcc/terapias-contextuais',
        ],
        '/atendimento/presencial' => [
            'view' => 'abordagem-tcc/presencial.php',
            'title' => 'Atendimento Presencial | Aline Politi — Psicóloga TCC',
            'description' => 'Consulta psicológica presencial em consultório, com toda a estrutura e o acolhimento da Terapia Cognitivo-Comportamental.',
            'canonical' => '/atendimento/presencial',
        ],
        '/atendimento/online' => [
            'view' => 'abordagem-tcc/online.php',
            'title' => 'Atendimento Online | Psicóloga TCC — Aline Politi',
            'description' => 'Psicoterapia online em TCC com a mesma qualidade clínica e ética do atendimento presencial — para todo o Brasil e brasileiros no exterior.',
            'canonical' => '/atendimento/online',
        ],
        '/abordagem-tcc/orientacao-de-pais' => [
            'view' => 'abordagem-tcc/orientacao-de-pais.php',
            'title' => 'Orientação de Pais | Aline Politi — Psicóloga TCC',
            'description' => 'Orientação parental baseada em TCC: suporte estratégico para os desafios da educação, manejo comportamental e fortalecimento de vínculos.',
            'canonical' => '/abordagem-tcc/orientacao-de-pais',
        ],
        '/abordagem-tcc/supervisao' => [
            'view' => 'abordagem-tcc/supervisao.php',
            'title' => 'Supervisão para Psicólogos | Aline Politi — TCC',
            'description' => 'Supervisão clínica para psicólogos que desejam aprofundar a prática em Terapia Cognitivo-Comportamental: discussão de casos, técnica e ética.',
            'canonical' => '/abordagem-tcc/supervisao',
        ],
        '/atendimento' => [
            'view' => 'atendimento.php',
            'title' => 'Atendimento online e presencial | Psicóloga Aline Politi — Jaboticabal',
            'description' => 'Atendimento psicológico em TCC com Aline Politi: presencial em Jaboticabal e online para todo o Brasil. Escolha o formato que cabe na sua vida.',
            'canonical' => '/atendimento',
        ],
        '/blog' => [
            'view' => 'blog.php',
            'title' => 'Blog | Aline Politi — Psicologia & TCC',
            'description' => 'Artigos sobre Terapia Cognitivo-Comportamental, saúde mental, ansiedade, depressão, orientação de pais e autoconhecimento.',
            'canonical' => '/blog',
        ],
        '/perguntas-frequentes' => [
            'view' => 'perguntas-frequentes.php',
            'title' => 'Perguntas Frequentes | Aline Politi — Psicóloga TCC',
            'description' => 'Respostas para as dúvidas mais comuns sobre psicoterapia, Terapia Cognitivo-Comportamental, atendimento online, valores e agendamento.',
            'canonical' => '/perguntas-frequentes',
        ],
        '/contato' => [
            'view' => 'contato.php',
            'title' => 'Contato | Aline Politi — Psicóloga TCC',
            'description' => 'Entre em contato com Aline Politi para agendar sua consulta de psicoterapia, orientação de pais ou supervisão clínica. WhatsApp, e-mail e Instagram.',
            'canonical' => '/contato',
        ],
    ];
}

function handle_contato(): void
{
    // Honeypot anti-spam (campo oculto "website" deve vir vazio)
    if (!empty($_POST['website'] ?? '')) {
        header('Location: ' . url('/contato') . '?enviado=1');
        return;
    }

    $nome = trim((string)($_POST['nome'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $msg = trim((string)($_POST['mensagem'] ?? ''));

    $errors = [];
    if ($nome === '') {
        $errors[] = 'Informe seu nome.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Informe um e-mail válido.';
    }
    if (mb_strlen($msg) < 5) {
        $errors[] = 'Escreva uma mensagem.';
    }

    if ($errors) {
        $_SESSION['flash'] = ['type' => 'erro', 'errors' => $errors];
        $_SESSION['old'] = compact('nome', 'email', 'msg');
        header('Location: ' . url('/contato') . '#form');
        return;
    }

    // Persiste no banco (se disponível)
    if ($pdo = db()) {
        try {
            $stmt = $pdo->prepare('INSERT INTO contatos (nome, email, mensagem, ip, criado_em) VALUES (?, ?, ?, ?, NOW())');
            $stmt->execute([$nome, $email, $msg, $_SERVER['REMOTE_ADDR'] ?? null]);
        } catch (Throwable $e) {
            error_log('[alinepoliti] contato insert: ' . $e->getMessage());
        }
    }

    // Envia e-mail (best effort)
    $body = "Nome: {$nome}\nE-mail: {$email}\n\n{$msg}\n";
    $headers = 'From: site@' . preg_replace('/^www\./', '', $_SERVER['HTTP_HOST'] ?? 'alinepoliti.com.br') . "\r\n"
        . 'Reply-To: ' . $email . "\r\n"
        . 'Content-Type: text/plain; charset=UTF-8';
    @mail(SITE_EMAIL, 'Contato pelo site — ' . $nome, $body, $headers);

    $_SESSION['flash'] = ['type' => 'ok'];
    header('Location: ' . url('/contato') . '?enviado=1#form');
}

function build_faq_jsonld(): string
{
    $main = array_map(fn($f) => [
        '@type' => 'Question',
        'name' => $f['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ], faq_items());

    return json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $main,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
}

function render_sitemap(): string
{
    $entries = [
        ['/', 'weekly', '1.0'],
        ['/a-psicologa', 'monthly', '0.9'],
        ['/a-psicologa/trajetoria', 'yearly', '0.6'],
        ['/a-psicologa/especializacoes', 'yearly', '0.6'],
        ['/a-psicologa/pesquisas', 'monthly', '0.5'],
        ['/a-psicologa/pesquisas/mestrado', 'yearly', '0.6'],
        ['/a-psicologa/pesquisas/graduacao', 'yearly', '0.5'],
        ['/a-psicologa/valores', 'yearly', '0.5'],
        ['/abordagem-tcc', 'monthly', '0.9'],
        ['/abordagem-tcc/o-que-e', 'yearly', '0.8'],
        ['/abordagem-tcc/terapias-contextuais', 'monthly', '0.8'],
        ['/atendimento/presencial', 'yearly', '0.8'],
        ['/atendimento/online', 'yearly', '0.8'],
        ['/abordagem-tcc/orientacao-de-pais', 'yearly', '0.8'],
        ['/abordagem-tcc/supervisao', 'yearly', '0.7'],
        ['/atendimento', 'monthly', '0.8'],
        ['/blog', 'weekly', '0.7'],
        ['/perguntas-frequentes', 'monthly', '0.7'],
        ['/contato', 'yearly', '0.8'],
    ];
    $urls = '';
    foreach ($entries as [$p, $freq, $pri]) {
        $urls .= "  <url>\n    <loc>" . e(abs_url($p)) . "</loc>\n"
            . "    <changefreq>{$freq}</changefreq>\n    <priority>{$pri}</priority>\n  </url>\n";
    }
    // Artigos do blog (dinâmico)
    foreach (blog_posts() as $post) {
        $lastmod = !empty($post['publicado_em']) ? date('Y-m-d', strtotime((string)$post['publicado_em'])) : '';
        $urls .= "  <url>\n    <loc>" . e(abs_url('/blog/' . $post['slug'])) . "</loc>\n"
            . ($lastmod ? "    <lastmod>{$lastmod}</lastmod>\n" : '')
            . "    <changefreq>yearly</changefreq>\n    <priority>0.6</priority>\n  </url>\n";
    }
    return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"
        . "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n{$urls}</urlset>\n";
}
