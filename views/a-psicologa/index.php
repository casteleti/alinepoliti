<?php
/** /a-psicologa — porte de a-psicologa.index.tsx */
$sections = [
    ['title' => 'Trajetória Acadêmica', 'to' => '/a-psicologa/trajetoria', 'desc' => 'Formação em Psicologia, especializações e o caminho até a prática em TCC.'],
    ['title' => 'Especializações', 'to' => '/a-psicologa/especializacoes', 'desc' => 'Áreas de atuação, certificações e públicos atendidos.'],
    ['title' => 'Pesquisas & Artigos', 'to' => '/a-psicologa/pesquisas', 'desc' => 'Estudos, publicações e produções acadêmicas em saúde mental.'],
    ['title' => 'Missão & Valores', 'to' => '/a-psicologa/valores', 'desc' => 'O que orienta cada atendimento: ética, empatia e ciência.'],
];
page_hero('Aline', 'Politi', 'A Psicóloga', 'Uma jornada de estudo, escuta e cuidado dedicada à saúde mental. Conheça quem está por trás do consultório.');
?>
<section class="max-w-6xl mx-auto px-6 lg:px-8 pb-12 grid lg:grid-cols-[1fr_1.2fr] gap-12 items-center">
  <div class="relative">
    <div class="absolute -inset-6 bg-teal-mid/15 blob-1" aria-hidden="true"></div>
    <img src="<?= asset('portrait.webp') ?>" alt="Aline Politi, psicóloga clínica" width="910" height="1000" class="relative w-full h-auto blob-2 ring-1 ring-teal-dark/10" loading="lazy">
  </div>
  <div>
    <p class="text-lg text-ink/75 leading-relaxed">
      Sou Aline Politi, psicóloga clínica (<?= e(SITE_CRP) ?>) com prática em
      <strong>Terapia Cognitivo-Comportamental</strong>. Acredito em uma psicologia que une rigor técnico e
      sensibilidade humana — onde cada pessoa é acolhida em sua singularidade.
    </p>
    <p class="mt-5 text-ink/70 leading-relaxed">
      Minha dedicação a compreender as <strong>relações entre pais e filhos</strong> e o
      <strong>desenvolvimento humano desde a infância</strong> não começou no consultório: nasceu ainda na
      graduação, em 2007. São quase duas décadas estudando como o cuidado, o vínculo e as
      <strong>práticas educativas parentais</strong> moldam quem nos tornamos — uma jornada que passou pela
      graduação na UNAERP e pelo <a href="<?= url('/a-psicologa/pesquisas/mestrado') ?>" class="text-teal-dark font-semibold hover:text-magenta">mestrado na USP</a>.
    </p>
    <p class="mt-5 text-ink/70 leading-relaxed">
      Atendo crianças a partir de 10 anos, adolescentes, adultos e casais em demandas como ansiedade, depressão,
      autoconhecimento e fases de transição. Também ofereço orientação de pais e supervisão para psicólogos.
    </p>
    <p class="mt-5 text-ink/70 leading-relaxed">
      Tenho formação na TCC clássica e nas <a href="<?= url('/abordagem-tcc/terapias-contextuais') ?>" class="text-teal-dark font-semibold hover:text-magenta">terapias contextuais</a>
      — ACT, DBT, Terapia do Esquema e Terapia Focada na Compaixão.
    </p>
  </div>
</section>

<section class="max-w-6xl mx-auto px-6 lg:px-8 py-12 grid md:grid-cols-2 gap-6">
  <?php foreach ($sections as $s): ?>
    <a href="<?= url($s['to']) ?>" class="group p-8 rounded-[2rem] bg-white border border-teal-dark/5 hover:border-magenta transition-all">
      <h2 class="font-heading text-2xl text-teal-dark mb-3"><?= e($s['title']) ?></h2>
      <p class="text-ink/70"><?= e($s['desc']) ?></p>
      <span class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-teal-dark group-hover:text-magenta">Ler mais <?= icon('arrow-right', 'size-4') ?></span>
    </a>
  <?php endforeach; ?>
</section>
<?php faixa('Para cuidar bem, é preciso estar bem. Participo de um grupo de consultoria em DBT que se reúne semanalmente para estudar e aprimorar a prática.', 'Conheça meu trabalho', '/abordagem-tcc/terapias-contextuais', '', 'teal'); ?>

<?php cta_section(); ?>
