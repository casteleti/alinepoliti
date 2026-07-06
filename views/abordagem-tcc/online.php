<?php /** /atendimento/online — layout 2 colunas (imagem à esquerda + texto à direita) */ ?>
<section class="relative overflow-hidden pt-8 pb-6 lg:pt-14">
  <div class="absolute -top-24 -left-24 size-80 bg-teal-mid/10 blob-1 blur-3xl" aria-hidden="true"></div>
  <div class="absolute top-10 right-0 size-72 bg-amber/10 blob-2 blur-3xl" aria-hidden="true"></div>
  <div class="relative max-w-6xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-8 lg:gap-16 items-start">
    <!-- Imagem (esquerda, fixa ao rolar) -->
    <div class="order-2 lg:order-1 lg:sticky lg:top-28">
      <img src="<?= asset('o-que-e-tcc.webp') ?>" alt="Atendimento psicológico online em TCC com Aline Politi"
           width="709" height="820" loading="lazy" class="w-full h-auto max-w-md mx-auto">
    </div>

    <!-- Texto (direita) -->
    <div class="order-1 lg:order-2">
      <span class="inline-block px-4 py-1 rounded-full bg-magenta/10 text-magenta text-xs font-bold tracking-[0.2em] uppercase mb-5">Modalidade</span>
      <h1 class="font-display text-4xl md:text-6xl text-teal-dark leading-[0.95]">
        Atendimento <em class="font-display italic text-magenta">online</em>
      </h1>
      <p class="mt-5 text-lg text-ink/70 leading-relaxed">Cuidado clínico no conforto da sua casa — onde você estiver.</p>

      <div class="mt-6 space-y-4 text-ink/80 text-[17px] leading-[1.8] [&>h2]:font-heading [&>h2]:text-teal-dark [&>h2]:text-2xl [&>h2]:mt-8 [&>h2]:mb-2 [&>ul]:list-disc [&>ul]:pl-6 [&>ul]:space-y-2 [&_strong]:text-teal-dark">
        <h2>Como funciona</h2>
        <p>As sessões são realizadas por videochamada, em plataforma segura e com toda a confidencialidade prevista no Código de Ética do Psicólogo (Resolução CFP 11/2018).</p>

        <div class="not-prose my-8 rounded-2xl bg-white ring-1 ring-teal-dark/10 shadow-sm shadow-teal-dark/5 p-6 sm:p-8">
          <h2 class="font-heading text-2xl text-teal-dark mb-5">Perfis que atendo</h2>
          <ul class="grid sm:grid-cols-2 gap-x-8 gap-y-3.5">
            <?php foreach (['Crianças a partir de 10 anos', 'Jovens e adolescentes', 'Adultos e idosos', 'Orientação de pais', 'Supervisão de psicólogos'] as $perfil): ?>
              <li class="flex items-center gap-3 text-ink/80">
                <span class="shrink-0 size-6 rounded-full bg-teal-mid/15 text-teal-mid flex items-center justify-center" aria-hidden="true">
                  <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                </span>
                <?= e($perfil) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <h2>Vantagens</h2>
        <ul>
          <li>Flexibilidade de horário e localização</li>
          <li>Atendimento para brasileiros no Brasil e no exterior</li>
          <li>Continuidade do processo mesmo em viagens ou mudanças</li>
        </ul>
        <h2>O que você precisa</h2>
        <ul>
          <li>Conexão estável com a internet</li>
          <li>Um ambiente silencioso e reservado</li>
          <li>Fones de ouvido para mais privacidade</li>
        </ul>
      </div>
    </div>
  </div>
</section>
<?php bloco_contato_pagina([
    'origem'       => 'online',
    'assunto_fixo' => 'Consulta online',
    'secao'        => 'Agende sua consulta online',
    'titulo'       => 'Envie sua mensagem',
    'subtitulo'    => 'Preencha os campos e eu retorno em breve pelo canal que você preferir.',
    'retorno'      => '/atendimento/online',
]); ?>
<?php cta_section(); ?>
