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
        case $path === '/admin/posts/analisar' && $method === 'POST':
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode(['tags' => blog_extrair_tags(
                (string)($_POST['titulo'] ?? ''), (string)($_POST['conteudo'] ?? ''), 10)],
                JSON_UNESCAPED_UNICODE);
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
        <img src="<?= asset('logo.png') ?>" alt="Aline Politi" class="h-10 mx-auto mb-4">
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
    $contatos = $pdo->query('SELECT nome, email, telefone, assunto, origem, mensagem, criado_em FROM contatos ORDER BY criado_em DESC LIMIT 20')->fetchAll();
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
          <div class="flex justify-between items-start gap-3 text-sm">
            <span class="font-semibold text-teal-dark"><?= e($c['nome']) ?></span>
            <span class="text-ink/50 whitespace-nowrap"><?= e(date('d/m/Y H:i', strtotime((string)$c['criado_em']))) ?></span>
          </div>
          <div class="flex flex-wrap gap-2 mt-1.5">
            <?php if (!empty($c['assunto'])): ?><span class="text-[11px] font-semibold px-2 py-0.5 rounded-full bg-magenta/10 text-magenta"><?= e($c['assunto']) ?></span><?php endif; ?>
            <?php if (!empty($c['origem'])): ?><span class="text-[11px] px-2 py-0.5 rounded-full bg-teal-mid/10 text-teal-dark/70">via <?= e($c['origem']) ?></span><?php endif; ?>
          </div>
          <p class="text-xs text-ink/50 mt-1.5"><?= e($c['email']) ?><?php if (!empty($c['telefone'])): ?> · <?= e($c['telefone']) ?><?php endif; ?></p>
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
    $post = ['id' => 0, 'titulo' => '', 'slug' => '', 'resumo' => '', 'conteudo' => '', 'capa' => '',
        'meta_titulo' => '', 'meta_descricao' => '', 'keyword_foco' => '', 'tags' => '', 'tldr' => '', 'faq' => '', 'fontes' => '',
        'publicado_em' => date('Y-m-d\TH:i'), 'ativo' => 1];
    if ($id) {
        $stmt = $pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (!$row) { admin_redirect('/admin'); }
        $post = array_merge($post, $row);
        $post['publicado_em'] = $post['publicado_em'] ? date('Y-m-d\TH:i', strtotime((string)$post['publicado_em'])) : '';
    }
    $score   = blog_seo_score($post);
    $faqRows = blog_faq($post) ?: [['q' => '', 'a' => '']];
    $bank    = todas_keywords();
    $inp = 'w-full rounded-lg border border-teal-dark/15 px-3 py-2.5 focus:outline-none focus:border-teal-mid';
    $lbl = 'text-xs font-bold uppercase tracking-[0.18em] text-ink/60';
    ob_start(); ?>
    <div class="flex items-center justify-between mb-6">
      <h1 class="font-heading text-2xl text-teal-dark"><?= $id ? 'Editar artigo' : 'Novo artigo' ?></h1>
      <a href="<?= url('/admin') ?>" class="text-sm text-ink/60 hover:text-magenta">← voltar</a>
    </div>
    <form method="post" action="<?= url('/admin/posts/salvar') ?>" enctype="multipart/form-data" id="post-form" class="grid lg:grid-cols-[1fr_320px] gap-6 items-start">
      <div class="bg-white rounded-2xl border border-teal-dark/10 p-7 grid gap-5">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= (int)$post['id'] ?>">

        <label class="grid gap-1.5">
          <span class="<?= $lbl ?>">Título</span>
          <input type="text" name="titulo" id="f-titulo" required value="<?= e($post['titulo']) ?>" class="<?= $inp ?>">
        </label>

        <label class="grid gap-1.5">
          <span class="<?= $lbl ?>">Slug <span class="font-normal lowercase tracking-normal">(vazio = gera do título)</span></span>
          <input type="text" name="slug" id="f-slug" value="<?= e($post['slug']) ?>" class="<?= $inp ?>">
        </label>

        <!-- Imagem de capa -->
        <div class="grid gap-1.5">
          <span class="<?= $lbl ?>">Imagem de capa <span class="font-normal lowercase tracking-normal">(900×1501px — convertida para WebP · ALT = título)</span></span>
          <?php if (!empty($post['capa'])): ?>
            <div class="flex items-center gap-3 mb-1">
              <img src="<?= asset('blog/' . $post['capa']) ?>" alt="" class="w-16 h-[107px] object-cover rounded-lg ring-1 ring-teal-dark/10">
              <span class="text-xs text-ink/50"><?= e($post['capa']) ?></span>
            </div>
          <?php endif; ?>
          <input type="file" name="capa" accept="image/*" class="text-sm file:mr-3 file:px-4 file:py-2 file:rounded-full file:border-0 file:bg-teal-dark file:text-cream file:font-semibold hover:file:bg-teal-mid">
        </div>

        <label class="grid gap-1.5">
          <span class="<?= $lbl ?>">Resumo</span>
          <textarea name="resumo" rows="2" class="<?= $inp ?>"><?= e($post['resumo']) ?></textarea>
        </label>

        <!-- Resumo rápido / TL;DR -->
        <label class="grid gap-1.5">
          <span class="<?= $lbl ?>">Resumo rápido — TL;DR <span class="font-normal lowercase tracking-normal">(1 tópico por linha · ótimo p/ IA)</span></span>
          <textarea name="tldr" rows="3" class="<?= $inp ?>" placeholder="Ex.: A TCC trata a ansiedade em médio prazo.&#10;Foca em pensamentos, emoções e comportamentos."><?= e($post['tldr']) ?></textarea>
        </label>

        <label class="grid gap-1.5">
          <span class="<?= $lbl ?>">Conteúdo <span class="font-normal lowercase tracking-normal">(HTML: &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;&lt;li&gt;, &lt;strong&gt;)</span></span>
          <textarea name="conteudo" id="f-conteudo" rows="16" required class="<?= $inp ?> font-mono text-sm"><?= e($post['conteudo']) ?></textarea>
        </label>

        <!-- SEO on-page -->
        <div class="border-t border-teal-dark/10 pt-5 grid gap-5">
          <p class="font-heading text-lg text-teal-dark">SEO &amp; GEO</p>

          <label class="grid gap-1.5">
            <span class="<?= $lbl ?>">Meta título <span id="c-metat" class="font-normal lowercase tracking-normal text-ink/40"></span></span>
            <input type="text" name="meta_titulo" id="f-metat" maxlength="70" value="<?= e($post['meta_titulo']) ?>" class="<?= $inp ?>" placeholder="(vazio = usa o título)">
          </label>

          <label class="grid gap-1.5">
            <span class="<?= $lbl ?>">Meta descrição <span id="c-metad" class="font-normal lowercase tracking-normal text-ink/40"></span></span>
            <textarea name="meta_descricao" id="f-metad" rows="2" maxlength="180" class="<?= $inp ?>" placeholder="Ideal 120–160 caracteres"><?= e($post['meta_descricao']) ?></textarea>
          </label>

          <!-- Prévia Google -->
          <div class="rounded-lg bg-cream p-4">
            <span class="<?= $lbl ?>">Prévia no Google</span>
            <div class="mt-2">
              <div class="text-[#1a0dab] text-lg leading-tight" id="g-title">Título</div>
              <div class="text-[#006621] text-sm" id="g-url">alinepoliti.com.br › blog › slug</div>
              <div class="text-[#545454] text-sm" id="g-desc">Descrição…</div>
            </div>
          </div>

          <label class="grid gap-1.5">
            <span class="<?= $lbl ?>">Palavra-chave foco</span>
            <input type="text" name="keyword_foco" list="kw-list" value="<?= e($post['keyword_foco']) ?>" class="<?= $inp ?>" placeholder="Ex.: terapia para ansiedade em jaboticabal">
            <datalist id="kw-list"><?php foreach ($bank as $kw): ?><option value="<?= e($kw) ?>"></option><?php endforeach; ?></datalist>
          </label>

          <!-- Tags -->
          <div class="grid gap-2">
            <span class="<?= $lbl ?>">Tags</span>
            <input type="hidden" name="tags" id="f-tags" value="<?= e($post['tags']) ?>">
            <div id="tag-chips" class="flex flex-wrap gap-2"></div>
            <div class="flex flex-wrap gap-2 mt-1">
              <button type="button" id="btn-sugerir" class="px-3 py-1.5 rounded-full bg-magenta/10 text-magenta text-sm font-semibold hover:bg-magenta/20">✨ Sugerir do texto</button>
              <input type="text" id="tag-manual" placeholder="+ adicionar tag e Enter" class="rounded-full border border-teal-dark/15 px-3 py-1.5 text-sm focus:outline-none focus:border-teal-mid">
            </div>
            <details class="mt-1">
              <summary class="cursor-pointer text-sm text-teal-dark font-semibold">Banco de palavras-chave (clique para ativar)</summary>
              <input type="text" id="bank-filtro" placeholder="filtrar…" class="mt-2 w-full rounded-lg border border-teal-dark/15 px-3 py-2 text-sm focus:outline-none focus:border-teal-mid">
              <div class="mt-2 max-h-56 overflow-auto flex flex-wrap gap-1.5 p-1">
                <?php foreach ($bank as $kw): ?>
                  <button type="button" class="bank-item px-2.5 py-1 rounded-full bg-cream border border-teal-dark/10 text-xs text-teal-dark/80 hover:border-magenta hover:text-magenta"><?= e($kw) ?></button>
                <?php endforeach; ?>
              </div>
            </details>
          </div>

          <!-- FAQ -->
          <div class="grid gap-2">
            <span class="<?= $lbl ?>">Perguntas frequentes (FAQ) <span class="font-normal lowercase tracking-normal">(vira schema FAQPage — citável por IA)</span></span>
            <div id="faq-rows" class="grid gap-3">
              <?php foreach ($faqRows as $f): ?>
                <div class="faq-row grid gap-2 rounded-lg bg-cream p-3">
                  <input type="text" name="faq_q[]" value="<?= e($f['q']) ?>" placeholder="Pergunta" class="<?= $inp ?> bg-white">
                  <textarea name="faq_a[]" rows="2" placeholder="Resposta" class="<?= $inp ?> bg-white"><?= e($f['a']) ?></textarea>
                  <button type="button" class="faq-del justify-self-start text-xs text-magenta/80 hover:text-magenta">remover</button>
                </div>
              <?php endforeach; ?>
            </div>
            <button type="button" id="faq-add" class="justify-self-start px-3 py-1.5 rounded-full bg-teal-mid/10 text-teal-dark text-sm font-semibold hover:bg-teal-mid/20">＋ adicionar pergunta</button>
          </div>

          <label class="grid gap-1.5">
            <span class="<?= $lbl ?>">Fontes / Referências <span class="font-normal lowercase tracking-normal">(1 por linha · reforça autoridade)</span></span>
            <textarea name="fontes" rows="3" class="<?= $inp ?>"><?= e($post['fontes']) ?></textarea>
          </label>
        </div>

        <div class="grid sm:grid-cols-2 gap-5 border-t border-teal-dark/10 pt-5">
          <label class="grid gap-1.5">
            <span class="<?= $lbl ?>">Publicação</span>
            <input type="datetime-local" name="publicado_em" value="<?= e($post['publicado_em']) ?>" class="<?= $inp ?>">
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
      </div>

      <!-- Painel lateral: Nota de SEO -->
      <aside class="bg-white rounded-2xl border border-teal-dark/10 p-6 lg:sticky lg:top-6">
        <div class="flex items-center justify-between mb-3">
          <span class="font-heading text-teal-dark">Nota de SEO</span>
          <span class="text-sm font-bold <?= $score['pct'] >= 80 ? 'text-teal-mid' : ($score['pct'] >= 50 ? 'text-amber' : 'text-magenta') ?>"><?= $score['pct'] ?>%</span>
        </div>
        <div class="h-2 rounded-full bg-cream overflow-hidden mb-4">
          <div class="h-full <?= $score['pct'] >= 80 ? 'bg-teal-mid' : ($score['pct'] >= 50 ? 'bg-amber' : 'bg-magenta') ?>" style="width: <?= $score['pct'] ?>%"></div>
        </div>
        <ul class="space-y-1.5 text-sm">
          <?php foreach ($score['checks'] as $c): ?>
            <li class="flex items-start gap-2 <?= $c[1] ? 'text-ink/70' : 'text-ink/45' ?>">
              <span><?= $c[1] ? '✅' : '⬜️' ?></span><span><?= e($c[0]) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
        <p class="mt-4 text-xs text-ink/45">Salve para recalcular a nota.</p>
      </aside>
    </form>

    <script>
    (function () {
      var form = document.getElementById('post-form');
      // ---- Tags ----
      var hidden = document.getElementById('f-tags');
      var chips  = document.getElementById('tag-chips');
      function tagsArr(){ return hidden.value.split(',').map(function(t){return t.trim();}).filter(Boolean); }
      function render(){
        chips.innerHTML = '';
        tagsArr().forEach(function(t){
          var el = document.createElement('span');
          el.className = 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-teal-mid/10 text-teal-dark text-sm';
          el.innerHTML = '<span></span><button type="button" class="text-magenta/70 hover:text-magenta">&times;</button>';
          el.querySelector('span').textContent = t;
          el.querySelector('button').onclick = function(){ removeTag(t); };
          chips.appendChild(el);
        });
      }
      function addTag(t){ t=(t||'').trim(); if(!t) return; var a=tagsArr(); if(a.some(function(x){return x.toLowerCase()===t.toLowerCase();})) return; a.push(t); hidden.value=a.join(', '); render(); }
      function removeTag(t){ hidden.value = tagsArr().filter(function(x){return x.toLowerCase()!==t.toLowerCase();}).join(', '); render(); }
      render();
      var manual = document.getElementById('tag-manual');
      manual.addEventListener('keydown', function(e){ if(e.key==='Enter'){ e.preventDefault(); addTag(manual.value); manual.value=''; } });
      Array.prototype.forEach.call(document.querySelectorAll('.bank-item'), function(b){ b.onclick=function(){ addTag(b.textContent); }; });
      var filtro = document.getElementById('bank-filtro');
      if (filtro) filtro.addEventListener('input', function(){ var q=this.value.toLowerCase(); Array.prototype.forEach.call(document.querySelectorAll('.bank-item'), function(b){ b.style.display = b.textContent.toLowerCase().indexOf(q)>=0 ? '' : 'none'; }); });
      document.getElementById('btn-sugerir').onclick = function(){
        var btn=this; btn.disabled=true; btn.textContent='Analisando…';
        var fd = new FormData(); fd.append('titulo', document.getElementById('f-titulo').value); fd.append('conteudo', document.getElementById('f-conteudo').value);
        fetch('<?= url('/admin/posts/analisar') ?>', {method:'POST', body:fd, credentials:'same-origin'})
          .then(function(r){return r.json();}).then(function(d){ (d.tags||[]).forEach(addTag); })
          .finally(function(){ btn.disabled=false; btn.textContent='✨ Sugerir do texto'; });
      };
      // ---- FAQ ----
      document.getElementById('faq-add').onclick = function(){
        var wrap = document.getElementById('faq-rows');
        var row = wrap.querySelector('.faq-row').cloneNode(true);
        row.querySelector('input').value=''; row.querySelector('textarea').value='';
        wrap.appendChild(row);
      };
      document.getElementById('faq-rows').addEventListener('click', function(e){
        if (e.target.classList.contains('faq-del')) {
          var rows = document.querySelectorAll('.faq-row');
          if (rows.length > 1) e.target.closest('.faq-row').remove();
          else { e.target.closest('.faq-row').querySelector('input').value=''; e.target.closest('.faq-row').querySelector('textarea').value=''; }
        }
      });
      // ---- Contadores + prévia Google ----
      function upd(){
        var t=document.getElementById('f-metat'), d=document.getElementById('f-metad');
        var titulo=document.getElementById('f-titulo').value, slug=document.getElementById('f-slug').value;
        var metaT=t.value||titulo, metaD=d.value||'';
        document.getElementById('c-metat').textContent='('+metaT.length+'/60)';
        document.getElementById('c-metad').textContent='('+metaD.length+'/160)';
        document.getElementById('g-title').textContent = metaT || 'Título';
        document.getElementById('g-url').textContent = 'alinepoliti.com.br › blog › ' + (slug || 'slug');
        document.getElementById('g-desc').textContent = metaD || 'A descrição que aparece na busca do Google…';
      }
      ['f-metat','f-metad','f-titulo','f-slug'].forEach(function(idv){ document.getElementById(idv).addEventListener('input', upd); });
      upd();
    })();
    </script>
    <?php
    admin_chrome($id ? 'Editar artigo' : 'Novo artigo', ob_get_clean());
}

