<?php
declare(strict_types=1);

/* ----------------------------------------------------------------------------
 * Helpers gerais
 * ------------------------------------------------------------------------- */

/** Escapa HTML. */
function e(?string $s): string
{
    return htmlspecialchars($s ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** URL interna respeitando BASE_URL. */
function url(string $path = '/'): string
{
    if ($path === '' ) {
        $path = '/';
    }
    return rtrim(BASE_URL, '/') . $path;
}

/** URL absoluta (para canonical/sitemap/OG). Usa SITE_ORIGIN se definido. */
function abs_url(string $path = '/'): string
{
    $origin = rtrim(SITE_ORIGIN, '/');
    return $origin !== '' ? $origin . $path : url($path);
}

/** Caminho de asset estático. */
function asset(string $file): string
{
    return url('/assets/' . ltrim($file, '/'));
}

/** Link do WhatsApp com mensagem pré-preenchida. */
function whatsapp_url(string $msg = SITE_WHATSAPP_MSG): string
{
    return 'https://wa.me/' . SITE_WHATSAPP_NUMBER . '?text=' . rawurlencode($msg);
}

/** Caminho atual normalizado (sem query, sem barra final exceto raiz). */
function current_path(): string
{
    $p = $GLOBALS['__path'] ?? '/';
    return $p;
}

/* ----------------------------------------------------------------------------
 * Navegação (espelha o nav-data do design)
 * ------------------------------------------------------------------------- */
function get_nav(): array
{
    return [
        ['label' => 'Início', 'to' => '/'],
        [
            'label' => 'A Psicóloga', 'to' => '/a-psicologa',
            'children' => [
                ['label' => 'Trajetória Acadêmica', 'to' => '/a-psicologa/trajetoria'],
                ['label' => 'Especializações',       'to' => '/a-psicologa/especializacoes'],
                ['label' => 'Pesquisas & Artigos',   'to' => '/a-psicologa/pesquisas'],
                ['label' => 'Missão & Valores',      'to' => '/a-psicologa/valores'],
            ],
        ],
        [
            'label' => 'Abordagem TCC', 'to' => '/abordagem-tcc',
            'children' => [
                ['label' => 'O que é a TCC?',            'to' => '/abordagem-tcc/o-que-e'],
                ['label' => 'Orientação de Pais',        'to' => '/abordagem-tcc/orientacao-de-pais'],
                ['label' => 'Supervisão para Psicólogos','to' => '/abordagem-tcc/supervisao'],
            ],
        ],
        [
            'label' => 'Atendimento', 'to' => '/atendimento',
            'children' => [
                ['label' => 'Atendimento Presencial', 'to' => '/atendimento/presencial'],
                ['label' => 'Atendimento Online',     'to' => '/atendimento/online'],
            ],
        ],
        ['label' => 'Blog', 'to' => '/blog'],
        ['label' => 'Perguntas Frequentes', 'to' => '/perguntas-frequentes'],
        ['label' => 'Contato', 'to' => '/contato'],
    ];
}

/* ----------------------------------------------------------------------------
 * Ícones SVG inline (substituem o lucide-react)
 * ------------------------------------------------------------------------- */
function icon(string $name, string $class = 'size-5'): string
{
    $paths = [
        'arrow-right'     => '<path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>',
        'heart-handshake' => '<path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.49 4.04 3 5.5l7 7Z"/>',
        'users'           => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        'graduation-cap'  => '<path d="M21.42 10.92a1 1 0 0 0-.02-1.84L12.83 5.18a2 2 0 0 0-1.66 0L2.6 9.08a1 1 0 0 0 0 1.83l8.57 3.91a2 2 0 0 0 1.66 0z"/><path d="M22 10v6"/><path d="M6 12.5V16a6 3 0 0 0 12 0v-3.5"/>',
        'sparkles'        => '<path d="M9.94 14.06 8.5 14.06l-6.14-1.58a.5.5 0 0 1 0-.96L8.5 9.94 9.94 3.8a.5.5 0 0 1 .96 0l1.58 6.14L18.62 12l-6.14 1.58z"/>',
        'brain'           => '<path d="M12 5a3 3 0 0 0-3 3 3 3 0 0 0-3 3 3 3 0 0 0 0 6 3 3 0 0 0 3 2 3 3 0 0 0 3-1"/><path d="M12 5a3 3 0 0 1 3 3 3 3 0 0 1 3 3 3 3 0 0 1 0 6 3 3 0 0 1-3 2 3 3 0 0 1-3-1"/><path d="M12 5v14"/>',
        'map-pin'         => '<path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/>',
        'monitor'         => '<rect width="20" height="14" x="2" y="3" rx="2"/><line x1="8" x2="16" y1="21" y2="21"/><line x1="12" x2="12" y1="17" y2="21"/>',
        'menu'            => '<line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="18" y2="18"/>',
        'x'               => '<path d="M18 6 6 18"/><path d="m6 6 12 12"/>',
        'chevron-down'    => '<path d="m6 9 6 6 6-6"/>',
        'instagram'       => '<rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>',
        'mail'            => '<rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>',
        'phone'           => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>',
        'message-circle'  => '<path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>',
    ];
    $body = $paths[$name] ?? '<circle cx="12" cy="12" r="9"/>';
    return '<svg xmlns="http://www.w3.org/2000/svg" class="' . e($class) . '" viewBox="0 0 24 24" '
        . 'fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" '
        . 'stroke-linejoin="round" aria-hidden="true">' . $body . '</svg>';
}

/* ----------------------------------------------------------------------------
 * Conteúdo dinâmico (DB com fallback)
 * ------------------------------------------------------------------------- */

/** FAQ — do banco se existir; senão, conteúdo padrão (espelha o design). */
function faq_items(): array
{
    $pdo = db();
    if ($pdo) {
        try {
            $rows = $pdo->query('SELECT pergunta, resposta FROM faq WHERE ativo = 1 ORDER BY ordem, id')->fetchAll();
            if ($rows) {
                return array_map(fn($r) => ['q' => $r['pergunta'], 'a' => $r['resposta']], $rows);
            }
        } catch (Throwable $e) {
            error_log('[alinepoliti] faq: ' . $e->getMessage());
        }
    }
    return faq_default();
}

function faq_default(): array
{
    return [
        ['q' => 'O que é a Terapia Cognitivo-Comportamental?', 'a' => 'A TCC é uma abordagem psicológica estruturada e baseada em evidências, que entende que pensamentos, emoções e comportamentos estão interligados. O trabalho clínico foca em compreender e ressignificar padrões que geram sofrimento.'],
        ['q' => 'Como funciona o atendimento online?', 'a' => 'As sessões acontecem por videochamada em plataforma segura, com mesmo sigilo e qualidade do atendimento presencial — conforme a Resolução CFP 11/2018.'],
        ['q' => 'Qual a duração de cada sessão?', 'a' => 'As sessões duram em média 50 minutos e costumam ter periodicidade semanal, definida em conjunto após a entrevista inicial.'],
        ['q' => 'Quanto tempo dura o processo terapêutico?', 'a' => 'A TCC é considerada uma terapia de médio prazo. A duração depende da demanda, dos objetivos terapêuticos e do engajamento — sendo sempre revisada periodicamente.'],
        ['q' => 'Você atende crianças?', 'a' => 'Sim. O atendimento clínico individual é para crianças a partir de 10 anos, adolescentes, adultos e casais. Para crianças menores de 10 anos, ofereço o serviço de Orientação de Pais.'],
        ['q' => 'Como faço para agendar a primeira consulta?', 'a' => 'O primeiro contato pode ser feito pelo WhatsApp ou e-mail. Após uma breve conversa, agendamos a sessão inicial de acolhimento.'],
        ['q' => 'Você atende Unimed ou algum outro convênio?', 'a' => 'Com toda a transparência: no momento não atendo por convênios — incluindo a Unimed. Sei que isso pode pesar na sua decisão, e por isso a primeira sugestão é entrar em contato com o seu plano de saúde para conhecer os profissionais credenciados disponíveis.'],
        ['q' => 'Você emite recibo para reembolso?', 'a' => 'Sim. Emito recibo padrão que pode ser apresentado a planos de saúde e usado para Imposto de Renda.'],
    ];
}

/** Artigos-semente (fonte da verdade quando o banco está vazio/indisponível). */
function seed_artigos(): array
{
    static $a = null;
    if ($a === null) {
        $a = require __DIR__ . '/seed_artigos.php';
    }
    return $a;
}

/** Posts do blog — do banco (se houver) ou dos artigos-semente. */
function blog_posts(): array
{
    $pdo = db();
    if ($pdo) {
        try {
            $rows = $pdo->query(
                'SELECT slug, titulo, resumo, publicado_em FROM posts WHERE ativo = 1 ORDER BY publicado_em DESC'
            )->fetchAll();
            if ($rows) {
                return $rows;
            }
        } catch (Throwable $e) {
            error_log('[alinepoliti] blog: ' . $e->getMessage());
        }
    }
    $seed = seed_artigos();
    usort($seed, fn($x, $y) => strcmp((string)$y['publicado_em'], (string)$x['publicado_em']));
    return $seed;
}

/** Localiza um post pelo slug (banco ou semente). */
function find_post(string $slug): ?array
{
    $pdo = db();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare('SELECT slug, titulo, resumo, conteudo, publicado_em FROM posts WHERE slug = ? AND ativo = 1 LIMIT 1');
            $stmt->execute([$slug]);
            $row = $stmt->fetch();
            if ($row) {
                return $row;
            }
        } catch (Throwable $e) {
            error_log('[alinepoliti] find_post: ' . $e->getMessage());
        }
    }
    foreach (seed_artigos() as $a) {
        if ($a['slug'] === $slug) {
            return $a;
        }
    }
    return null;
}

/** Gera slug a partir de um título. */
function slugify(string $text): string
{
    $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text) ?: $text;
    $text = strtolower(trim($text));
    $text = preg_replace('/[^a-z0-9]+/', '-', $text) ?? '';
    return trim($text, '-');
}

/* ---- CSRF ---- */
function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf" value="' . e(csrf_token()) . '">';
}

function csrf_check(): bool
{
    return isset($_POST['csrf'], $_SESSION['csrf']) && hash_equals($_SESSION['csrf'], (string)$_POST['csrf']);
}
