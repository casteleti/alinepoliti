<?php
declare(strict_types=1);

/* ============================================================================
 * Área restrita — gestão de artigos do blog + mensagens de contato.
 * Requer MySQL (tabelas usuarios, posts, contatos do schema.sql).
 * ========================================================================= */

function admin_dispatch(string $path, string $method): void
{
    if ($path === '/admin/login') {
        $method === 'POST' ? admin_do_login() : admin_view_login();
        return;
    }
    if ($path === '/admin/logout') {
        $_SESSION = [];
        session_destroy();
        admin_redirect('/admin/login');
    }

    if (!admin_logged_in()) {
        admin_redirect('/admin/login');
    }

    switch (true) {
        case $path === '/admin':
            admin_dashboard();
            break;
        case $path === '/admin/posts/novo':
            admin_post_form(null);
            break;
        case $path === '/admin/posts/editar':
            admin_post_form(isset($_GET['id']) ? (int)$_GET['id'] : null);
            break;
        case $path === '/admin/posts/salvar' && $method === 'POST':
            admin_post_save();
            break;
        case $path === '/admin/posts/excluir' && $method === 'POST':
            admin_post_delete();
            break;
        default:
            http_response_code(404);
            admin_chrome('Não encontrado', '<p class="text-ink/70">Página do painel não encontrada.</p>');
    }
}

/* ---- Infra ---- */
function admin_logged_in(): bool
{
    return !empty($_SESSION['admin_id']);
}

function admin_redirect(string $path): never
{
    header('Location: ' . url($path));
    exit;
}

function admin_db(): PDO
{
    $pdo = db();
    if (!$pdo) {
        admin_chrome('Banco indisponível',
            '<div class="rounded-2xl bg-white border border-teal-dark/10 p-8">'
            . '<h2 class="font-heading text-xl text-teal-dark mb-2">Banco de dados não configurado</h2>'
            . '<p class="text-ink/70">A área restrita precisa do MySQL. Importe <code>schema.sql</code> e ajuste <code>app/config.php</code>.</p></div>');
        exit;
    }
    return $pdo;
}

/* ---- Autenticação ---- */
function admin_view_login(string $erro = ''): void
{
    $erro = $erro ?: ($_SESSION['login_erro'] ?? '');
    unset($_SESSION['login_erro']);
    ob_start(); ?>
    <div class="max-w-sm mx-auto mt-16 lg:mt-24">
      <div class="text-center mb-8">
        <img src="<?= asset('logo.svg') ?>" alt="Aline Politi" class="h-10 mx-auto mb-4">
        <h1 class="font-heading text-2xl text-teal-dark">Área restrita</h1>
      </div>
      <form method="post" action="<?= url('/admin/login') ?>" class="bg-white rounded-2xl border border-teal-dark/10 p-7 grid gap-4 shadow-sm">
        <?= csrf_field() ?>
        <?php if ($erro): ?><p class="rounded-lg bg-magenta/10 text-magenta text-sm px-3 py-2"><?= e($erro) ?></p><?php endif; ?>
        <label class="grid gap-1.5">
          <span class="text-xs font-bold uppercase tracking-[0.18em] text-ink/60">E-mail</span>
          <input type="email" name="email" required class="rounded-lg border border-teal-dark/15 px-3 py-2.5 focus:outline-none focus:border-teal-mid">
        </label>
        <label class="grid gap-1.5">
          <span class="text-xs font-bold uppercase tracking-[0.18em] text-ink/60">Senha</span>
          <input type="password" name="senha" required class="rounded-lg border border-teal-dark/15 px-3 py-2.5 focus:outline-none focus:border-teal-mid">
        </label>
        <button class="mt-2 py-3 rounded-full bg-teal-dark text-cream font-semibold hover:bg-teal-mid transition-colors">Entrar</button>
      </form>
      <p class="text-center mt-6"><a href="<?= url('/') ?>" class="text-sm text-ink/50 hover:text-magenta">← voltar ao site</a></p>
    </div>
    <?php
    admin_chrome('Entrar', ob_get_clean(), false);
}

