<?php
/** /blog/{slug} — detalhe do post. Espera $post no escopo (vem do index.php). */
page_hero($post['titulo'], '', 'Blog', $post['resumo'] ?? '');

$tldr   = array_values(array_filter(array_map('trim', explode("\n", (string)($post['tldr'] ?? '')))));
$faq    = blog_faq($post);
$fontes = array_values(array_filter(array_map('trim', explode("\n", (string)($post['fontes'] ?? '')))));
$relac  = blog_relacionados($post, 3);
?>
<article class="max-w-3xl mx-auto px-6 lg:px-8 py-12">
  <?php if (!empty($post['publicado_em'])): ?>
    <p class="text-xs font-bold tracking-[0.2em] uppercase text-magenta mb-6">Publicado em <?= e(date('d/m/Y', strtotime((string)$post['publicado_em']))) ?></p>
  <?php endif; ?>

  <!-- 02 · Texto (esquerda) com a imagem flutuando à direita; ao fim da imagem, o texto ocupa a largura toda -->
  <div class="text-ink/80 text-[17px] leading-[1.8] [&>h2]:font-heading [&>h2]:text-teal-dark [&>h2]:text-3xl [&>h2]:mt-10 [&>h2]:mb-4 [&>h3]:font-heading [&>h3]:text-teal-dark [&>h3]:text-xl [&>p]:mb-5 [&>ul]:list-disc [&>ul]:pl-6 [&>ul]:space-y-2 [&>ul]:mb-5 [&_strong]:text-teal-dark [&_a]:text-teal-dark">
    <?php if (!empty($post['capa'])): ?>
      <img src="<?= asset('blog/' . $post['capa']) ?>" alt="<?= e($post['titulo']) ?>" width="900" height="1501"
           class="w-full sm:w-[42%] sm:float-right sm:ml-8 sm:mb-4 mb-6 rounded-2xl ring-1 ring-teal-dark/10" loading="lazy">
    <?php endif; ?>
    <?= blog_interlink((string)$post['conteudo']) /* HTML confiável (autoria do admin) + links internos automáticos */ ?>
    <div class="clear-both"></div>
  </div>

  <!-- 04 · Fontes & referências -->
  <?php if ($fontes): ?>
    <div class="mt-12 pt-6 border-t border-teal-dark/10">
      <p class="text-xs font-bold uppercase tracking-[0.2em] text-magenta mb-3">Fontes &amp; referências</p>
      <ul class="space-y-1.5 text-sm text-ink/60">
        <?php foreach ($fontes as $f): ?>
          <li><?php if (preg_match('#^https?://#', $f)): ?><a href="<?= e($f) ?>" target="_blank" rel="noopener" class="text-teal-dark hover:text-magenta break-all"><?= e($f) ?></a><?php else: ?><?= e($f) ?><?php endif; ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <!-- 05 · Resumo rápido (TL;DR) -->
  <?php if ($tldr): ?>
    <div class="mt-10 rounded-2xl bg-cream border border-teal-dark/10 p-6">
      <p class="text-xs font-bold uppercase tracking-[0.2em] text-magenta mb-3">Resumo rápido</p>
      <ul class="space-y-2 text-ink/80">
        <?php foreach ($tldr as $b): ?>
          <li class="flex gap-2.5"><span class="text-teal-mid mt-1">•</span><span><?= e($b) ?></span></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <!-- 06 · Perguntas frequentes -->
  <?php if ($faq): ?>
    <section class="mt-14">
      <h2 class="font-heading text-3xl text-teal-dark mb-6">Perguntas frequentes</h2>
      <div class="space-y-3">
        <?php foreach ($faq as $item): ?>
          <details class="group rounded-2xl bg-white border border-teal-dark/10 p-5">
            <summary class="flex items-center justify-between gap-4 cursor-pointer font-heading text-lg text-teal-dark list-none">
              <?= e($item['q']) ?>
              <span class="text-magenta transition-transform group-open:rotate-45 text-2xl leading-none">+</span>
            </summary>
            <p class="mt-3 text-ink/75 leading-relaxed"><?= nl2br(e($item['a'])) ?></p>
          </details>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <!-- 07 · Leia também -->
  <?php if ($relac): ?>
    <section class="mt-14">
      <h2 class="font-heading text-2xl text-teal-dark mb-5">Leia também</h2>
      <div class="grid sm:grid-cols-3 gap-5">
        <?php foreach ($relac as $r): ?>
          <a href="<?= url('/blog/' . rawurlencode($r['slug'])) ?>" class="group rounded-2xl bg-white border border-teal-dark/5 hover:border-magenta transition-all overflow-hidden">
            <?php if (!empty($r['capa'])): ?><img src="<?= asset('blog/' . $r['capa']) ?>" alt="<?= e($r['titulo']) ?>" class="w-full aspect-[3/5] object-cover" loading="lazy"><?php endif; ?>
            <span class="block p-4 font-heading text-teal-dark group-hover:text-magenta transition-colors leading-snug"><?= e($r['titulo']) ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <p class="mt-14"><a href="<?= url('/blog') ?>" class="inline-flex items-center gap-2 text-teal-dark font-semibold hover:text-magenta"><?= icon('arrow-right', 'size-4 rotate-180') ?> Voltar ao blog</a></p>
</article>
<?php cta_section(); ?>
