<?php
/** Home — porte fiel de src/routes/index.tsx */
$servicos = [
    ['icon' => 'heart-handshake', 'bg' => 'bg-teal-mid/10', 'text' => 'text-teal-mid', 'hover' => 'hover:border-teal-mid',
     'title' => 'Atendimento Clínico', 'desc' => 'Psicoterapia individual, familiar e de casal.',
     'items' => ['Crianças (a partir de 10 anos), adolescentes e adultos', 'Abordagem TCC e contextuais', 'Plano terapêutico personalizado'], 'to' => '/atendimento/presencial'],
    ['icon' => 'users', 'bg' => 'bg-magenta/10', 'text' => 'text-magenta', 'hover' => 'hover:border-magenta',
     'title' => 'Orientação de Pais', 'desc' => 'Suporte estratégico para os desafios do desenvolvimento infantil e da dinâmica familiar.',
     'items' => ['Manejo de comportamento', 'Comunicação assertiva', 'Fortalecimento de vínculos'], 'to' => '/abordagem-tcc/orientacao-de-pais'],
    ['icon' => 'graduation-cap', 'bg' => 'bg-amber/15', 'text' => 'text-amber', 'hover' => 'hover:border-amber',
     'title' => 'Supervisão Clínica', 'desc' => 'Para psicólogos que buscam desenvolvimento e desejam aprofundar a prática em TCC.',
     'items' => ['Discussão de casos', 'Aperfeiçoamento técnico', 'Ética e manejo clínico'], 'to' => '/abordagem-tcc/supervisao'],
];
$etapas = [
    ['n' => '01', 't' => 'Identificação de padrões', 'd' => 'Mapeamos os pensamentos automáticos que geram desconforto emocional e comportamentos disfuncionais.'],
    ['n' => '02', 't' => 'Reestruturação cognitiva', 'd' => 'Flexibilizamos crenças rígidas e construímos perspectivas mais realistas e saudáveis.'],
    ['n' => '03', 't' => 'Resolução de problemas', 'd' => 'Conceitualizar a história de vida e olhar para o aqui e agora, desenvolvendo ferramentas práticas para os desafios atuais da sua vida.'],
    ['n' => '04', 't' => 'Manutenção e autonomia', 'd' => 'Construímos juntos um repertório que você leva para a vida — terapia que ensina a se cuidar.'],
];
$modalidades = [
    ['t' => 'Atendimento Presencial', 'd' => 'Um espaço acolhedor e reservado para sua escuta.', 'to' => '/atendimento/presencial', 'bg' => 'bg-teal-dark'],
    ['t' => 'Atendimento Online', 'd' => 'A mesma qualidade clínica, no conforto da sua casa.', 'to' => '/atendimento/online', 'bg' => 'bg-magenta'],
];
?>
<!-- HERO -->
<section class="relative overflow-hidden">
  <div class="absolute -top-32 -left-24 size-96 bg-teal-mid/15 blob-1 blur-3xl" aria-hidden="true"></div>
  <div class="absolute -bottom-20 -right-10 size-96 bg-amber/15 blob-2 blur-3xl" aria-hidden="true"></div>
  <div class="absolute top-1/3 left-1/3 size-72 bg-magenta/10 blob-3 blur-3xl" aria-hidden="true"></div>

  <div class="relative max-w-7xl mx-auto px-6 lg:px-8 pt-16 lg:pt-24 pb-24 grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
    <div>
      <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-magenta/10 text-magenta text-xs font-bold tracking-[0.2em] uppercase mb-7">
        <span class="size-1.5 rounded-full bg-magenta"></span> Psicologia · <?= e(SITE_CRP) ?>
      </span>
      <h1 class="font-display text-[clamp(3rem,7vw,6.5rem)] text-teal-dark leading-[0.92]">
        Equilíbrio
        <span class="block font-heading not-italic text-[clamp(2rem,4.5vw,4rem)] text-magenta mt-3">
          Cognitivo, Emocional &amp; <em class="font-display italic">Comportamental</em>
        </span>
      </h1>
      <p class="mt-8 text-lg text-ink/70 max-w-lg leading-relaxed">
        Transforme sua forma de sentir através da ciência do pensamento. Atendimento especializado em
        <strong class="text-teal-dark"> Terapia Cognitivo-Comportamental</strong> para crianças (a partir de 10 anos), adolescentes e adultos — presencial e online.
      </p>
      <div class="mt-10 flex flex-wrap gap-3">
        <a href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener"
           class="px-7 py-4 bg-teal-dark text-cream rounded-full font-medium hover:bg-teal-mid transition-all shadow-xl shadow-teal-dark/20 inline-flex items-center gap-2">
          Agendar consulta <?= icon('arrow-right', 'size-4') ?>
        </a>
        <a href="<?= url('/abordagem-tcc') ?>"
           class="px-7 py-4 border border-teal-dark/20 text-teal-dark rounded-full font-medium hover:bg-white transition-all">Conheça a TCC</a>
      </div>
    </div>

    <div class="relative">
      <div class="absolute -inset-6 bg-gradient-to-br from-teal-mid/25 via-cream to-amber/20 blob-1 blur-2xl" aria-hidden="true"></div>
      <div class="relative aspect-square w-full max-w-[520px] mx-auto blob-1 overflow-hidden ring-1 ring-teal-dark/10 bg-teal-dark/5">
        <img src="<?= asset('consultoria.webp') ?>" alt="Aline Politi, psicóloga clínica especialista em TCC" width="764" height="820" fetchpriority="high" class="w-full h-full object-cover">
      </div>
      <div class="absolute -bottom-4 -left-4 lg:-left-10 bg-white px-6 py-5 rounded-2xl shadow-xl shadow-teal-dark/10 ring-1 ring-teal-dark/5 max-w-[270px] rotate-[-3deg]">
        <p class="font-display italic text-teal-dark leading-snug text-xl text-center">“O cuidado que começa no acolhimento.”</p>
        <p class="mt-2.5 font-display italic text-magenta text-base text-center">— Aline Politi</p>
      </div>
    </div>
  </div>
