<?php
/** /blog/{slug} — detalhe do post. Espera $post no escopo (vem do index.php). */
page_hero($post['titulo'], '', 'Blog', $post['resumo'] ?? '');
?>
<article class="max-w-3xl mx-auto px-6 lg:px-8 py-12">
  <?php if (!empty($post['publicado_em'])): ?>
    <p class="text-xs font-bold tracking-[0.2em] uppercase text-magenta mb-6">Publicado em <?= e(date('d/m/Y', strtotime((string)$post['publicado_em']))) ?></p>
  <?php endif; ?>
  <div class="space-y-6 text-ink/80 text-[17px] leading-[1.8] [&>h2]:font-heading [&>h2]:text-teal-dark [&>h2]:text-3xl [&>h2]:mt-12 [&>h2]:mb-4 [&>h3]:font-heading [&>h3]:text-teal-dark [&>h3]:text-xl [&>ul]:list-disc [&>ul]:pl-6 [&>ul]:space-y-2 [&_strong]:text-teal-dark">
    <?= $post['conteudo'] /* HTML confiável (autoria do admin) */ ?>
  </div>
  <p class="mt-12"><a href="<?= url('/blog') ?>" class="inline-flex items-center gap-2 text-teal-dark font-semibold hover:text-magenta"><?= icon('arrow-right', 'size-4 rotate-180') ?> Voltar ao blog</a></p>
</article>
<?php cta_section(); ?>
