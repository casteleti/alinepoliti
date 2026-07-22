<?php
/**
 * /supervisao-clinica-online — página satélite de Supervisão (fora do menu).
 * Cluster de busca: supervisão online para psicólogos · supervisão clínica online.
 * Fontes: doc "Supervisão para Psicólogos" (Aline Politi), Resolução CFP nº 9/2024, Código de Ética CFP.
 */
$faq = [
    ['q' => 'Como funciona a supervisão clínica online?',
     'a' => 'Os encontros acontecem por videochamada, em dia e horário combinados, no formato individual ou em pequenos grupos. Cada encontro costuma começar pela definição de prioridades, avança para a análise do material clínico apresentado pelo psicólogo e termina com um plano de estudo ou de aplicação prática, revisado na sessão seguinte.'],
    ['q' => 'A supervisão online é permitida pelo Conselho Federal de Psicologia?',
     'a' => 'Sim. O exercício profissional da Psicologia mediado por tecnologias digitais é regulamentado pela Resolução CFP nº 9/2024. O formato online exige os mesmos fundamentos éticos do presencial, com cuidados adicionais de privacidade, armazenamento e comunicação.'],
    ['q' => 'Psicólogos de qualquer cidade do Brasil podem participar?',
     'a' => 'Podem. A modalidade online foi pensada justamente para ampliar o acesso de psicólogos de diferentes cidades e regiões, sem depender de deslocamento até Jaboticabal-SP, onde acontece o formato presencial.'],
    ['q' => 'O que eu preciso para participar de um encontro online?',
     'a' => 'Um local reservado, conexão estável e um dispositivo com áudio e vídeo adequados. Do lado clínico, ajuda muito chegar com o caso organizado: demanda, dados relevantes, hipóteses em construção e a dúvida principal que você quer trabalhar.'],
    ['q' => 'Como fica o sigilo do meu paciente na supervisão online?',
     'a' => 'O Código de Ética Profissional do Psicólogo determina a proteção da intimidade das pessoas atendidas. Na supervisão, compartilha-se apenas a informação necessária para a discussão clínica, preferencialmente sem dados que permitam identificar o paciente. Gravações e documentos clínicos não devem ser apresentados sem base ética, técnica e jurídica adequada.'],
    ['q' => 'Supervisão online substitui a minha responsabilidade pelo caso?',
     'a' => 'Não. A supervisão contribui com reflexão técnica e ética, mas o psicólogo permanece integralmente responsável pelo atendimento, pelos registros, pelo manejo de riscos e pelos encaminhamentos. O supervisor não assume o caso nem substitui o Conselho Regional de Psicologia ou assessoria jurídica.'],
    ['q' => 'Qual é a frequência e a duração dos encontros online?',
     'a' => 'Periodicidade e duração são combinadas conforme a rotina e os objetivos de formação de cada profissional. No primeiro contato, define-se também a forma de apresentação dos casos e os limites de contato entre os encontros.'],
    ['q' => 'O formato em grupo funciona bem no online?',
     'a' => 'Pequenos grupos online podem ampliar o repertório pela escuta de diferentes hipóteses e estilos clínicos, desde que todos os participantes assumam compromisso rigoroso com a confidencialidade. Para quem prefere atenção concentrada nas próprias demandas, o formato individual segue disponível.'],
];
page_hero('Supervisão clínica', 'online', 'Para profissionais', 'Supervisão em TCC por videochamada para psicólogos de todo o Brasil: discussão de casos, ética digital e desenvolvimento profissional — individual ou em pequenos grupos.');
?>
<article class="max-w-3xl mx-auto px-6 lg:px-8 pb-4">
  <div class="text-ink/80 text-[17px] leading-[1.8] space-y-5 [&_strong]:text-teal-dark [&_a:not(.btn)]:text-magenta [&_a:not(.btn)]:font-semibold">

    <p>A <strong>supervisão clínica online</strong> com Aline Politi é voltada a psicólogos que desejam aprofundar a prática em Terapia Cognitivo-Comportamental com organização, segurança técnica e responsabilidade ética — sem depender da distância física. Aline é Especialista em Proficiência em TCC pelo CTC VEDA (São Paulo), especialista em Terapia Cognitivo-Comportamental pela FAMERP e mestre em Psicologia pela FFCLRP-USP. Os encontros acontecem por videochamada, no formato individual ou em pequenos grupos, e também podem ocorrer presencialmente em Jaboticabal-SP para quem prefere o consultório.</p>

    <p>A <strong>supervisão online para psicólogos</strong> amplia o acesso de profissionais de diferentes cidades e regiões do Brasil. Quem atende em consultório próprio, em clínica ou em serviço público muitas vezes não encontra na própria cidade um supervisor com formação específica em TCC — e é exatamente essa barreira que o formato remoto remove, preservando a continuidade do processo mesmo em rotinas cheias ou em mudanças de agenda.</p>

    <p class="font-display italic text-teal-mid text-center text-2xl md:text-3xl leading-snug !my-10">A distância deixou de ser barreira para estudar os próprios casos com profundidade.</p>

    <!-- IMG-SLOT 1 · aguardando imagem (ver controle-imagens.md) -->
    <!-- <div class="rounded-2xl border-2 border-dashed border-teal-mid/40 bg-teal-mid/5 aspect-[16/9] flex items-center justify-center text-teal-mid text-sm font-semibold text-center px-6 !my-8">Imagem 1 — sugestão: psicóloga em videochamada de supervisão, ambiente de consultório</div> -->

    <p>Cada encontro de supervisão online é um encontro clínico, não uma conversa genérica sobre dificuldades profissionais. A estrutura costuma seguir três movimentos: definição de prioridades no início, análise do material clínico no centro e, ao final, um plano de estudo ou de aplicação prática que será revisitado no encontro seguinte. Essa organização — alinhada ao que o Beck Institute descreve para a supervisão em TCC — protege o foco e permite acompanhar o desenvolvimento do supervisionando ao longo do tempo, sem transformar o processo em atividade rígida.</p>

    <p>O formato remoto pede um <strong>setting profissional</strong> tão cuidadoso quanto o presencial: um local reservado, conexão estável, áudio e vídeo adequados e redução de interrupções. Do lado do supervisionando, o encontro rende mais quando o caso chega organizado — demanda, dados relevantes, hipóteses em construção e a dúvida principal. A qualidade da supervisão clínica não está na tecnologia, e sim no que a conversa produz: perguntas melhores, hipóteses mais claras e decisões que o psicólogo consegue justificar.</p>

    <p class="text-center !my-9">
      <a href="<?= e(whatsapp_url('Olá, Aline! Tenho interesse na supervisão clínica online e gostaria de tirar algumas dúvidas sobre como funciona.')) ?>" target="_blank" rel="noopener" class="btn inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-teal-dark text-cream font-semibold hover:bg-teal-mid transition-colors">Tirar dúvidas sobre a supervisão online <?= icon('arrow-right', 'size-4') ?></a>
    </p>

    <p>Ética e sigilo são fundamentos inegociáveis. O Código de Ética Profissional do Psicólogo determina a proteção da intimidade das pessoas atendidas, e o uso de tecnologias digitais exige cuidados adicionais com privacidade, armazenamento e comunicação — hoje regulamentados pela <strong>Resolução CFP nº 9/2024</strong>. Ao levar um caso para a supervisão online, o psicólogo compartilha apenas as informações necessárias, preferencialmente sem dados que identifiquem o paciente. Gravações, documentos ou mensagens clínicas não são apresentados sem base ética, técnica e jurídica adequada.</p>

    <p>Outro pilar é a <strong>aliança de supervisão</strong>. Edward S. Bordin propôs um modelo baseado em objetivos, tarefas e vínculo: o aprendizado não depende apenas do conhecimento do supervisor, mas da qualidade da colaboração estabelecida. No formato online, isso significa combinar com clareza quais competências serão desenvolvidas, como os casos serão apresentados e como será construído um ambiente seguro para dúvidas, erros e feedback — revisando expectativas e progresso periodicamente.</p>

    <p class="font-display italic text-teal-mid text-center text-2xl md:text-3xl leading-snug !my-10">Supervisão não é fiscalização: é um espaço protegido para pensar melhor sobre cada caso.</p>

    <p>Também vale nomear o que a supervisão online <strong>não é</strong>: não é psicoterapia pessoal, não é curso teórico, não é consultoria empresarial. O foco é o trabalho clínico — avaliação, formulação, objetivos terapêuticos, estrutura de sessão, escolha de estratégias e reflexão sobre impasses. O supervisor não assume o atendimento nem substitui a autonomia e a responsabilidade profissional do supervisionando; o que ele oferece é um processo contínuo de estudo, prática, feedback e responsabilidade.</p>

    <!-- IMG-SLOT 2 · aguardando imagem (ver controle-imagens.md) -->
    <!-- <div class="rounded-2xl border-2 border-dashed border-teal-mid/40 bg-teal-mid/5 aspect-[16/9] flex items-center justify-center text-teal-mid text-sm font-semibold text-center px-6 !my-8">Imagem 2 — sugestão: anotações/formulação de caso ao lado do notebook (detalhe de mesa)</div> -->

    <p>No formato em <strong>pequenos grupos online</strong>, a escuta de diferentes hipóteses e estilos clínicos amplia o repertório de todos — desde que exista compromisso rigoroso com a confidencialidade entre os participantes. Já a modalidade individual concentra a atenção nas necessidades de um único profissional. Ambas exigem os mesmos combinados: periodicidade, duração, forma de apresentação dos casos e limites de contato entre os encontros.</p>

    <p>Para quem deseja crescer no consultório, a supervisão pode fortalecer a organização clínica, a comunicação de limites, a segurança para conduzir sessões e a clareza sobre o próprio campo de atuação. Esses ganhos podem contribuir indiretamente para a carreira — mas não constituem promessa de faturamento, agenda cheia ou captação de pacientes. A qualidade do trabalho permanece ligada a formação, ética, estudo e contexto profissional de cada um.</p>

    <p>Para começar, o primeiro contato costuma apresentar o momento profissional, a formação em TCC, o público atendido, os principais desafios e o objetivo buscado. Essa conversa inicial serve para verificar se a proposta corresponde à necessidade — e se o formato online, individual ou em pequeno grupo, é o mais viável para o seu momento.</p>

  </div>

  <?php faixa(
      'Me conte sobre o seu momento e a sua atuação profissional. Essa é a melhor forma de avaliarmos juntas(os) se a supervisão online faz sentido para você.',
      'Conversar com a Aline no WhatsApp',
      whatsapp_url('Olá, Aline! Sou psicólogo(a) e quero conhecer melhor a supervisão clínica online. Posso te contar sobre o meu momento profissional?'),
      'Aline Politi · CRP 06/113904',
      'cream'
  ); ?>

  <!-- FAQ -->
  <section class="mt-4">
    <h2 class="font-heading text-3xl text-teal-dark mb-6">Perguntas frequentes sobre supervisão online</h2>
    <div class="space-y-3">
      <?php foreach ($faq as $item): ?>
        <details class="group rounded-2xl bg-white border border-teal-dark/10 p-5">
          <summary class="flex items-center justify-between gap-4 cursor-pointer font-heading text-lg text-teal-dark list-none">
            <?= e($item['q']) ?>
            <span class="text-magenta transition-transform group-open:rotate-45 text-2xl leading-none">+</span>
          </summary>
          <p class="mt-3 text-ink/75 leading-relaxed"><?= e($item['a']) ?></p>
        </details>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Resumo (formato amigável a assistentes de IA) -->
  <div class="mt-12 rounded-2xl bg-cream border border-teal-dark/10 p-6">
    <p class="text-xs font-bold uppercase tracking-[0.2em] text-magenta mb-3">Resumo desta página</p>
    <p class="text-ink/80 mb-3"><strong>Supervisão clínica online</strong> é o acompanhamento técnico, por videochamada, de psicólogos que desejam aprofundar a prática em Terapia Cognitivo-Comportamental, oferecido por Aline Politi (CRP 06/113904), psicóloga clínica em Jaboticabal-SP.</p>
    <ul class="space-y-2 text-ink/80">
      <li class="flex gap-2.5"><span class="text-teal-mid mt-1">•</span><span>Formato: videochamada, individual ou em pequenos grupos; também há opção presencial em Jaboticabal-SP.</span></li>
      <li class="flex gap-2.5"><span class="text-teal-mid mt-1">•</span><span>Público: psicólogos de qualquer cidade do Brasil, de recém-formados a clínicos experientes.</span></li>
      <li class="flex gap-2.5"><span class="text-teal-mid mt-1">•</span><span>Conteúdo: discussão de casos, formulação, planejamento de sessão, ética e orientação de estudo.</span></li>
      <li class="flex gap-2.5"><span class="text-teal-mid mt-1">•</span><span>Base normativa: Código de Ética Profissional do Psicólogo e Resolução CFP nº 9/2024 (prática mediada por tecnologia).</span></li>
      <li class="flex gap-2.5"><span class="text-teal-mid mt-1">•</span><span>Credenciais da supervisora: Proficiência em TCC (CTC VEDA), especialização em TCC (FAMERP), mestrado (FFCLRP-USP).</span></li>
      <li class="flex gap-2.5"><span class="text-teal-mid mt-1">•</span><span>Contato: WhatsApp (16) 99604-4043 ou formulário em alinepoliti.com.br/contato.</span></li>
    </ul>
  </div>

  <!-- Referências -->
  <div class="mt-10 pt-6 border-t border-teal-dark/10">
    <p class="text-xs font-bold uppercase tracking-[0.2em] text-magenta mb-3">Referências consultadas</p>
    <ul class="space-y-1.5 text-sm text-ink/60">
      <li>Conselho Federal de Psicologia — Código de Ética Profissional do Psicólogo.</li>
      <li>Conselho Federal de Psicologia — Resolução CFP nº 9/2024 (exercício profissional mediado por Tecnologias Digitais da Informação e da Comunicação).</li>
      <li>Bordin, E. S. — A Working Alliance Based Model of Supervision.</li>
      <li>Beck Institute for Cognitive Behavior Therapy — Individual Supervision.</li>
      <li>Aline Politi — Supervisão para Psicólogos e Trajetória Acadêmica (páginas institucionais).</li>
    </ul>
  </div>

  <p class="mt-10"><a href="<?= url('/abordagem-tcc/supervisao') ?>" class="inline-flex items-center gap-2 text-teal-dark font-semibold hover:text-magenta"><?= icon('arrow-right', 'size-4 rotate-180') ?> Voltar para Supervisão para Psicólogos</a></p>
</article>

<script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(static fn($f) => [
        '@type' => 'Question',
        'name' => $f['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
    ], $faq),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>

<?php cta_section(); ?>