</section>

<!-- SERVIÇOS -->
<section class="bg-white py-24 lg:py-28">
  <div class="max-w-7xl mx-auto px-6 lg:px-8">
    <div class="text-center mb-16">
      <span class="text-xs font-bold tracking-[0.25em] uppercase text-magenta">Como posso ajudar</span>
      <h2 class="font-heading text-4xl md:text-5xl text-teal-dark mt-3">Três caminhos, um mesmo <em class="italic font-display">cuidado</em>.</h2>
      <div class="w-20 h-[3px] bg-amber mx-auto rounded-full mt-6"></div>
    </div>
    <div class="grid md:grid-cols-3 gap-8">
      <?php foreach ($servicos as $s): ?>
        <a href="<?= url($s['to']) ?>" class="group p-10 rounded-[2rem] bg-cream border border-teal-dark/5 <?= $s['hover'] ?> transition-all flex flex-col">
          <div class="size-14 rounded-2xl <?= $s['bg'] ?> <?= $s['text'] ?> flex items-center justify-center mb-8"><?= icon($s['icon'], 'size-6') ?></div>
          <h3 class="font-heading text-2xl text-teal-dark mb-3"><?= e($s['title']) ?></h3>
          <p class="text-ink/70 mb-6"><?= e($s['desc']) ?></p>
          <ul class="space-y-2 text-sm text-teal-dark/75 font-medium mb-8">
            <?php foreach ($s['items'] as $i): ?><li>• <?= e($i) ?></li><?php endforeach; ?>
          </ul>
          <span class="mt-auto inline-flex items-center gap-2 text-sm font-semibold text-teal-dark group-hover:text-magenta transition-colors">Saber mais <?= icon('arrow-right', 'size-4') ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- SOBRE -->
