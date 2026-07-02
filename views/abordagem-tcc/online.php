<?php page_hero('Atendimento', 'online', 'Modalidade', 'Cuidado clínico no conforto da sua casa — onde você estiver.'); prose_open(); ?>
<img src="<?= asset('consultoria.jpg') ?>" alt="Atendimento psicológico online em TCC com Aline Politi" width="764" height="820" loading="lazy" class="w-full rounded-[2rem] ring-1 ring-teal-dark/10">
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
<?php prose_close(); cta_section(); ?>
