<?php page_hero('Atendimento', 'presencial', 'Modalidade', 'Um espaço pensado para sua escuta, com privacidade e conforto.'); prose_open(); ?>
<img src="<?= asset('banner.jpg') ?>" alt="Consultório de Aline Politi em Jaboticabal" width="1600" height="800" loading="lazy" class="w-full rounded-[2rem] ring-1 ring-teal-dark/10">
<h2>Como é a sessão</h2>
<p>As sessões presenciais têm duração média de 50 minutos e acontecem em consultório com ambiente acolhedor, reservado e silencioso. A frequência habitual é semanal e revisada conforme o processo.</p>

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

<h2>Quando indicar</h2>
<ul>
  <li>Para quem prefere a presença física no processo terapêutico</li>
  <li>Quando há necessidade de maior contenção emocional</li>
  <li>Para o trabalho com adolescentes em conjunto com a família</li>
</ul>
<h2>Agendamento</h2>
<p>O primeiro contato pode ser feito pelo WhatsApp ou e-mail para verificarmos disponibilidade.</p>
<?php prose_close(); ?>
<?php bloco_contato_pagina([
    'origem'       => 'presencial',
    'assunto_fixo' => 'Consulta presencial',
    'secao'        => 'Agende sua consulta presencial',
    'titulo'       => 'Envie sua mensagem',
    'subtitulo'    => 'Preencha os campos e eu retorno em breve para combinarmos o melhor horário.',
    'retorno'      => '/atendimento/presencial',
]); ?>
<?php mapa_clinica('Onde fica o consultório'); ?>
<?php cta_section(); ?>