<section class="py-24 lg:py-28 relative overflow-hidden">
  <div class="absolute top-1/2 -translate-y-1/2 -left-32 size-96 bg-teal-mid/10 blob-2 blur-3xl" aria-hidden="true"></div>
  <div class="relative max-w-7xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-16 items-center">
    <div class="relative order-2 lg:order-1">
      <div class="absolute -inset-4 bg-amber/15 blob-2" aria-hidden="true"></div>
      <img src="<?= asset('banner.webp') ?>" alt="Consultório de Aline Politi em Jaboticabal" width="1600" height="800" class="relative w-full h-auto blob-1 ring-1 ring-teal-dark/10" loading="lazy">
    </div>
    <div class="order-1 lg:order-2">
      <span class="text-xs font-bold tracking-[0.25em] uppercase text-magenta">A psicóloga</span>
      <h2 class="font-display italic text-5xl md:text-6xl text-teal-dark mt-3 leading-tight">Um percurso dedicado à <span class="not-italic font-heading text-magenta">saúde mental</span>.</h2>
      <p class="mt-8 text-lg text-ink/75 leading-relaxed">
        Acredito em uma psicologia humanizada e baseada em evidências. Com prática clínica em TCC e terapias contextuais, ofereço
        um espaço seguro onde técnica e empatia se encontram para promover mudanças reais e duradouras.
      </p>
      <div class="mt-8 flex flex-wrap gap-3">
        <?php foreach ([SITE_CRP, 'Especialista em TCC', 'Atendimento humanizado'] as $t): ?>
          <span class="px-4 py-2 rounded-full bg-white text-teal-dark text-sm font-medium ring-1 ring-teal-dark/10"><?= e($t) ?></span>
        <?php endforeach; ?>
      </div>
      <a href="<?= url('/a-psicologa') ?>" class="inline-flex items-center gap-2 mt-10 text-teal-dark font-semibold hover:text-magenta transition-colors">Conheça minha trajetória <?= icon('arrow-right', 'size-4') ?></a>
    </div>
  </div>
</section>

<!-- TCC -->
<section class="py-24 lg:py-28 bg-white relative overflow-hidden">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 grid lg:grid-cols-[1fr_1.2fr] gap-16 items-start">
    <div class="lg:sticky lg:top-32">
      <span class="inline-block py-1.5 px-4 rounded-full bg-magenta/10 text-magenta text-xs font-bold tracking-[0.2em] uppercase mb-6">Baseada em evidências</span>
      <h2 class="font-display italic text-5xl text-teal-dark leading-tight">Como a TCC atua no seu <span class="not-italic font-heading">dia a dia</span>?</h2>
      <p class="mt-6 text-ink/70 leading-relaxed max-w-md">A Terapia Cognitivo-Comportamental conecta pensamentos, emoções e comportamentos — e oferece ferramentas práticas para reestruturá-los.</p>
    </div>
    <div class="space-y-12">
      <?php foreach ($etapas as $b): ?>
        <div class="flex gap-6 group">
          <span class="font-display italic text-5xl text-amber/60 shrink-0 leading-none group-hover:text-magenta transition-colors"><?= e($b['n']) ?></span>
          <div>
            <h3 class="font-heading text-2xl text-teal-dark mb-2"><?= e($b['t']) ?></h3>
            <p class="text-ink/70 leading-relaxed"><?= e($b['d']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- MODALIDADES -->
<section class="py-20">
  <div class="max-w-7xl mx-auto px-6 lg:px-8 grid md:grid-cols-2 gap-6">
    <?php foreach ($modalidades as $m): ?>
      <a href="<?= url($m['to']) ?>" class="<?= $m['bg'] ?> text-cream rounded-[2.5rem] p-10 group relative overflow-hidden">
        <span class="absolute top-6 right-6 opacity-30"><?= icon('sparkles', 'size-6') ?></span>
        <h3 class="font-display italic text-4xl mb-3"><?= e($m['t']) ?></h3>
        <p class="opacity-80 max-w-xs"><?= e($m['d']) ?></p>
        <span class="inline-flex items-center gap-2 mt-8 font-semibold group-hover:gap-3 transition-all">Saber mais <?= icon('arrow-right', 'size-4') ?></span>
      </a>
    <?php endforeach; ?>
  </div>
</section>

<?php mapa_clinica('Atendimento presencial e online'); ?>

<?php bloco_psicologa('Quando eu mudo, o meu mundo se transforma.'); ?>

<?php cta_section(); ?>
