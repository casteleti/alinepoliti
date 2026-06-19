<?php
/** /abordagem-tcc/terapias-contextuais — pilar da 3ª onda da TCC (conteúdo embasado). */
$ondas = [
    ['n' => '1ª', 't' => 'Onda comportamental', 'd' => 'Anos 1950–60 (Pavlov, Skinner, Wolpe): foco no comportamento e no condicionamento.'],
    ['n' => '2ª', 't' => 'Onda cognitiva', 'd' => 'Anos 1960–70 (Aaron Beck, Albert Ellis): identificar e reestruturar pensamentos — o núcleo clássico da TCC.'],
    ['n' => '3ª', 't' => 'Ondas contextuais', 'd' => 'Anos 1990+ (ACT, DBT, Esquema, Compaixão): mudar a relação com a experiência, com aceitação, mindfulness e valores.'],
];
$abordagens = [
    ['icon' => 'sparkles', 'nome' => 'ACT — Aceitação e Compromisso', 'autor' => 'Steven C. Hayes',
     'desc' => 'Em vez de lutar contra pensamentos e emoções difíceis, abrimos espaço para eles e agimos na direção dos seus valores — a chamada flexibilidade psicológica.'],
    ['icon' => 'heart-handshake', 'nome' => 'DBT — Comportamental Dialética', 'autor' => 'Marsha Linehan',
     'desc' => 'Une aceitação e mudança. Trabalha habilidades de mindfulness, tolerância ao mal-estar, regulação emocional e efetividade interpessoal.'],
    ['icon' => 'brain', 'nome' => 'Terapia do Esquema', 'autor' => 'Jeffrey Young',
     'desc' => 'Reconhece padrões profundos formados na infância (esquemas) que se repetem na vida adulta — e ajuda a compreendê-los e reescrevê-los.'],
    ['icon' => 'users', 'nome' => 'Terapia Focada na Compaixão', 'autor' => 'Paul Gilbert · Kristin Neff',
     'desc' => 'Cultiva uma relação mais gentil consigo mesmo, equilibrando os sistemas de ameaça, realização e acolhimento que regulam nossas emoções.'],
];
page_hero('Terapias', 'contextuais', 'Abordagem', 'A chamada 3ª onda da TCC. A ciência do cuidado evoluiu — e a minha prática acompanha essa evolução.');
?>
<section class="max-w-5xl mx-auto px-6 lg:px-8 mb-8">
  <img src="<?= asset('tc-banner.jpg') ?>" alt="Formação em terapias contextuais e DBT — Aline Politi" width="1600" height="779" loading="lazy" class="w-full rounded-[2.5rem] ring-1 ring-teal-dark/10">
</section>
<section class="max-w-5xl mx-auto px-6 lg:px-8">
  <p class="text-lg text-ink/75 leading-relaxed max-w-3xl">
    A Terapia Cognitivo-Comportamental não parou nos anos 1960. Ela se desenvolveu em três grandes “ondas”.
    Além da TCC clássica, tenho formação nas <strong>terapias contextuais</strong> — sempre
    dentro do mesmo alicerce: a relação entre <strong>pensamentos, emoções e comportamentos</strong>.
  </p>

  <div class="grid md:grid-cols-3 gap-6 mt-12">
    <?php foreach ($ondas as $o): ?>
      <div class="p-7 rounded-[2rem] bg-white border border-teal-dark/5">
        <span class="font-display italic text-4xl text-amber/70"><?= e($o['n']) ?></span>
        <h2 class="font-heading text-xl text-teal-dark mt-2 mb-2"><?= e($o['t']) ?></h2>
        <p class="text-ink/70 text-sm leading-relaxed"><?= e($o['d']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<?php faixa('A ciência da TCC não parou nos anos 1960. As terapias contextuais ampliam o cuidado com aceitação, mindfulness e compaixão.', 'Tem uma pergunta? Fale comigo', null, '', 'teal'); ?>

<section class="max-w-6xl mx-auto px-6 lg:px-8">
  <div class="text-center mb-12">
    <span class="text-xs font-bold tracking-[0.25em] uppercase text-magenta">Abordagens em que tenho formação</span>
    <h2 class="font-heading text-3xl md:text-4xl text-teal-dark mt-3">Recursos a serviço do seu cuidado</h2>
  </div>
  <div class="grid md:grid-cols-2 gap-6">
    <?php foreach ($abordagens as $a): ?>
      <div class="p-8 rounded-[2rem] bg-cream border border-teal-dark/5 hover:border-magenta transition-all">
        <div class="size-12 rounded-2xl bg-teal-mid/10 text-teal-mid flex items-center justify-center mb-5"><?= icon($a['icon']) ?></div>
        <h3 class="font-heading text-xl text-teal-dark"><?= e($a['nome']) ?></h3>
        <p class="text-xs font-bold uppercase tracking-[0.18em] text-magenta/80 mt-1 mb-3"><?= e($a['autor']) ?></p>
        <p class="text-ink/70 leading-relaxed"><?= e($a['desc']) ?></p>
      </div>
    <?php endforeach; ?>
  </div>
  <p class="text-xs text-ink/45 mt-6 max-w-3xl">
    As terapias contextuais são abordagens da grande família da TCC. Não substituem o trabalho clínico
    individualizado: são recursos escolhidos conforme a necessidade de cada pessoa.
  </p>
</section>

<!-- Grupo de consultoria em DBT -->
<section class="max-w-5xl mx-auto px-6 lg:px-8 mt-16">
  <div class="rounded-[2.5rem] bg-white border border-teal-dark/10 p-10 md:p-12 grid lg:grid-cols-[1.4fr_1fr] gap-10 items-center">
    <div>
      <span class="text-xs font-bold tracking-[0.25em] uppercase text-magenta">Para cuidar bem, é preciso estar bem</span>
      <h2 class="font-heading text-2xl md:text-3xl text-teal-dark mt-3 mb-4">Grupo de consultoria em DBT</h2>
      <p class="text-ink/75 leading-relaxed">
        Participo de um <strong>grupo de consultoria em DBT</strong> que se reúne semanalmente — psicólogos
        atualizados que discutem casos, aprofundam e partilham as melhores práticas baseadas em evidências.
        Na DBT, esse cuidado com o próprio terapeuta é parte do método, criado por Marsha Linehan.
      </p>
      <p class="mt-4 text-ink/70 leading-relaxed">
        Na prática, isso significa <strong>mais qualidade no seu atendimento</strong>: uma profissional que estuda
        continuamente e se cuida para oferecer o melhor.
      </p>
    </div>
    <ul class="space-y-3 text-sm text-teal-dark/80">
      <li class="flex items-center gap-3"><?= icon('users', 'size-5 text-amber shrink-0') ?> Encontros semanais de estudo e discussão</li>
      <li class="flex items-center gap-3"><?= icon('graduation-cap', 'size-5 text-amber shrink-0') ?> Encontros online entre psicólogos de diferentes regiões</li>
      <li class="flex items-center gap-3"><?= icon('sparkles', 'size-5 text-amber shrink-0') ?> Prática fiel ao método e atualizada</li>
    </ul>
  </div>
</section>

<?php bloco_psicologa('Existe uma forma mais leve de conviver consigo mesmo — e ela pode ser aprendida.'); ?>
<?php cta_section(); ?>
