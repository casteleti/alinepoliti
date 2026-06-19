<?php /** /abordagem-tcc/o-que-e — layout 2 colunas (ilustração + texto) */ ?>
<section class="relative overflow-hidden pt-8 pb-6 lg:pt-14">
  <div class="absolute -top-24 -left-24 size-80 bg-teal-mid/10 blob-1 blur-3xl" aria-hidden="true"></div>
  <div class="absolute top-10 right-0 size-72 bg-amber/10 blob-2 blur-3xl" aria-hidden="true"></div>
  <div class="relative max-w-6xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-8 lg:gap-16 items-start">
    <!-- Ilustração (esquerda, fixa ao rolar) -->
    <div class="order-2 lg:order-1 lg:sticky lg:top-28">
      <img src="<?= asset('o-que-e-tcc.png') ?>" alt="O que é a Terapia Cognitivo-Comportamental (TCC) — Aline Politi"
           width="709" height="820" class="w-full h-auto max-w-md mx-auto">
    </div>

    <!-- Texto (direita) -->
    <div class="order-1 lg:order-2">
      <span class="inline-block px-4 py-1 rounded-full bg-magenta/10 text-magenta text-xs font-bold tracking-[0.2em] uppercase mb-5">Abordagem</span>
      <h1 class="font-display text-4xl md:text-6xl text-teal-dark leading-[0.95]">
        O que é a <em class="font-display italic text-magenta">TCC</em>
      </h1>
      <div class="mt-6 space-y-4 text-ink/80 text-[17px] leading-[1.8] [&>h2]:font-heading [&>h2]:text-teal-dark [&>h2]:text-2xl [&>h2]:mt-8 [&>h2]:mb-2 [&>ul]:list-disc [&>ul]:pl-6 [&>ul]:space-y-2 [&_strong]:text-teal-dark">
        <p>A <strong>Terapia Cognitivo-Comportamental (TCC)</strong> é uma abordagem psicológica estruturada, breve e baseada em evidências científicas. Parte do princípio de que nossos pensamentos, emoções e comportamentos estão profundamente interligados.</p>
        <h2>Como funciona</h2>
        <p>Em conjunto, mapeamos pensamentos automáticos, identificamos crenças centrais e desenvolvemos estratégias práticas para reorganizar padrões que geram sofrimento. O foco é colaborativo — terapeuta e paciente trabalham como uma equipe.</p>
        <h2>Duração do processo</h2>
        <p>A TCC costuma ser uma terapia de médio prazo. A duração depende da demanda, dos objetivos terapêuticos e do engajamento no processo, sendo revisada periodicamente.</p>
        <h2>Benefícios clínicos</h2>
        <ul>
          <li>Eficácia comprovada para ansiedade, depressão e fobias</li>
          <li>Ferramentas práticas para o dia a dia</li>
          <li>Autonomia: você aprende a se cuidar</li>
          <li>Resultados objetivos e mensuráveis</li>
        </ul>
        <h2>A TCC foi além: a DBT</h2>
        <p>A ciência da TCC não parou: surgiram as terapias contextuais (a chamada 3ª onda). Uma das mais importantes é a <strong>DBT (Terapia Comportamental Dialética)</strong>, criada por Marsha Linehan, que une <strong>aceitação e mudança</strong> e ensina habilidades de <strong>regulação emocional</strong> para lidar com emoções intensas. Integro essa e outras abordagens à minha prática — conheça as <a href="<?= url('/abordagem-tcc/terapias-contextuais') ?>" class="text-teal-dark font-semibold hover:text-magenta">terapias contextuais (3ª onda)</a>.</p>
      </div>
    </div>
  </div>
</section>
<?php cta_section(); ?>
