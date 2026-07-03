<?php
/** /blog — lista posts do MySQL; se vazio, mostra estado "em construção" (fiel ao design) */
$posts = blog_posts();

// --- Busca + ordenação (via querystring, sem depender de JS) ---
$q     = isset($_GET['q']) ? trim((string)$_GET['q']) : '';
$ordem = (isset($_GET['ordem']) && $_GET['ordem'] === 'antigos') ? 'antigos' : 'recentes';

if ($posts) {
    // Filtro de busca (título + resumo, sem diferenciar maiúsc./acentos)
    if ($q !== '') {
        $norm = static function (string $s): string {
            $s = mb_strtolower($s, 'UTF-8');
            $t = @iconv('UTF-8', 'ASCII//TRANSLIT', $s);
            return $t !== false ? $t : $s;
        };
        $alvo = $norm($q);
        $posts = array_values(array_filter($posts, static function ($p) use ($norm, $alvo) {
            return mb_stripos($norm(($p['titulo'] ?? '') . ' ' . ($p['resumo'] ?? '')), $alvo) !== false;
        }));
    }
    // Ordenação por data de publicação
    usort($posts, static function ($a, $b) use ($ordem) {
        $da = strtotime((string)($a['publicado_em'] ?? '')) ?: 0;
        $db = strtotime((string)($b['publicado_em'] ?? '')) ?: 0;
        return $ordem === 'antigos' ? ($da <=> $db) : ($db <=> $da);
    });
}

page_hero('Reflexões sobre', 'a mente', 'Blog', 'Conteúdos sobre TCC, saúde mental e parentalidade — sempre com base na ciência e na escuta clínica.');
?>
<?php if (blog_posts()): ?>
  <!-- Busca + ordenação -->
  <section class="max-w-5xl mx-auto px-6 lg:px-8 pb-8">
    <form method="get" action="<?= url('/blog') ?>" class="flex flex-col sm:flex-row gap-3 sm:items-center">
      <label class="relative flex-1">
        <span class="sr-only">Buscar artigos</span>
        <svg class="absolute left-4 top-1/2 -translate-y-1/2 size-4 text-teal-dark/40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="search" name="q" value="<?= e($q) ?>" placeholder="Buscar por tema, título…"
               class="w-full pl-11 pr-4 py-3 rounded-full bg-white border border-teal-dark/10 text-ink placeholder:text-ink/40 focus:outline-none focus:border-magenta focus:ring-2 focus:ring-magenta/15 transition">
      </label>
      <label class="relative">
        <span class="sr-only">Ordenar por</span>
        <select name="ordem" onchange="this.form.submit()"
                class="appearance-none pl-4 pr-10 py-3 rounded-full bg-white border border-teal-dark/10 text-teal-dark font-medium focus:outline-none focus:border-magenta focus:ring-2 focus:ring-magenta/15 transition cursor-pointer">
          <option value="recentes" <?= $ordem === 'recentes' ? 'selected' : '' ?>>Mais recentes primeiro</option>
          <option value="antigos"  <?= $ordem === 'antigos'  ? 'selected' : '' ?>>Mais antigos primeiro</option>
        </select>
        <svg class="pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 size-4 text-teal-dark/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 9 6 6 6-6"/></svg>
      </label>
      <button type="submit" class="px-6 py-3 rounded-full bg-teal-dark text-cream font-medium hover:bg-teal-mid transition-colors">Buscar</button>
    </form>
    <?php if ($q !== ''): ?>
      <p class="mt-4 text-sm text-ink/60">
        <?= count($posts) ?> resultado<?= count($posts) === 1 ? '' : 's' ?> para “<strong class="text-teal-dark"><?= e($q) ?></strong>”.
        <a href="<?= url('/blog') ?>" class="text-magenta font-semibold hover:underline ml-1">Limpar busca</a>
      </p>
    <?php endif; ?>
  </section>

  <?php if ($posts): ?>
    <section class="max-w-5xl mx-auto px-6 lg:px-8 pb-12 grid md:grid-cols-2 gap-6">
      <?php foreach ($posts as $p): ?>
        <a href="<?= url('/blog/' . rawurlencode($p['slug'])) ?>" class="group rounded-[2rem] bg-white border border-teal-dark/5 hover:border-magenta transition-all flex overflow-hidden">
          <?php if (!empty($p['capa'])): ?>
            <img src="<?= asset('blog/' . $p['capa']) ?>" alt="<?= e($p['titulo']) ?>" class="w-28 sm:w-36 shrink-0 object-cover self-stretch" loading="lazy">
          <?php endif; ?>
          <div class="p-6 sm:p-8 flex flex-col">
          <?php if (!empty($p['publicado_em'])): ?>
            <time class="text-xs font-bold tracking-[0.2em] uppercase text-magenta"><?= e(date('d/m/Y', strtotime((string)$p['publicado_em']))) ?></time>
          <?php endif; ?>
          <h2 class="font-heading text-2xl text-teal-dark mt-2 mb-3"><?= e($p['titulo']) ?></h2>
          <?php if (!empty($p['resumo'])): ?><p class="text-ink/70"><?= e($p['resumo']) ?></p><?php endif; ?>
          <span class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-teal-dark group-hover:text-magenta">Ler artigo <?= icon('arrow-right', 'size-4') ?></span>
          </div>
        </a>
      <?php endforeach; ?>
    </section>
  <?php else: ?>
    <section class="max-w-3xl mx-auto px-6 lg:px-8 pb-12">
      <div class="rounded-[2rem] bg-white border border-teal-dark/10 p-10 text-center">
        <p class="font-display italic text-2xl text-teal-dark">Nenhum artigo encontrado para “<?= e($q) ?>”.</p>
        <p class="mt-4 text-ink/70">Tente outra palavra ou <a href="<?= url('/blog') ?>" class="text-magenta font-semibold">veja todos os artigos</a>.</p>
      </div>
    </section>
  <?php endif; ?>
<?php else: ?>
  <section class="max-w-3xl mx-auto px-6 lg:px-8 pb-12">
    <div class="rounded-[2rem] bg-white border border-teal-dark/10 p-10 text-center">
      <p class="font-display italic text-3xl text-teal-dark">Os primeiros artigos estão sendo escritos com cuidado.</p>
      <p class="mt-4 text-ink/70">Volte em breve ou siga
        <a href="<?= e(SITE_INSTAGRAM_URL) ?>" target="_blank" rel="noopener" class="text-magenta font-semibold"><?= e(SITE_INSTAGRAM_HANDLE) ?></a>
        para acompanhar.</p>
    </div>
  </section>
<?php endif; ?>
<?php bloco_psicologa('Cuidar da mente é cuidar da vida que você quer viver.'); ?>
<?php cta_section(); ?>
