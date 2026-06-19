<?php
/** /abordagem-tcc — porte de abordagem-tcc.index.tsx */
$items = [
    ['icon' => 'brain', 'title' => 'O que é a TCC?', 'to' => '/abordagem-tcc/o-que-e', 'desc' => 'Os fundamentos científicos da Terapia Cognitivo-Comportamental.'],
    ['icon' => 'sparkles', 'title' => 'Terapias Contextuais (3ª onda)', 'to' => '/abordagem-tcc/terapias-contextuais', 'desc' => 'ACT, DBT, Esquema e Compaixão — a evolução atual da TCC.'],
    ['icon' => 'users', 'title' => 'Orientação de Pais', 'to' => '/abordagem-tcc/orientacao-de-pais', 'desc' => 'Suporte para os desafios da parentalidade.'],
    ['icon' => 'graduation-cap', 'title' => 'Supervisão para Psicólogos', 'to' => '/abordagem-tcc/supervisao', 'desc' => 'Aprofundamento técnico em TCC.'],
];
page_hero('Terapia Cognitivo-', 'Comportamental', 'Abordagem', 'Uma abordagem científica, breve e colaborativa — onde pensamentos, emoções e comportamentos são compreendidos e ressignificados.');
?>
<section class="max-w-6xl mx-auto px-6 lg:px-8 pb-16 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
  <?php foreach ($items as $idx => $it):
      $offset = $idx === 1 ? 'md:translate-y-6' : ($idx === 3 ? 'lg:translate-y-6' : ''); ?>
    <a href="<?= url($it['to']) ?>" class="group p-8 rounded-[2rem] bg-white border border-teal-dark/5 hover:border-magenta transition-all <?= $offset ?>">
      <div class="size-12 rounded-2xl bg-teal-mid/10 text-teal-mid flex items-center justify-center mb-6 group-hover:bg-magenta/10 group-hover:text-magenta transition-colors"><?= icon($it['icon']) ?></div>
      <h2 class="font-heading text-xl text-teal-dark mb-2"><?= e($it['title']) ?></h2>
      <p class="text-ink/70 text-sm leading-relaxed"><?= e($it['desc']) ?></p>
      <span class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-teal-dark group-hover:text-magenta">Ler mais <?= icon('arrow-right', 'size-4') ?></span>
    </a>
  <?php endforeach; ?>
</section>
<?php bloco_psicologa('Entre o que acontece e o que você sente, existe um espaço — e nele mora a sua escolha.'); ?>
<?php cta_section(); ?>
