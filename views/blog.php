<?php
/** /blog — lista posts do MySQL; se vazio, mostra estado "em construção" (fiel ao design) */
$posts = blog_posts();
page_hero('Reflexões em', 'construção', 'Blog', 'Em breve, conteúdos sobre TCC, saúde mental e parentalidade — sempre com base na ciência e na escuta clínica.');
?>
<?php if ($posts): ?>
  <section class="max-w-5xl mx-auto px-6 lg:px-8 pb-12 grid md:grid-cols-2 gap-6">
    <?php foreach ($posts as $p): ?>
      <a href="<?= url('/blog/' . rawurlencode($p['slug'])) ?>" class="group p-8 rounded-[2rem] bg-white border border-teal-dark/5 hover:border-magenta transition-all flex flex-col">
        <?php if (!empty($p['publicado_em'])): ?>
          <time class="text-xs font-bold tracking-[0.2em] uppercase text-magenta"><?= e(date('d/m/Y', strtotime((string)$p['publicado_em']))) ?></time>
        <?php endif; ?>
        <h2 class="font-heading text-2xl text-teal-dark mt-2 mb-3"><?= e($p['titulo']) ?></h2>
        <?php if (!empty($p['resumo'])): ?><p class="text-ink/70"><?= e($p['resumo']) ?></p><?php endif; ?>
        <span class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-teal-dark group-hover:text-magenta">Ler artigo <?= icon('arrow-right', 'size-4') ?></span>
      </a>
    <?php endforeach; ?>
  </section>
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
