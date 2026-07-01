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
          <li>Discussão, análise de casos e raciocínio técnico-científico de casos clínicos</li>
          <li>Aprofundamento em protocolos baseados em evidências</li>
          <li>Manejo de ansiedade, depressão e transtornos relacionados</li>
          <li>Orientação de estudo e de leituras</li>
          <li>Orientação ética e técnica conforme o CFP</li>
        </ul>
        <h2>Formatos</h2>
        <div class="grid sm:grid-cols-2 gap-4">
          <div class="flex items-start gap-3 p-4 rounded-2xl bg-white ring-1 ring-teal-dark/10">
            <span class="shrink-0 size-10 rounded-xl bg-teal-mid/10 text-teal-mid flex items-center justify-center" aria-hidden="true">
              <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </span>
            <div>
              <p class="font-heading text-teal-dark text-base"><strong>Individual</strong></p>
              <p class="text-sm text-ink/70 mt-1 leading-relaxed">Atenção exclusiva ao seu momento profissional, com foco nas suas demandas e no aprofundamento do seu raciocínio clínico.</p>
            </div>
          </div>
          <div class="flex items-start gap-3 p-4 rounded-2xl bg-white ring-1 ring-teal-dark/10">
            <span class="shrink-0 size-10 rounded-xl bg-magenta/10 text-magenta flex items-center justify-center" aria-hidden="true">
              <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </span>
            <div>
              <p class="font-heading text-teal-dark text-base"><strong>Pequenos grupos</strong></p>
              <p class="text-sm text-ink/70 mt-1 leading-relaxed">A troca entre colegas amplia o repertório e enriquece a discussão de casos, num espaço seguro de aprendizado coletivo.</p>
            </div>
          </div>
        </div>
        <p>Os encontros acontecem <strong>online</strong> ou <strong>presencialmente em Jaboticabal-SP</strong>, com periodicidade e duração combinadas de acordo com a sua rotina e os seus objetivos de formação.</p>
        <a href="<?= e(whatsapp_url('Olá, Aline! Tenho interesse em supervisão clínica. Gostaria de contar sobre o meu momento e a minha atuação profissional.')) ?>" target="_blank" rel="noopener"
           class="group not-prose flex items-start gap-4 p-5 rounded-2xl bg-teal-dark text-cream ring-1 ring-teal-dark/10 shadow-lg shadow-teal-dark/15 hover:bg-teal-mid transition-colors">
          <span class="shrink-0 size-11 rounded-xl bg-cream/15 flex items-center justify-center" aria-hidden="true"><?= icon('message-circle', 'size-5') ?></span>
          <span class="leading-relaxed">Me mande uma mensagem com a sua demanda, contando sobre o seu momento e a sua atuação profissional. Será a melhor forma de tirarmos as suas dúvidas.
            <span class="mt-2 inline-flex items-center gap-1.5 font-semibold">Conversar no WhatsApp <?= icon('arrow-right', 'size-4 group-hover:translate-x-0.5 transition-transform') ?></span>
          </span>
        </a>
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
