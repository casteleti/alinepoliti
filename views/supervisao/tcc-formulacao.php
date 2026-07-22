<?php
/**
 * /supervisao-em-tcc — página satélite de Supervisão (fora do menu).
 * Cluster de busca: supervisão em TCC · formulação de caso · conceitualização cognitiva · raciocínio clínico.
 * Fontes: doc "Supervisão para Psicólogos" (Aline Politi) — Beck, J. Beck, Padesky, Persons, Clark, Barlow.
 */
$faq = [
    ['q' => 'O que é formulação de caso em TCC?',
     'a' => 'É a organização das informações do caso — diagnóstico, problemas atuais, mecanismos de manutenção, fatores históricos, recursos do paciente e dados de acompanhamento — em hipóteses clínicas que orientam o tratamento. Na supervisão, a formulação é tratada como um mapa provisório, atualizado à medida que surgem novas informações, e não como um rótulo definitivo.'],
    ['q' => 'Qual a diferença entre conceitualização cognitiva e diagnóstico?',
     'a' => 'O diagnóstico classifica um conjunto de sintomas; a conceitualização cognitiva explica como interpretações, crenças, emoções e comportamentos interagem naquela pessoa específica. Dois pacientes com o mesmo diagnóstico podem ter conceitualizações muito diferentes — e é a conceitualização que orienta a escolha das intervenções.'],
    ['q' => 'Como a supervisão em TCC ajuda a escolher a técnica certa?',
     'a' => 'Conectando intervenção, mecanismo de manutenção e objetivo clínico. Em vez de buscar uma técnica para cada sintoma, a supervisão examina por que, quando e como usar determinada estratégia — e ajuda a identificar quando uma técnica adequada não funcionou por questões de timing, aliança, compreensão, motivação ou execução.'],
    ['q' => 'O que é descoberta guiada na prática da supervisão?',
     'a' => 'É a postura, sistematizada por Christine A. Padesky, de usar perguntas bem construídas em vez de respostas prontas. Aplicada à supervisão, ajuda o psicólogo a examinar o que sabe, o que ainda não sabe, quais evidências sustentam sua hipótese e como testar uma alternativa de forma ética — fortalecendo autonomia em vez de dependência do supervisor.'],
    ['q' => 'Seguir um protocolo baseado em evidências não basta?',
     'a' => 'Protocolos oferecem direção, mas não respondem sozinhos a todas as decisões clínicas. A supervisão ajuda a distinguir entre aplicar um protocolo com fidelidade — compreendendo seus mecanismos — e repetir um roteiro mecanicamente. Modelos como os de David M. Clark e o Protocolo Unificado de David H. Barlow são discutidos nessa chave.'],
    ['q' => 'O que devo levar para um encontro de supervisão em TCC?',
     'a' => 'A demanda organizada: dados observados do caso, hipóteses em construção, o que já foi tentado e a dúvida principal. Parte do trabalho da supervisão é justamente aprender a diferenciar dados de inferências e transformar uma narrativa ampla sobre o paciente em questões clínicas específicas e verificáveis.'],
    ['q' => 'Sou de outra abordagem e estou migrando para a TCC. A supervisão serve para mim?',
     'a' => 'Sim. A supervisão pode acompanhar psicólogos que estão migrando para a TCC, revisando fundamentos do modelo cognitivo, estrutura de sessão e formulação de caso, no ritmo adequado ao estágio de cada profissional — sem pressupor domínio prévio da abordagem.'],
    ['q' => 'Como sei se a minha formulação de caso está boa?',
     'a' => 'Perguntas úteis, trabalhadas em supervisão a partir do trabalho de Jacqueline B. Persons: a formulação explica os principais problemas do paciente? Os objetivos derivados dela são mensuráveis? As intervenções escolhidas decorrem das hipóteses formuladas? Se a resposta é não em algum ponto, há trabalho de refinamento a fazer.'],
];
page_hero('Supervisão em TCC:', 'formulação de caso', 'Para profissionais', 'Conceitualização cognitiva, raciocínio clínico e prática baseada em evidências — o eixo técnico da supervisão com Aline Politi.');
?>
<article class="max-w-3xl mx-auto px-6 lg:px-8 pb-4">
  <div class="text-ink/80 text-[17px] leading-[1.8] space-y-5 [&_strong]:text-teal-dark [&_a:not(.btn)]:text-magenta [&_a:not(.btn)]:font-semibold">

    <p>A <strong>supervisão em TCC</strong> com Aline Politi mantém a Terapia Cognitivo-Comportamental como eixo central do trabalho: avaliação, conceitualização cognitiva, definição de objetivos, estrutura de sessão, escolha de estratégias e monitoramento do processo. A proposta não é entregar respostas prontas, mas ajudar o psicólogo a pensar melhor sobre cada caso — identificar lacunas de avaliação, revisar hipóteses e planejar intervenções coerentes com as necessidades da pessoa atendida.</p>

    <p>O ponto de partida é o modelo cognitivo de <strong>Aaron T. Beck</strong>, que propõe examinar como interpretações, crenças, emoções e comportamentos interagem em situações específicas. Na prática da supervisão, isso significa transformar uma narrativa ampla sobre o paciente em hipóteses clínicas organizadas e verificáveis: diferenciar dados observados de inferências, relacionar problemas atuais a padrões de pensamento e comportamento, e construir uma conceitualização que realmente oriente o tratamento.</p>

    <p class="font-display italic text-teal-mid text-center text-2xl md:text-3xl leading-snug !my-10">Formulação de caso não é rótulo definitivo — é um mapa provisório que orienta o tratamento.</p>

    <img src="<?= asset('supervisao-tcc-1.webp') ?>" alt="Supervisão clínica em TCC: psicóloga registrando a formulação de caso durante o atendimento" width="1600" height="900" loading="lazy" class="rounded-2xl ring-1 ring-teal-dark/10 w-full h-auto !my-8">

    <p><strong>Judith S. Beck</strong> sistematizou o ensino contemporâneo da TCC e mostrou que supervisionar exige competências além da boa prática terapêutica. Seguindo os princípios descritos pelo Beck Institute, cada encontro pode incluir avaliação de necessidades, definição colaborativa de objetivos, análise do material clínico e feedback sobre o desempenho — terminando com um plano de estudo ou aplicação. A estrutura protege o foco sem engessar a conversa, e permite acompanhar a evolução do supervisionando ao longo do tempo.</p>

    <p>Outra ferramenta central é a <strong>descoberta guiada</strong>, na tradição de Christine A. Padesky: o supervisor não precisa ocupar o papel de autoridade que sempre fornece a resposta correta. Perguntas bem construídas ajudam o psicólogo a examinar o que sabe, o que ainda não sabe, quais evidências sustentam sua hipótese e como poderia testar uma alternativa. Esse treino — que pode incluir ensaio de perguntas e revisão de diálogos de sessão — fortalece curiosidade, colaboração e precisão, em vez de produzir dependência do supervisor.</p>

    <p class="text-center !my-9">
      <a href="<?= e(whatsapp_url('Olá, Aline! Quero aprofundar minha formulação de caso em TCC e gostaria de saber como funciona a supervisão.')) ?>" target="_blank" rel="noopener" class="btn inline-flex items-center gap-2 px-7 py-3.5 rounded-full bg-teal-dark text-cream font-semibold hover:bg-teal-mid transition-colors">Perguntar sobre a supervisão em TCC <?= icon('arrow-right', 'size-4') ?></a>
    </p>

    <p>Na linha de <strong>Jacqueline B. Persons</strong>, a supervisão trabalha com a TCC guiada pela formulação individualizada: integrar diagnóstico, problemas atuais, mecanismos de manutenção, fatores históricos, recursos do paciente e dados de acompanhamento. O supervisionando pode revisar se sua formulação explica os principais problemas, se os objetivos são mensuráveis e se as intervenções escolhidas realmente derivam das hipóteses formuladas — reduzindo decisões baseadas em improvisação.</p>

    <p>Quando o assunto é <strong>prática baseada em evidências</strong>, entram as contribuições de David M. Clark — modelos cognitivos específicos para pânico, ansiedade social e estresse pós-traumático — e de David H. Barlow, com o Protocolo Unificado transdiagnóstico. Na supervisão, essas referências ajudam a distinguir entre aplicar um protocolo com fidelidade, compreendendo seus mecanismos, e repetir um roteiro sem entender por que ele funciona. Análise funcional e cognitiva dos sintomas, definição de alvos, uso criterioso de exposição e monitoramento de esquivas e comportamentos de segurança fazem parte dessa conversa.</p>

    <p class="font-display italic text-teal-mid text-center text-2xl md:text-3xl leading-snug !my-10">Antes de perguntar qual técnica usar, a supervisão pergunta por quê, quando e como usá-la.</p>

    <p>É comum que uma técnica aparentemente adequada não funcione — e a supervisão examina os motivos possíveis: timing, aliança terapêutica, compreensão do paciente, motivação ou execução. Também é o espaço para reconhecer quando um caso exige avaliação adicional, encaminhamento, trabalho interdisciplinar ou adaptação de estratégias. O objetivo é aproximar a prática cotidiana da literatura científica, preservando a singularidade de cada pessoa atendida.</p>

    <img src="<?= asset('supervisao-tcc-2.webp') ?>" alt="Supervisão clínica online em TCC: psicóloga em videochamada com a supervisora, com caderno de anotações" width="1600" height="949" loading="lazy" class="rounded-2xl ring-1 ring-teal-dark/10 w-full h-auto !my-8">

    <p>O <strong>raciocínio clínico</strong> desenvolvido nesse processo abrange desde a primeira entrevista até a avaliação de resultados: contrato terapêutico, definição da demanda, diagnóstico diferencial, plano de tratamento, psicoeducação, registro de pensamentos, experimentos comportamentais, exposição, prevenção de recaída e encerramento. Aline pode orientar leituras e protocolos, mas a escolha final considera sempre evidências, contexto, preferências, recursos e limites do paciente.</p>

    <p>Para psicólogos que desejam consolidar a TCC como base sólida de atuação — com hipóteses mais claras, intervenções justificáveis e capacidade crescente de avaliar o próprio trabalho —, a supervisão oferece um espaço estruturado de desenvolvimento técnico. Os encontros acontecem online ou presencialmente em Jaboticabal-SP, no formato individual ou em pequenos grupos.</p>

  </div>

  <?php faixa(
      'Traga um caso que está te desafiando. A conversa começa pela sua dúvida real, não por teoria solta.',
      'Enviar minha dúvida no WhatsApp',
      whatsapp_url('Olá, Aline! Tenho um caso em TCC que gostaria de discutir em supervisão. Posso te contar meu momento profissional?'),
      'Aline Politi · CRP 06/113904',
      'cream'
  ); ?>

  <!-- FAQ -->
  <section class="mt-4">
    <h2 class="font-heading text-3xl text-teal-dark mb-6">Perguntas frequentes sobre supervisão em TCC</h2>
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
    <p class="text-ink/80 mb-3"><strong>Supervisão em TCC</strong> é o acompanhamento técnico centrado em formulação de caso, conceitualização cognitiva e raciocínio clínico, conduzido por Aline Politi (CRP 06/113904), Especialista em Proficiência em TCC pelo CTC VEDA.</p>
    <ul class="space-y-2 text-ink/80">
      <li class="flex gap-2.5"><span class="text-teal-mid mt-1">•</span><span>Eixo técnico: modelo cognitivo de Beck, estrutura de encontros (Beck Institute), descoberta guiada (Padesky) e formulação individualizada (Persons).</span></li>
      <li class="flex gap-2.5"><span class="text-teal-mid mt-1">•</span><span>Prática baseada em evidências: protocolos de Clark e Barlow discutidos com fidelidade e critério, não como roteiro mecânico.</span></li>
      <li class="flex gap-2.5"><span class="text-teal-mid mt-1">•</span><span>Escopo: da primeira entrevista ao encerramento — avaliação, plano de tratamento, experimentos comportamentais, exposição e prevenção de recaída.</span></li>
      <li class="flex gap-2.5"><span class="text-teal-mid mt-1">•</span><span>Formatos: online (todo o Brasil) ou presencial em Jaboticabal-SP; individual ou pequenos grupos.</span></li>
      <li class="flex gap-2.5"><span class="text-teal-mid mt-1">•</span><span>Contato: WhatsApp (16) 99604-4043 ou alinepoliti.com.br/contato.</span></li>
    </ul>
  </div>

  <!-- Referências -->
  <div class="mt-10 pt-6 border-t border-teal-dark/10">
    <p class="text-xs font-bold uppercase tracking-[0.2em] text-magenta mb-3">Referências consultadas</p>
    <ul class="space-y-1.5 text-sm text-ink/60">
      <li>Beck Institute for Cognitive Behavior Therapy — From CBT Therapist to CBT Supervisor.</li>
      <li>Christine A. Padesky — Socratic Questioning (descoberta guiada e empirismo colaborativo).</li>
      <li>Jacqueline B. Persons — Developing and Using a Case Formulation.</li>
      <li>University of Oxford — David M. Clark (modelos cognitivos para ansiedade e trauma).</li>
      <li>Boston University — David H. Barlow (transtornos emocionais e Protocolo Unificado).</li>
      <li>UCL — Supervision Competence Framework.</li>
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
