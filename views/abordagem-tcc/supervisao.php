<?php /** /abordagem-tcc/supervisao — layout 2 colunas (texto + ilustração PNG) */ ?>
<section class="relative overflow-hidden pt-8 pb-6 lg:pt-14">
  <div class="absolute -top-24 -left-24 size-80 bg-teal-mid/10 blob-1 blur-3xl" aria-hidden="true"></div>
  <div class="absolute top-10 right-0 size-72 bg-amber/10 blob-2 blur-3xl" aria-hidden="true"></div>
  <div class="relative max-w-6xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-8 lg:gap-16 items-center">
    <!-- Texto (esquerda no desktop) -->
    <div class="order-1">
      <span class="inline-block px-4 py-1 rounded-full bg-magenta/10 text-magenta text-xs font-bold tracking-[0.2em] uppercase mb-5">Para profissionais</span>
      <h1 class="font-display text-4xl md:text-6xl text-teal-dark leading-[0.95]">
        Supervisão <em class="font-display italic text-magenta">clínica</em>
      </h1>
      <p class="mt-5 text-lg text-ink/70 leading-relaxed max-w-xl">
        Aprimoramento técnico para psicólogos que querem aprofundar a prática em TCC.
      </p>
      <div class="mt-8 space-y-4 text-ink/80 leading-relaxed [&>h2]:font-heading [&>h2]:text-teal-dark [&>h2]:text-xl [&>h2]:mt-6 [&>h2]:mb-2 [&>ul]:list-disc [&>ul]:pl-5 [&>ul]:space-y-2 [&_strong]:text-teal-dark">
        <h2>O que oferecemos</h2>
        <ul>
          <li>Discussão estruturada de casos clínicos</li>
          <li>Aprofundamento em protocolos baseados em evidências</li>
          <li>Manejo de ansiedade, depressão e transtornos relacionados</li>
          <li>Orientação ética e técnica conforme o CFP</li>
        </ul>
        <h2>Formatos</h2>
        <p>Supervisão individual ou em pequenos grupos, presencial ou online, com periodicidade combinada.</p>
      </div>
    </div>
    <!-- Ilustração (direita no desktop) -->
    <div class="order-2">
      <img src="<?= asset('supervisao.png') ?>" alt="Supervisão clínica em TCC com Aline Politi"
           width="900" height="900" class="w-full h-auto max-w-md mx-auto">
    </div>
  </div>
</section>
<?php cta_section(); ?>
