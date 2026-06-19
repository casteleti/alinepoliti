<?php /** /abordagem-tcc/orientacao-de-pais — layout 2 colunas (ilustração PNG + texto) */ ?>
<section class="relative overflow-hidden pt-8 pb-6 lg:pt-14">
  <div class="absolute -top-24 -right-24 size-80 bg-amber/10 blob-2 blur-3xl" aria-hidden="true"></div>
  <div class="absolute bottom-0 left-0 size-72 bg-teal-mid/10 blob-1 blur-3xl" aria-hidden="true"></div>
  <div class="relative max-w-6xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-8 lg:gap-16 items-center">
    <!-- Ilustração (esquerda no desktop) -->
    <div class="order-2 lg:order-1">
      <img src="<?= asset('orientacao-pais.png') ?>" alt="Orientação de pais com base na TCC — Aline Politi"
           width="800" height="800" class="w-full h-auto max-w-md mx-auto">
    </div>
    <!-- Texto (direita no desktop) -->
    <div class="order-1 lg:order-2">
      <span class="inline-block px-4 py-1 rounded-full bg-magenta/10 text-magenta text-xs font-bold tracking-[0.2em] uppercase mb-5">Serviço</span>
      <h1 class="font-display text-4xl md:text-6xl text-teal-dark leading-[0.95]">
        Orientação de <em class="font-display italic text-magenta">pais</em>
      </h1>
      <p class="mt-5 text-lg text-ink/70 leading-relaxed max-w-xl">
        Suporte para os desafios cotidianos da parentalidade, com técnicas baseadas em evidências.
      </p>
      <div class="mt-8 space-y-4 text-ink/80 leading-relaxed [&>h2]:font-heading [&>h2]:text-teal-dark [&>h2]:text-xl [&>h2]:mt-6 [&>h2]:mb-2 [&>ul]:list-disc [&>ul]:pl-5 [&>ul]:space-y-2 [&_strong]:text-teal-dark">
        <h2>Para quem</h2>
        <p>Pais e responsáveis que desejam ferramentas práticas para lidar com o comportamento dos filhos, fortalecer vínculos e construir uma comunicação mais empática.</p>
        <h2>O que trabalhamos</h2>
        <ul>
          <li>Manejo de birras, crises e desafios de comportamento</li>
          <li>Comunicação assertiva e validação emocional</li>
          <li>Estabelecimento de rotinas e limites saudáveis</li>
          <li>Apoio em diagnósticos como TDAH, TEA e ansiedade infantil</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<?php cta_section(); ?>
