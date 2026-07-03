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
    $porSlug = [];
    // Seed (base) — sempre disponível
    foreach (seed_artigos() as $a) {
        $porSlug[$a['slug']] = $a;
    }
    // Banco — sobrepõe/adiciona (resiliente: criar 1 post no painel não some com os do seed)
    $pdo = db();
    if ($pdo) {
        try {
            $rows = $pdo->query(
                'SELECT slug, titulo, resumo, capa, tags, publicado_em FROM posts WHERE ativo = 1'
            )->fetchAll();
            foreach ($rows as $r) {
                $porSlug[$r['slug']] = array_merge($porSlug[$r['slug']] ?? [], $r);
            }
        } catch (Throwable $e) {
            error_log('[alinepoliti] blog: ' . $e->getMessage());
        }
    }
    $lista = array_values($porSlug);
    usort($lista, fn($x, $y) => strcmp((string)($y['publicado_em'] ?? ''), (string)($x['publicado_em'] ?? '')));
    return $lista;
}

/** Localiza um post pelo slug (banco ou semente). */
function find_post(string $slug): ?array
{
    $pdo = db();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare('SELECT * FROM posts WHERE slug = ? AND ativo = 1 LIMIT 1');
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

/* ---------------------------------------------------------------------------
 * Palavras-chave (universo semântico) — usadas no pré-rodapé.
 * Fonte: tabela palavras_chave; se não houver MySQL, cai no fallback PHP.
 * ------------------------------------------------------------------------- */

/** Fallback (sem MySQL) das expressões usadas no pré-rodapé. */
function keywords_fallback(): array
{
    return [
        'Local — Psicóloga TCC + cidade' => [
            'Psicóloga TCC em Jaboticabal', 'Psicóloga TCC próxima de Monte Alto', 'Psicóloga TCC próxima de Guariba',
            'Psicóloga TCC próxima de Taquaritinga', 'Psicóloga TCC próxima de Bebedouro', 'Psicóloga TCC próxima de Araraquara',
            'Psicóloga TCC próxima de Ribeirão Preto', 'Psicóloga TCC próxima de Sertãozinho',
        ],
        'Local — genérico' => [
            'Psicóloga em Jaboticabal', 'Psicóloga clínica em Jaboticabal', 'Psicóloga particular em Jaboticabal',
            'Psicóloga em Monte Alto', 'Psicóloga em Guariba', 'Psicóloga em Taquaritinga',
        ],
        'Local — terapia + tema' => [
            'Terapia cognitivo-comportamental em Jaboticabal', 'Terapia TCC em Jaboticabal', 'Psicoterapia em Jaboticabal',
            'Terapia para ansiedade em Jaboticabal', 'Terapia de casal em Jaboticabal',
        ],
        'Online' => [
            'Terapia online', 'Psicóloga online particular', 'Psicóloga TCC online', 'Terapia cognitivo-comportamental online',
            'Psicoterapia online', 'Terapia online para ansiedade', 'Consulta psicológica online', 'Psicóloga por videochamada',
        ],
        'Orientação de pais' => [
            'Orientação de pais', 'Orientação parental online', 'Orientação de pais para TDAH', 'Orientação de pais para limites',
            'Orientação de pais com base na TCC', 'Educação parental positiva', 'Manejo de comportamento infantil',
        ],
        'Supervisão / mentoria' => [
            'Supervisão clínica', 'Supervisão clínica online', 'Supervisão para psicólogos', 'Supervisão em TCC para psicólogos',
            'Supervisão em DBT para psicólogos', 'Mentoria para psicólogos TCC', 'Supervisão para psicólogos iniciantes',
        ],
        'Informacional / GEO' => [
            'O que é a TCC?', 'Como funciona a terapia cognitivo-comportamental?', 'A TCC funciona para ansiedade?',
            'O que é DBT?', 'Terapia online é eficaz?', 'Como saber se preciso de terapia?', 'O que é orientação de pais?',
        ],
    ];
}

/** Expressões de um ou mais grupos (MySQL → fallback PHP). */
function keywords_do_grupo(array $grupos): array
{
    $pdo = db();
    if ($pdo) {
        try {
            $in = implode(',', array_fill(0, count($grupos), '?'));
            $stmt = $pdo->prepare("SELECT expressao FROM palavras_chave WHERE ativo = 1 AND grupo IN ($in)");
            $stmt->execute($grupos);
            $rows = $stmt->fetchAll(PDO::FETCH_COLUMN);
            if ($rows) {
                return $rows;
            }
        } catch (Throwable $e) {
            error_log('[alinepoliti] keywords: ' . $e->getMessage());
        }
    }
    $fb = keywords_fallback();
    $out = [];
    foreach ($grupos as $g) {
        if (!empty($fb[$g])) {
            $out = array_merge($out, $fb[$g]);
        }
    }
    return $out;
}

/** Uma expressão aleatória (sorteada a cada carregamento) dentre os grupos dados. */
function keyword_aleatoria(array $grupos): ?string
{
    $pool = keywords_do_grupo($grupos);
    return $pool ? $pool[array_rand($pool)] : null;
}

/* ---------------------------------------------------------------------------
 * Formulários de contato — assuntos + envio de e-mail (Resend → fallback mail).
 * ------------------------------------------------------------------------- */

/** Opções do campo "Assunto" (form geral /contato). */
function assuntos_contato(): array
{
    return ['Consulta presencial', 'Consulta online', 'Supervisão', 'Orientação de pais', 'Outro assunto'];
}

/**
 * Envia e-mail. Ordem de preferência:
 *   1) SMTP autenticado (caixa do próprio domínio)  2) Resend (API)  3) mail() nativo.
 * Retorna true em caso de sucesso (best-effort).
 */
function enviar_email(string $assunto, string $texto, string $replyTo = '', bool $html = false): bool
{
    $para = SITE_EMAIL;

    // 1) SMTP autenticado (e-mail do domínio) — preferido
    if (SMTP_HOST !== '' && SMTP_USER !== '') {
        if (smtp_enviar($para, $assunto, $texto, $replyTo, $html)) {
            return true;
        }
    }

    // 2) Resend (API), se configurado
    if (RESEND_API_KEY !== '' && function_exists('curl_init')) {
        $campos = array_filter([
            'from'     => RESEND_FROM,
            'to'       => [$para],
            'reply_to' => $replyTo !== '' ? $replyTo : null,
            'subject'  => $assunto,
        ], static fn($v) => $v !== null);
        $campos[$html ? 'html' : 'text'] = $texto;
        $payload = json_encode($campos, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        try {
            $ch = curl_init('https://api.resend.com/emails');
            curl_setopt_array($ch, [
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => $payload,
                CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . RESEND_API_KEY, 'Content-Type: application/json'],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT        => 8,
            ]);
            $resp = curl_exec($ch);
            $code = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($code >= 200 && $code < 300) {
                return true;
            }
            error_log('[alinepoliti] resend HTTP ' . $code . ': ' . (string)$resp);
        } catch (Throwable $e) {
            error_log('[alinepoliti] resend erro: ' . $e->getMessage());
        }
    }

    // 3) Fallback: mail() nativo (pode não entregar sem MTA configurado).
    $headers = 'From: ' . (MAIL_FROM !== '' ? MAIL_FROM : RESEND_FROM) . "\r\n"
        . 'Reply-To: ' . ($replyTo !== '' ? $replyTo : $para) . "\r\n"
        . 'MIME-Version: 1.0' . "\r\n"
        . 'Content-Type: ' . ($html ? 'text/html' : 'text/plain') . '; charset=UTF-8';
    return @mail($para, $assunto, $texto, $headers);
}

/**
 * Cliente SMTP mínimo (AUTH LOGIN) — envia e-mail de texto simples autenticando
 * numa caixa do próprio domínio. Suporta STARTTLS (587) e SSL implícito (465).
 */
function smtp_enviar(string $to, string $assunto, string $texto, string $replyTo = '', bool $html = false): bool
{
    $fromEmail = MAIL_FROM !== '' ? MAIL_FROM : SMTP_USER;
    $fromName  = MAIL_FROM_NAME;
    $errno = 0; $errstr = '';

    $endpoint = (SMTP_SECURE === 'ssl' ? 'ssl://' : '') . SMTP_HOST . ':' . SMTP_PORT;
    $ctx = stream_context_create(['ssl' => ['verify_peer' => true, 'verify_peer_name' => true, 'SNI_enabled' => true]]);
    $fp = @stream_socket_client($endpoint, $errno, $errstr, 15, STREAM_CLIENT_CONNECT, $ctx);
    if (!$fp) {
        error_log("[alinepoliti] smtp connect falhou: {$errstr} ({$errno})");
        return false;
    }
    stream_set_timeout($fp, 15);

    $read = static function () use ($fp): string {
        $data = '';
        while (($line = fgets($fp, 515)) !== false) {
            $data .= $line;
            if (strlen($line) < 4 || $line[3] === ' ') { break; }
        }
        return $data;
    };
    $send = static function (string $c) use ($fp): void { fwrite($fp, $c . "\r\n"); };
    $is   = static fn(string $r, string $code): bool => strncmp($r, $code, 3) === 0;
    $fail = static function (string $ctx, string $r) use ($fp): bool {
        error_log('[alinepoliti] smtp ' . $ctx . ': ' . trim($r));
        @fwrite($fp, "QUIT\r\n"); @fclose($fp);
        return false;
    };

    if (!$is($read(), '220')) { return $fail('greet', ''); }
    $ehlo = preg_replace('/[^a-z0-9.\-]/i', '', $_SERVER['HTTP_HOST'] ?? 'localhost') ?: 'localhost';

    $send("EHLO {$ehlo}"); $read();
    if (SMTP_SECURE === 'tls') {
        $send('STARTTLS'); $r = $read();
        if (!$is($r, '220')) { return $fail('starttls', $r); }
        $crypto = STREAM_CRYPTO_METHOD_TLS_CLIENT;
        if (defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')) { $crypto |= STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT; }
        if (defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT')) { $crypto |= STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT; }
        if (!@stream_socket_enable_crypto($fp, true, $crypto)) { return $fail('tls-handshake', ''); }
        $send("EHLO {$ehlo}"); $read();
    }

    $send('AUTH LOGIN'); $r = $read();
    if (!$is($r, '334')) { return $fail('auth', $r); }
    $send(base64_encode(SMTP_USER)); $r = $read();
    if (!$is($r, '334')) { return $fail('auth-user', $r); }
    $send(base64_encode(SMTP_PASS)); $r = $read();
    if (!$is($r, '235')) { return $fail('auth-pass', $r); }

    $send("MAIL FROM:<{$fromEmail}>"); $r = $read();
    if (!$is($r, '250')) { return $fail('mail-from', $r); }
    $send("RCPT TO:<{$to}>"); $r = $read();
    if (!$is($r, '250') && !$is($r, '251')) { return $fail('rcpt-to', $r); }
    $send('DATA'); $r = $read();
    if (!$is($r, '354')) { return $fail('data', $r); }

    $fromHeader = $fromName !== '' ? mb_encode_mimeheader($fromName, 'UTF-8') . " <{$fromEmail}>" : $fromEmail;
    $headers = [
        'Date: ' . date('r'),
        'From: ' . $fromHeader,
        'To: <' . $to . '>',
        'Subject: ' . mb_encode_mimeheader($assunto, 'UTF-8'),
        'MIME-Version: 1.0',
        'Content-Type: ' . ($html ? 'text/html' : 'text/plain') . '; charset=UTF-8',
        'Content-Transfer-Encoding: base64',
    ];
    if ($replyTo !== '') {
        array_splice($headers, 3, 0, ['Reply-To: <' . $replyTo . '>']);
    }
    // base64 (preserva acentos/UTF-8; sem risco de dot-stuffing). chunk_split já quebra em CRLF.
    $body = chunk_split(base64_encode($texto));
    $send(implode("\r\n", $headers) . "\r\n\r\n" . $body . '.'); $r = $read();
    $ok = $is($r, '250');

    $send('QUIT'); @fclose($fp);
    if (!$ok) { error_log('[alinepoliti] smtp data-final: ' . trim($r)); }
    return $ok;
}

/* ---------------------------------------------------------------------------
 * Motor de blog (SEO/GEO): tags automáticas, imagem WebP, interlinking,
 * relacionados, checklist de SEO e FAQ.
 * ------------------------------------------------------------------------- */

/** Todas as expressões da tabela palavras_chave (DB → fallback), em cache. */
function todas_keywords(): array
{
    static $cache = null;
    if ($cache !== null) { return $cache; }
    $pdo = db();
    if ($pdo) {
        try {
            $r = $pdo->query('SELECT expressao FROM palavras_chave WHERE ativo = 1')->fetchAll(PDO::FETCH_COLUMN);
            if ($r) { return $cache = $r; }
        } catch (Throwable $e) { /* fallback */ }
    }
    $flat = [];
    foreach (keywords_fallback() as $g) { $flat = array_merge($flat, $g); }
    return $cache = $flat;
}

/** Stopwords PT (para extração de tags por frequência). */
function stopwords_pt(): array
{
    return array_flip(['a','o','e','de','da','do','das','dos','em','no','na','nos','nas','um','uma','uns','umas',
        'para','por','com','sem','que','se','ao','aos','à','às','como','mais','mas','ou','os','as','sua','seu','suas','seus',
        'ser','está','estão','é','são','foi','ele','ela','eles','elas','isso','este','esta','esse','essa','entre','sobre',
        'quando','onde','também','já','não','sim','the','and','of','to','in','pela','pelo','pelas','pelos','você','vocês',
        'nossa','nosso','minha','meu','muito','muitos','muita','muitas','pode','podem','ter','tem','têm','dela','dele','seus']);
}

/** Extrai até $limite tags: casa com o banco de palavras-chave + termos frequentes. */
function blog_extrair_tags(string $titulo, string $conteudo, int $limite = 10): array
{
    $texto = mb_strtolower(strip_tags($titulo . ' ' . $conteudo), 'UTF-8');
    $out = []; $seen = [];
    $add = static function (string $tag) use (&$out, &$seen, $limite): void {
        $k = mb_strtolower(trim($tag), 'UTF-8');
        if ($k === '' || isset($seen[$k]) || count($out) >= $limite) { return; }
        $seen[$k] = true; $out[] = trim($tag);
    };
    foreach (todas_keywords() as $kw) {
        $k = mb_strtolower($kw, 'UTF-8');
        if (mb_strlen($k) > 45 || str_contains($k, '?')) { continue; }
        if (mb_stripos($texto, $k) !== false) { $add($kw); }
    }
    if (count($out) < $limite) {
        $stop = stopwords_pt();
        $palavras = preg_split('/[^\p{L}\-]+/u', $texto, -1, PREG_SPLIT_NO_EMPTY) ?: [];
        $freq = [];
        foreach ($palavras as $p) {
            if (mb_strlen($p) < 4 || isset($stop[$p])) { continue; }
            $freq[$p] = ($freq[$p] ?? 0) + 1;
        }
        arsort($freq);
        foreach (array_keys($freq) as $p) { $add(mb_convert_case($p, MB_CASE_TITLE, 'UTF-8')); }
    }
    return $out;
}

/**
 * Converte imagem enviada em WebP 900x1501 (cover), salva em public/assets/blog/
 * com nome sequencial psicologa-aline-politi-NNNN.webp. Retorna o nome ou null.
 */
function blog_gerar_webp(array $file, int $tw = 900, int $th = 1501): ?string
{
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) { return null; }
    if (!function_exists('imagewebp')) { error_log('[alinepoliti] webp: GD sem suporte a WebP'); return null; }
    $data = @file_get_contents($file['tmp_name']);
    if ($data === false) { return null; }
    $src = @imagecreatefromstring($data);
    if (!$src) { error_log('[alinepoliti] webp: arquivo não é imagem válida'); return null; }

    $w = imagesx($src); $h = imagesy($src);
    $ar = $tw / $th;
    if ($w / $h > $ar) { $sh = $h; $sw = (int)round($h * $ar); }
    else               { $sw = $w; $sh = (int)round($w / $ar); }
    $sx = (int)(($w - $sw) / 2); $sy = (int)(($h - $sh) / 2);
    $dst = imagecreatetruecolor($tw, $th);
    imagecopyresampled($dst, $src, 0, 0, $sx, $sy, $tw, $th, $sw, $sh);

    $dir = dirname(__DIR__) . '/public/assets/blog';
    if (!is_dir($dir)) { @mkdir($dir, 0775, true); }
    $n = 0;
    foreach (glob($dir . '/psicologa-aline-politi-*.webp') ?: [] as $f) {
        if (preg_match('/-(\d+)\.webp$/', $f, $mm)) { $n = max($n, (int)$mm[1]); }
    }
    $nome = sprintf('psicologa-aline-politi-%04d.webp', $n + 1);
    $ok = imagewebp($dst, $dir . '/' . $nome, 82);
    imagedestroy($src); imagedestroy($dst);
    return $ok ? $nome : null;
}

/** Insere links internos automáticos (1ª ocorrência de cada termo) no HTML do artigo. */
function blog_interlink(string $html): string
{
    $mapa = [
        'terapia cognitivo-comportamental' => '/abordagem-tcc/o-que-e',
        'terapias contextuais'             => '/abordagem-tcc/terapias-contextuais',
        'orientação de pais'               => '/abordagem-tcc/orientacao-de-pais',
        'supervisão'                       => '/abordagem-tcc/supervisao',
        'terapia online'                   => '/atendimento/online',
        'atendimento presencial'           => '/atendimento/presencial',
    ];
    foreach ($mapa as $frase => $path) {
        $rep = '<a href="' . url($path) . '" class="text-teal-dark font-semibold hover:text-magenta">$0</a>';
        $novo = @preg_replace('/' . preg_quote($frase, '/') . '(?![^<]*>)(?![^<]*<\/a>)/iu', $rep, $html, 1);
        if ($novo !== null) { $html = $novo; }
    }
    return $html;
}

/** Artigos relacionados (por tags em comum; cai em recentes se não houver). */
function blog_relacionados(array $post, int $n = 3): array
{
    $meu = array_map(static fn($t) => mb_strtolower(trim($t), 'UTF-8'),
        array_filter(explode(',', (string)($post['tags'] ?? ''))));
    $scored = [];
    foreach (blog_posts() as $p) {
        if (($p['slug'] ?? '') === ($post['slug'] ?? '')) { continue; }
        $pt = array_map(static fn($t) => mb_strtolower(trim($t), 'UTF-8'),
            array_filter(explode(',', (string)($p['tags'] ?? ''))));
        $scored[] = ['p' => $p, 's' => count(array_intersect($meu, $pt))];
    }
    usort($scored, static fn($a, $b) => $b['s'] <=> $a['s']);
    return array_map(static fn($x) => $x['p'], array_slice($scored, 0, $n));
}

/** FAQ do post (JSON → array de ['q'=>..,'a'=>..]). */
function blog_faq(array $post): array
{
    $raw = (string)($post['faq'] ?? '');
    if ($raw === '') { return []; }
    $d = json_decode($raw, true);
    if (!is_array($d)) { return []; }
    return array_values(array_filter($d, static fn($x) =>
        is_array($x) && trim((string)($x['q'] ?? '')) !== '' && trim((string)($x['a'] ?? '')) !== ''));
}

/** Checklist de SEO do artigo → ['checks'=>[[label,ok]], 'ok','total','pct']. */
function blog_seo_score(array $post): array
{
    $titulo = (string)($post['titulo'] ?? '');
    $metaT  = ((string)($post['meta_titulo'] ?? '')) ?: $titulo;
    $metaD  = ((string)($post['meta_descricao'] ?? '')) ?: (string)($post['resumo'] ?? '');
    $kw     = mb_strtolower(trim((string)($post['keyword_foco'] ?? '')), 'UTF-8');
    $texto  = strip_tags((string)($post['conteudo'] ?? ''));
    $nPal   = count(preg_split('/\s+/u', trim($texto)) ?: []);
    $inicio = mb_strtolower(mb_substr($texto, 0, 300), 'UTF-8');

    $checks = [
        ['Título até 60 caracteres',        mb_strlen($metaT) > 0 && mb_strlen($metaT) <= 60],
        ['Meta descrição (120–160)',        mb_strlen($metaD) >= 120 && mb_strlen($metaD) <= 160],
        ['Palavra-chave foco definida',     $kw !== ''],
        ['Keyword no título',               $kw !== '' && mb_stripos($metaT, $kw) !== false],
        ['Keyword no início do texto',      $kw !== '' && mb_stripos($inicio, $kw) !== false],
        ['Conteúdo com 300+ palavras',      $nPal >= 300],
        ['Imagem de capa',                  !empty($post['capa'])],
        ['Tags definidas',                  trim((string)($post['tags'] ?? '')) !== ''],
        ['Tem FAQ (bom para IA)',           blog_faq($post) !== []],
        ['Tem resumo rápido (TL;DR)',       trim((string)($post['tldr'] ?? '')) !== ''],
    ];
    $ok = count(array_filter($checks, static fn($c) => $c[1]));
    return ['checks' => $checks, 'ok' => $ok, 'total' => count($checks), 'pct' => (int)round($ok / count($checks) * 100)];
}

/**
 * Recorta a seção de referências/fontes do fim do HTML.
 * Retorna [conteudo_sem_referencias, array_de_fontes].
 */
function blog_extrair_referencias(string $html): array
{
    $fontes = [];
    $re = '/<h2>\s*(?:refer[êe]ncias|fontes(?:\s*&amp;\s*refer[êe]ncias)?)\s*<\/h2>\s*<ul>(.*?)<\/ul>\s*$/isu';
    if (preg_match($re, $html, $m)) {
        if (preg_match_all('/<li>(.*?)<\/li>/isu', $m[1], $lis)) {
            foreach ($lis[1] as $li) {
                $t = trim(preg_replace('/\s+/u', ' ', strip_tags($li)));
                if ($t !== '') { $fontes[] = $t; }
            }
        }
        $html = preg_replace($re, '', $html);
    }
    return [trim((string)$html), $fontes];
}