function admin_post_save(): void
{
    if (!csrf_check()) { admin_redirect('/admin'); }
    $pdo = admin_db();
    $id       = (int)($_POST['id'] ?? 0);
    $titulo   = trim((string)($_POST['titulo'] ?? ''));
    $slug     = trim((string)($_POST['slug'] ?? '')) ?: slugify($titulo);
    $resumo   = trim((string)($_POST['resumo'] ?? ''));
    $conteudo = (string)($_POST['conteudo'] ?? '');
    $metaT    = trim((string)($_POST['meta_titulo'] ?? ''));
    $metaD    = trim((string)($_POST['meta_descricao'] ?? ''));
    $kw       = trim((string)($_POST['keyword_foco'] ?? ''));
    $fontes   = trim((string)($_POST['fontes'] ?? ''));
    $tldr     = trim((string)($_POST['tldr'] ?? ''));
    $pub      = trim((string)($_POST['publicado_em'] ?? ''));
    $pub      = $pub ? date('Y-m-d H:i:s', strtotime($pub)) : date('Y-m-d H:i:s');
    $ativo    = isset($_POST['ativo']) ? 1 : 0;

    if ($titulo === '' || $conteudo === '') { admin_redirect('/admin'); }

    // Tags: se vazias, extrai automaticamente do texto
    $tags = trim((string)($_POST['tags'] ?? ''));
    if ($tags === '') { $tags = implode(', ', blog_extrair_tags($titulo, $conteudo, 10)); }

    // FAQ: pares q/a → JSON
    $fq = $_POST['faq_q'] ?? []; $fa = $_POST['faq_a'] ?? [];
    $faqArr = [];
    foreach ((array)$fq as $i => $q) {
        $q = trim((string)$q); $a = trim((string)($fa[$i] ?? ''));
        if ($q !== '' && $a !== '') { $faqArr[] = ['q' => $q, 'a' => $a]; }
    }
    $faqJson = $faqArr ? json_encode($faqArr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null;

    // Upload de capa → WebP (mantém a atual se não enviar nova)
    $capa = null; $capaSet = false;
    if (!empty($_FILES['capa']['name'])) {
        $nova = blog_gerar_webp($_FILES['capa']);
        if ($nova) { $capa = $nova; $capaSet = true; }
    }

    if ($id) {
        $sql = 'UPDATE posts SET titulo=?, slug=?, resumo=?, conteudo=?, meta_titulo=?, meta_descricao=?, keyword_foco=?, tags=?, tldr=?, faq=?, fontes=?, publicado_em=?, ativo=?'
            . ($capaSet ? ', capa=?' : '') . ' WHERE id=?';
        $params = [$titulo, $slug, $resumo, $conteudo, $metaT ?: null, $metaD ?: null, $kw ?: null, $tags ?: null, $tldr ?: null, $faqJson, $fontes ?: null, $pub, $ativo];
        if ($capaSet) { $params[] = $capa; }
        $params[] = $id;
        $pdo->prepare($sql)->execute($params);
        $_SESSION['admin_flash'] = 'Artigo atualizado.' . ($capaSet ? ' Capa convertida para WebP.' : '');
    } else {
        $pdo->prepare('INSERT INTO posts (slug, titulo, resumo, conteudo, capa, meta_titulo, meta_descricao, keyword_foco, tags, tldr, faq, fontes, publicado_em, ativo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)')
            ->execute([$slug, $titulo, $resumo, $conteudo, $capa, $metaT ?: null, $metaD ?: null, $kw ?: null, $tags ?: null, $tldr ?: null, $faqJson, $fontes ?: null, $pub, $ativo]);
        $_SESSION['admin_flash'] = 'Artigo criado.' . ($capaSet ? ' Capa convertida para WebP.' : '');
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