function admin_do_login(): void
{
    if (!csrf_check()) {
        $_SESSION['login_erro'] = 'Sessão expirada. Tente novamente.';
        admin_redirect('/admin/login');
    }
    $email = trim((string)($_POST['email'] ?? ''));
    $senha = (string)($_POST['senha'] ?? '');
    $pdo = admin_db();
    $stmt = $pdo->prepare('SELECT id, nome, senha_hash FROM usuarios WHERE email = ? LIMIT 1');
    $stmt->execute([$email]);
    $u = $stmt->fetch();
    if ($u && password_verify($senha, $u['senha_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = (int)$u['id'];
        $_SESSION['admin_nome'] = $u['nome'];
        admin_redirect('/admin');
    }
    $_SESSION['login_erro'] = 'E-mail ou senha incorretos.';
    admin_redirect('/admin/login');
}

/* ---- Dashboard ---- */
function admin_dashboard(): void
{
    $pdo = admin_db();
    $posts = $pdo->query('SELECT id, titulo, slug, publicado_em, ativo FROM posts ORDER BY publicado_em DESC')->fetchAll();
    $contatos = $pdo->query('SELECT nome, email, mensagem, criado_em FROM contatos ORDER BY criado_em DESC LIMIT 10')->fetchAll();
    $flash = $_SESSION['admin_flash'] ?? '';
    unset($_SESSION['admin_flash']);

    ob_start(); ?>
    <?php if ($flash): ?><p class="rounded-lg bg-teal-mid/15 text-teal-dark text-sm px-4 py-3 mb-6"><?= e($flash) ?></p><?php endif; ?>

    <div class="flex items-center justify-between mb-6">
      <h1 class="font-heading text-2xl text-teal-dark">Artigos do blog</h1>
      <a href="<?= url('/admin/posts/novo') ?>" class="px-4 py-2.5 rounded-full bg-teal-dark text-cream text-sm font-semibold hover:bg-teal-mid transition-colors">+ Novo artigo</a>
    </div>

    <div class="bg-white rounded-2xl border border-teal-dark/10 overflow-hidden mb-12">
      <table class="w-full text-sm">
        <thead class="bg-cream text-ink/60 text-xs uppercase tracking-wider">
          <tr><th class="text-left px-5 py-3">Título</th><th class="text-left px-5 py-3">Publicação</th><th class="px-5 py-3">Status</th><th class="px-5 py-3"></th></tr>
        </thead>
        <tbody>
        <?php if (!$posts): ?>
          <tr><td colspan="4" class="px-5 py-6 text-ink/60">Nenhum artigo no banco ainda. Os 6 artigos de fábrica aparecem no site a partir do seed. Importe-os com <code>bin/seed.php</code> ou crie um novo.</td></tr>
        <?php else: foreach ($posts as $p): ?>
          <tr class="border-t border-teal-dark/5">
            <td class="px-5 py-3 font-medium text-teal-dark"><?= e($p['titulo']) ?></td>
            <td class="px-5 py-3 text-ink/70"><?= $p['publicado_em'] ? e(date('d/m/Y', strtotime((string)$p['publicado_em']))) : '—' ?></td>
            <td class="px-5 py-3 text-center"><?= $p['ativo'] ? '<span class="text-teal-mid">● ativo</span>' : '<span class="text-ink/40">○ rascunho</span>' ?></td>
            <td class="px-5 py-3 text-right whitespace-nowrap">
              <a href="<?= url('/admin/posts/editar?id=' . (int)$p['id']) ?>" class="text-teal-dark hover:text-magenta font-semibold">Editar</a>
              <form method="post" action="<?= url('/admin/posts/excluir') ?>" class="inline" onsubmit="return confirm('Excluir este artigo?')">
                <?= csrf_field() ?><input type="hidden" name="id" value="<?= (int)$p['id'] ?>">
                <button class="ml-3 text-magenta/80 hover:text-magenta">Excluir</button>
              </form>
            </td>
          </tr>
        <?php endforeach; endif; ?>
        </tbody>
      </table>
    </div>

    <h2 class="font-heading text-xl text-teal-dark mb-4">Últimas mensagens de contato</h2>
    <div class="bg-white rounded-2xl border border-teal-dark/10 divide-y divide-teal-dark/5">
      <?php if (!$contatos): ?>
        <p class="px-5 py-6 text-ink/60 text-sm">Nenhuma mensagem recebida ainda.</p>
      <?php else: foreach ($contatos as $c): ?>
        <div class="px-5 py-4">
          <div class="flex justify-between text-sm"><span class="font-semibold text-teal-dark"><?= e($c['nome']) ?></span><span class="text-ink/50"><?= e(date('d/m/Y H:i', strtotime((string)$c['criado_em']))) ?></span></div>
          <p class="text-xs text-ink/50"><?= e($c['email']) ?></p>
          <p class="text-sm text-ink/75 mt-1"><?= nl2br(e($c['mensagem'])) ?></p>
        </div>
      <?php endforeach; endif; ?>
    </div>
    <?php
    admin_chrome('Painel', ob_get_clean());
}

/* ---- Formulário de artigo ---- */
function admin_post_form(?int $id): void
{
    $pdo = admin_db();
    $post = ['id' => 0, 'titulo' => '', 'slug' => '', 'resumo' => '', 'conteudo' => '', 'publicado_em' => date('Y-m-d\TH:i'), 'ativo' => 1];
    if ($id) {
        $stmt = $pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (!$row) { admin_redirect('/admin'); }
        $post = $row;
        $post['publicado_em'] = $post['publicado_em'] ? date('Y-m-d\TH:i', strtotime((string)$post['publicado_em'])) : '';
    }
    ob_start(); ?>
    <div class="flex items-center justify-between mb-6">
      <h1 class="font-heading text-2xl text-teal-dark"><?= $id ? 'Editar artigo' : 'Novo artigo' ?></h1>
      <a href="<?= url('/admin') ?>" class="text-sm text-ink/60 hover:text-magenta">← voltar</a>
    </div>
    <form method="post" action="<?= url('/admin/posts/salvar') ?>" class="bg-white rounded-2xl border border-teal-dark/10 p-7 grid gap-5">
      <?= csrf_field() ?>
      <input type="hidden" name="id" value="<?= (int)$post['id'] ?>">
      <label class="grid gap-1.5">
        <span class="text-xs font-bold uppercase tracking-[0.18em] text-ink/60">Título</span>
        <input type="text" name="titulo" required value="<?= e($post['titulo']) ?>" class="rounded-lg border border-teal-dark/15 px-3 py-2.5 focus:outline-none focus:border-teal-mid">
      </label>
      <label class="grid gap-1.5">
        <span class="text-xs font-bold uppercase tracking-[0.18em] text-ink/60">Slug <span class="font-normal lowercase tracking-normal">(deixe vazio para gerar do título)</span></span>
        <input type="text" name="slug" value="<?= e($post['slug']) ?>" class="rounded-lg border border-teal-dark/15 px-3 py-2.5 focus:outline-none focus:border-teal-mid">
      </label>
      <label class="grid gap-1.5">
        <span class="text-xs font-bold uppercase tracking-[0.18em] text-ink/60">Resumo</span>
        <textarea name="resumo" rows="2" class="rounded-lg border border-teal-dark/15 px-3 py-2.5 focus:outline-none focus:border-teal-mid"><?= e($post['resumo']) ?></textarea>
      </label>
      <label class="grid gap-1.5">
        <span class="text-xs font-bold uppercase tracking-[0.18em] text-ink/60">Conteúdo <span class="font-normal lowercase tracking-normal">(HTML: &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;&lt;li&gt;, &lt;strong&gt;)</span></span>
        <textarea name="conteudo" rows="18" required class="rounded-lg border border-teal-dark/15 px-3 py-2.5 font-mono text-sm focus:outline-none focus:border-teal-mid"><?= e($post['conteudo']) ?></textarea>
      </label>
      <div class="grid sm:grid-cols-2 gap-5">
        <label class="grid gap-1.5">
          <span class="text-xs font-bold uppercase tracking-[0.18em] text-ink/60">Publicação</span>
          <input type="datetime-local" name="publicado_em" value="<?= e($post['publicado_em']) ?>" class="rounded-lg border border-teal-dark/15 px-3 py-2.5 focus:outline-none focus:border-teal-mid">
        </label>
        <label class="flex items-center gap-2 mt-6">
          <input type="checkbox" name="ativo" value="1" <?= $post['ativo'] ? 'checked' : '' ?> class="size-4 accent-teal-dark">
          <span class="text-sm text-ink/75">Publicar (visível no site)</span>
        </label>
      </div>
      <div class="flex gap-3 pt-2">
        <button class="px-6 py-3 rounded-full bg-teal-dark text-cream font-semibold hover:bg-teal-mid transition-colors">Salvar</button>
        <a href="<?= url('/admin') ?>" class="px-6 py-3 rounded-full border border-teal-dark/20 text-teal-dark hover:bg-cream transition-colors">Cancelar</a>
      </div>
    </form>
    <?php
    admin_chrome($id ? 'Editar artigo' : 'Novo artigo', ob_get_clean());
}

function admin_post_save(): void
{
    if (!csrf_check()) { admin_redirect('/admin'); }
    $pdo = admin_db();
    $id = (int)($_POST['id'] ?? 0);
    $titulo = trim((string)($_POST['titulo'] ?? ''));
    $slug = trim((string)($_POST['slug'] ?? '')) ?: slugify($titulo);
    $resumo = trim((string)($_POST['resumo'] ?? ''));
    $conteudo = (string)($_POST['conteudo'] ?? '');
    $pub = trim((string)($_POST['publicado_em'] ?? ''));
    $pub = $pub ? date('Y-m-d H:i:s', strtotime($pub)) : date('Y-m-d H:i:s');
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    if ($titulo === '' || $conteudo === '') { admin_redirect('/admin'); }

    if ($id) {
        $stmt = $pdo->prepare('UPDATE posts SET titulo=?, slug=?, resumo=?, conteudo=?, publicado_em=?, ativo=? WHERE id=?');
        $stmt->execute([$titulo, $slug, $resumo, $conteudo, $pub, $ativo, $id]);
        $_SESSION['admin_flash'] = 'Artigo atualizado.';
    } else {
        $stmt = $pdo->prepare('INSERT INTO posts (slug, titulo, resumo, conteudo, publicado_em, ativo) VALUES (?,?,?,?,?,?)');
        $stmt->execute([$slug, $titulo, $resumo, $conteudo, $pub, $ativo]);
        $_SESSION['admin_flash'] = 'Artigo criado.';
    }
    admin_redirect('/admin');
}

function admin_post_delete(): void
{
    if (!csrf_check()) { admin_redirect('/admin'); }
    $pdo = admin_db();
    $stmt = $pdo->prepare('DELETE FROM posts WHERE id = ?');
    $stmt->execute([(int)($_POST['id'] ?? 0)]);
    $_SESSION['admin_flash'] = 'Artigo excluído.';
    admin_redirect('/admin');
}

/* ---- Layout do painel ---- */
function admin_chrome(string $title, string $body, bool $withBar = true): void
{
    ?><!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title><?= e($title) ?> · Admin — Aline Politi</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>tailwind.config={theme:{extend:{colors:{'teal-dark':'#117B7F','teal-mid':'#1FB6A8','magenta':'#A52A7E','amber':'#F2A91E','cream':'#FCF9F5','ink':'#1F3334'},fontFamily:{heading:['Georgia','serif']}}}}</script>
  <style>body{background:#FCF9F5;color:#1F3334;font-family:ui-sans-serif,system-ui,sans-serif}.font-heading{font-family:Georgia,serif}code{background:#F1EBE1;padding:1px 5px;border-radius:4px;font-size:.85em}</style>
</head>
<body>
  <?php if ($withBar): ?>
  <header class="bg-teal-dark text-cream">
    <div class="max-w-5xl mx-auto px-6 h-14 flex items-center justify-between">
      <a href="<?= url('/admin') ?>" class="font-heading text-lg">Aline Politi · Admin</a>
      <nav class="flex items-center gap-5 text-sm">
        <span class="text-cream/70 hidden sm:inline">Olá, <?= e($_SESSION['admin_nome'] ?? '') ?></span>
        <a href="<?= url('/') ?>" target="_blank" class="hover:text-amber">Ver site ↗</a>
        <a href="<?= url('/admin/logout') ?>" class="hover:text-amber">Sair</a>
      </nav>
    </div>
  </header>
  <?php endif; ?>
  <main class="max-w-5xl mx-auto px-6 py-10"><?= $body ?></main>
</body>
</html><?php
}
