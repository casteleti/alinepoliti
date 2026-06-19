<?php
/** /perguntas-frequentes — accordion acessível com <details> (sem JS). */
$faq = faq_items();
page_hero('Perguntas', 'frequentes', 'FAQ', 'As dúvidas mais comuns sobre a psicoterapia em TCC, atendimento e agendamento.');
?>
<section class="max-w-3xl mx-auto px-6 lg:px-8 pb-16">
  <div class="space-y-3">
    <?php foreach ($faq as $f): ?>
      <details class="group bg-white border border-teal-dark/10 rounded-2xl px-6">
        <summary class="flex items-center justify-between gap-4 cursor-pointer list-none font-heading text-lg text-teal-dark py-5">
          <span><?= e($f['q']) ?></span>
          <span class="text-magenta transition-transform group-open:rotate-180"><?= icon('chevron-down', 'size-5') ?></span>
        </summary>
        <p class="text-ink/75 leading-relaxed text-base pb-5"><?= e($f['a']) ?></p>
      </details>
    <?php endforeach; ?>
  </div>
</section>
<?php bloco_psicologa('Falar sobre o que pesa já é começar a aliviar.'); ?>
<?php cta_section(); ?>
