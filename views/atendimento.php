<?php
/** /atendimento — hub: atende online e presencial */
page_hero('Atendimento online', 'e presencial', 'Como funciona', 'Você escolhe o formato que cabe na sua vida — presencial em Jaboticabal ou online para todo o Brasil, com a mesma qualidade clínica e o mesmo cuidado.');
?>
<section class="max-w-6xl mx-auto px-6 lg:px-8 grid md:grid-cols-2 gap-6">
  <a href="<?= url('/atendimento/presencial') ?>" class="bg-teal-dark text-cream rounded-[2.5rem] p-10 group relative overflow-hidden">
    <span class="absolute top-6 right-6 opacity-30"><?= icon('map-pin', 'size-6') ?></span>
    <h2 class="font-display italic text-4xl mb-3">Atendimento Presencial</h2>
    <p class="opacity-85 max-w-xs">Um espaço acolhedor e reservado para a sua escuta, no consultório em Jaboticabal — fácil de chegar.</p>
    <span class="inline-flex items-center gap-2 mt-8 font-semibold group-hover:gap-3 transition-all">Saber mais <?= icon('arrow-right', 'size-4') ?></span>
  </a>
  <a href="<?= url('/atendimento/online') ?>" class="bg-magenta text-cream rounded-[2.5rem] p-10 group relative overflow-hidden">
    <span class="absolute top-6 right-6 opacity-30"><?= icon('monitor', 'size-6') ?></span>
    <h2 class="font-display italic text-4xl mb-3">Atendimento Online</h2>
    <p class="opacity-85 max-w-xs">A mesma qualidade clínica, no conforto da sua casa — para todo o Brasil e brasileiros no exterior.</p>
    <span class="inline-flex items-center gap-2 mt-8 font-semibold group-hover:gap-3 transition-all">Saber mais <?= icon('arrow-right', 'size-4') ?></span>
  </a>
</section>

<?php mapa_clinica('Onde fica o consultório'); ?>
<?php cta_section(); ?>
