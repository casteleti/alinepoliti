<?php
/**
 * Template das LPs regionais — Brasileiros no exterior, por país (tráfego pago).
 * Espera $pais (array) definido pela view que inclui este arquivo:
 *   nome, onde ("nos Estados Unidos"), pill ("nos EUA"), slug, wa_msg, flag_svg (SVG cru),
 *   regional: [eyebrow, h2, p, dores[5], acoes[3]], fuso_nota,
 *   form: [origem, assunto, placeholder_local], cidades: [ [em, de] × 20 ]
 * Fonte do conteúdo regional: doc "Estratégia Psicóloga Brasileiros Exterior" (Ads).
 * Conformidade: Resolução CFP nº 9/2024 (revogou a 11/2018) + sem "sigilo garantido".
 */
$wa = whatsapp_url($pais['wa_msg']);

$flash = $_SESSION['flash'] ?? null;
$old   = $_SESSION['old'] ?? [];
unset($_SESSION['flash'], $_SESSION['old']);
$enviado = isset($_GET['enviado']) || (($flash['type'] ?? '') === 'ok');
$erros   = (($flash['type'] ?? '') === 'erro') ? ($flash['errors'] ?? []) : [];

$pill  = 'inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-magenta/10 text-magenta text-[11px] font-bold tracking-[0.2em] uppercase';
$waBtn = static function (string $rotulo) use ($wa): string {
    return '<a href="' . e($wa) . '" target="_blank" rel="noopener" class="js-wa inline-flex items-center justify-center gap-2.5 px-7 py-4 bg-teal-dark text-cream rounded-full font-semibold hover:bg-teal-mid transition-all shadow-xl shadow-teal-dark/20 whitespace-nowrap">'
        . icon('message-circle', 'size-5') . e($rotulo) . '</a>';
};

/* 20 frases do pré-rodapé: padrões variados × cidades com maior comunidade brasileira */
$padroes = [
    static fn($c) => 'Brasileiros que moram ' . $c['em'] . ' procurando psicóloga brasileira.',
    static fn($c) => 'Psicóloga brasileira online para quem vive ' . $c['em'] . '.',
    static fn($c) => 'Terapia em português para brasileiros ' . $c['em'] . '.',
    static fn($c) => 'Morando ' . $c['em'] . ' e buscando terapia com psicóloga brasileira.',
    static fn($c) => 'Atendimento psicológico em português para brasileiros ' . $c['de'] . '.',
    static fn($c) => 'Psicóloga que fala a sua língua para brasileiros ' . $c['em'] . '.',
    static fn($c) => 'Terapia online no seu fuso para quem mora ' . $c['em'] . '.',
    static fn($c) => 'Brasileiros ' . $c['em'] . ' que querem fazer terapia em português.',
    static fn($c) => 'Psicoterapia online para a comunidade brasileira ' . $c['de'] . '.',
    static fn($c) => 'Vive ' . $c['em'] . '? Terapia online com psicóloga brasileira.',
];
$frasesCidades = [];
foreach ($pais['cidades'] as $i => $cidade) {
    $frasesCidades[] = $padroes[$i % count($padroes)]($cidade);
}
?>

<!-- 1 · HERO -->
<section class="relative overflow-hidden">
  <div class="absolute -top-24 -left-20 size-80 bg-teal-mid/15 blob-1 blur-3xl" aria-hidden="true"></div>
  <div class="absolute -bottom-24 -right-16 size-80 bg-amber/15 blob-2 blur-3xl" aria-hidden="true"></div>
  <div class="relative max-w-6xl mx-auto px-6 lg:px-8 pt-10 lg:pt-16 pb-14 grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
    <div class="text-center lg:text-left">
      <span class="<?= $pill ?> mb-5 hidden lg:inline-flex">Psicóloga Online para Brasileiros que Moram no Exterior</span>
      <h1 class="font-display text-[clamp(2.4rem,8vw,4.4rem)] text-teal-dark leading-[0.98]">Psicóloga brasileira para quem vive <em class="italic text-magenta"><?= e($pais['onde']) ?></em></h1>
      <p class="mt-6 text-lg text-ink/70 leading-relaxed max-w-xl mx-auto lg:mx-0">Longe do Brasil, perto de quem entende você: psicoterapia online em português, com uma psicóloga brasileira que compreende a sua história e o seu momento — no seu fuso.</p>
      <div class="mt-8 flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
        <?= $waBtn('Conversar no WhatsApp') ?>
        <a href="#form" class="inline-flex items-center justify-center gap-2 px-7 py-4 border border-teal-dark/20 text-teal-dark rounded-full font-medium hover:bg-white transition-all whitespace-nowrap">Deixar minha mensagem</a>
      </div>
      <ul class="mt-8 flex flex-wrap gap-2 justify-center lg:justify-start">
        <?php foreach (['CRP 06/113904', 'Quase 20 anos de experiência', 'Terapia Cognitivo-Comportamental', 'Online e sigiloso'] as $selo): ?>
          <li class="px-3 py-1.5 rounded-full bg-white text-teal-dark text-xs font-medium ring-1 ring-teal-dark/10"><?= e($selo) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <div class="relative order-first lg:order-last">
      <!-- Sobrelinha (mobile): acima da foto, centralizada, 2 linhas -->
      <div class="lg:hidden text-center mb-4">
        <span class="inline-flex flex-col items-center px-5 py-2.5 rounded-2xl bg-magenta/10 text-magenta text-sm font-extrabold tracking-[0.18em] uppercase leading-tight">
          <span>Psicóloga Online para Brasileiros</span>
          <span>que Moram no Exterior</span>
        </span>
      </div>
      <div class="relative w-full max-w-[420px] mx-auto">
        <div class="absolute -inset-5 bg-gradient-to-br from-teal-mid/25 via-cream to-amber/20 blob-1 blur-2xl" aria-hidden="true"></div>
        <div class="relative aspect-square blob-1 overflow-hidden ring-1 ring-teal-dark/10">
          <img src="<?= asset('consultoria.webp') ?>" alt="Aline Politi, psicóloga clínica, em atendimento online" width="764" height="820" fetchpriority="high" class="w-full h-full object-cover">
        </div>
        <!-- Rota Brasil → país: bandeira BR + linha pontilhada com avião + bandeira local -->
        <svg class="absolute bottom-9 left-14 right-14 lg:left-16 lg:right-16 h-14 w-auto max-w-full pointer-events-none" viewBox="0 0 300 60" fill="none" aria-hidden="true" preserveAspectRatio="none">
          <path d="M8 52 Q150 -14 292 52" stroke="#117B7F" stroke-width="2.5" stroke-dasharray="0.5 9" stroke-linecap="round"/>
          <g transform="translate(150,20)">
            <circle r="15" fill="#FCF9F5" stroke="#117B7F" stroke-opacity=".15"/>
            <g transform="rotate(90) translate(-11,-11) scale(0.92)">
              <path d="M21 16v-2l-8-5V3.5a1.5 1.5 0 0 0-3 0V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z" fill="#117B7F"/>
            </g>
          </g>
        </svg>
        <!-- Selo bandeira do Brasil (origem) -->
        <div class="absolute bottom-3 left-1 lg:-left-3 size-16 lg:size-20 rounded-full bg-white p-1.5 shadow-xl shadow-teal-dark/20 ring-1 ring-teal-dark/5" aria-label="Atendimento em português (Brasil)" title="Do Brasil">
          <svg viewBox="0 0 100 100" class="w-full h-full" role="img" aria-hidden="true">
            <defs><clipPath id="brflag"><circle cx="50" cy="50" r="50"/></clipPath></defs>
            <g clip-path="url(#brflag)">
              <rect width="100" height="100" fill="#009C3B"/>
              <polygon points="50,10 90,50 50,90 10,50" fill="#FFDF00"/>
              <circle cx="50" cy="50" r="19" fill="#002776"/>
              <path d="M33 46 A22 22 0 0 1 67 52" fill="none" stroke="#fff" stroke-width="3.2"/>
            </g>
          </svg>
        </div>
        <!-- Selo bandeira do país (destino) -->
        <div class="absolute bottom-3 right-1 lg:-right-3 size-16 lg:size-20 rounded-full bg-white p-1.5 shadow-xl shadow-teal-dark/20 ring-1 ring-teal-dark/5" aria-label="Para brasileiros <?= e($pais['pill']) ?>" title="Para você, <?= e($pais['onde']) ?>">
          <svg viewBox="0 0 100 100" class="w-full h-full" role="img" aria-hidden="true">
            <defs><clipPath id="flag-<?= e($pais['slug']) ?>"><circle cx="50" cy="50" r="50"/></clipPath></defs>
            <g clip-path="url(#flag-<?= e($pais['slug']) ?>)">
              <?= $pais['flag_svg'] /* SVG confiável, definido no código */ ?>
            </g>
          </svg>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 2 · EMPATIA REGIONAL -->
<section class="bg-white py-16 lg:py-24">
  <div class="max-w-3xl mx-auto px-6 lg:px-8">
    <span class="<?= $pill ?>">Talvez você esteja vivendo…</span>
    <h2 class="font-heading text-3xl md:text-4xl text-teal-dark mt-4 leading-tight"><?= e($pais['regional']['h2']) ?></h2>
    <p class="mt-6 text-lg text-ink/75 leading-relaxed"><?= e($pais['regional']['p']) ?></p>
    <ul class="mt-8 grid sm:grid-cols-2 gap-4">
      <?php foreach ($pais['regional']['dores'] as $item): ?>
        <li class="flex items-start gap-3 text-ink/80">
          <span class="shrink-0 size-6 rounded-full bg-teal-mid/15 text-teal-mid flex items-center justify-center mt-0.5" aria-hidden="true">
            <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
          </span><?= e($item) ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <p class="mt-8 font-heading text-teal-dark text-lg">Na terapia, um espaço para:</p>
    <ul class="mt-4 space-y-2.5">
      <?php foreach ($pais['regional']['acoes'] as $acao): ?>
        <li class="flex items-start gap-3 text-ink/80">
          <span class="shrink-0 size-6 rounded-full bg-amber/20 text-amber flex items-center justify-center mt-0.5" aria-hidden="true">
            <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
          </span><?= e($acao) ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- 3 · NA SUA LÍNGUA -->
<section class="py-16 lg:py-24">
  <div class="max-w-3xl mx-auto px-6 lg:px-8 text-center">
    <span class="<?= $pill ?>">Por que isso faz diferença</span>
    <h2 class="font-display italic text-4xl md:text-5xl text-teal-dark mt-4 leading-tight">Você merece ser compreendido(a) na sua <span class="not-italic font-heading text-magenta">língua</span> e na sua cultura</h2>
    <p class="mt-6 text-lg text-ink/75 leading-relaxed">Cuidar da mente já é delicado. Fazer isso em outro contexto, tendo que explicar o que é saudade ou como funciona uma família brasileira, torna tudo mais difícil. Aqui, você fala em português com quem conhece a sua realidade de perto — enquanto o processo terapêutico considera, com cuidado, a cultura do país onde você vive e a sua história particular. Não precisa traduzir o que sente.</p>
  </div>
</section>

<!-- 4 · AUTORIDADE -->
<section class="bg-white py-16 lg:py-24">
  <div class="max-w-5xl mx-auto px-6 lg:px-8 grid lg:grid-cols-[0.8fr_1fr] gap-10 lg:gap-14 items-center">
    <div class="relative order-first">
      <div class="absolute -inset-4 bg-amber/15 blob-2" aria-hidden="true"></div>
      <img src="<?= asset('portrait.webp') ?>" alt="Aline Politi, psicóloga clínica (CRP 06/113904)" width="600" height="750" class="relative w-full max-w-xs mx-auto h-auto blob-1 ring-1 ring-teal-dark/10" loading="lazy">
    </div>
    <div>
      <span class="<?= $pill ?>">Quem vai caminhar com você</span>
      <h2 class="font-heading text-3xl md:text-4xl text-teal-dark mt-4 leading-tight">Experiência e formação que trazem segurança</h2>
      <p class="mt-6 text-ink/75 leading-relaxed">Aline Politi é psicóloga clínica (CRP 06/113904), com quase 20 anos dedicados à saúde mental e ao desenvolvimento humano. Mestre em Psicologia pela USP, especialista em Terapia Cognitivo-Comportamental e em constante atualização nas terapias contextuais (ACT, DBT, Terapia do Esquema e Terapia Focada na Compaixão). Um cuidado que une ciência e acolhimento.</p>
      <ul class="mt-6 space-y-2.5">
        <?php foreach (['Psicóloga clínica — CRP 06/113904', 'Mestrado em Psicologia — USP', 'Especialista e Proficiência em TCC', 'Quase 20 anos de prática clínica'] as $cred): ?>
          <li class="flex items-center gap-3 text-teal-dark/85 font-medium">
            <span class="shrink-0 size-6 rounded-full bg-teal-mid/15 text-teal-mid flex items-center justify-center" aria-hidden="true">
              <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </span><?= e($cred) ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<!-- 5 · CTA INTERMEDIÁRIO -->
<section class="py-14">
  <div class="max-w-4xl mx-auto px-6 lg:px-8">
    <div class="bg-teal-dark rounded-[2.5rem] px-8 py-12 text-center relative overflow-hidden">
      <span class="absolute -top-16 -right-10 size-56 bg-magenta/30 rounded-full blur-3xl" aria-hidden="true"></span>
      <p class="relative font-display italic text-3xl md:text-4xl text-cream">Já sente que faz sentido conversar?</p>
      <div class="relative mt-7 flex justify-center">
        <a href="<?= e($wa) ?>" target="_blank" rel="noopener" class="js-wa inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-amber text-ink rounded-full font-bold hover:bg-cream transition-colors"><?= icon('message-circle', 'size-5') ?> Falar com a Aline no WhatsApp</a>
      </div>
    </div>
  </div>
</section>

<!-- 6 · MÉTODO -->
<section class="py-16 lg:py-24">
  <div class="max-w-5xl mx-auto px-6 lg:px-8">
    <div class="max-w-2xl mb-12">
      <span class="<?= $pill ?>">Como o cuidado acontece</span>
      <h2 class="font-display italic text-4xl md:text-5xl text-teal-dark mt-4 leading-tight">Uma terapia com <span class="not-italic font-heading">método</span>, não improviso</h2>
      <p class="mt-5 text-ink/70 leading-relaxed">A Terapia Cognitivo-Comportamental é uma das abordagens mais estudadas do mundo. Juntos, identificamos padrões de pensamento que geram sofrimento, construímos perspectivas mais realistas e desenvolvemos ferramentas práticas para os desafios do seu dia a dia — um repertório que você leva para a vida.</p>
    </div>
    <div class="grid sm:grid-cols-2 gap-6">
      <?php foreach ([
        ['01', 'Identificação de padrões', 'Mapeamos os pensamentos que geram desconforto.'],
        ['02', 'Reestruturação', 'Flexibilizamos crenças rígidas e construímos perspectivas mais saudáveis.'],
        ['03', 'Ferramentas para o agora', 'Recursos práticos para os desafios atuais da sua vida.'],
        ['04', 'Autonomia', 'Um repertório de autocuidado que fica com você.'],
      ] as $p): ?>
        <div class="flex gap-5 p-6 rounded-[1.75rem] bg-white border border-teal-dark/5">
          <span class="font-display italic text-4xl text-amber/70 leading-none shrink-0"><?= e($p[0]) ?></span>
          <div>
            <h3 class="font-heading text-xl text-teal-dark mb-1.5"><?= e($p[1]) ?></h3>
            <p class="text-ink/70 leading-relaxed text-[15px]"><?= e($p[2]) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- 7 · SEGURANÇA & FUNCIONAMENTO -->
<section class="bg-white py-16 lg:py-24">
  <div class="max-w-3xl mx-auto px-6 lg:px-8">
    <span class="<?= $pill ?>">Sem sair de casa</span>
    <h2 class="font-heading text-3xl md:text-4xl text-teal-dark mt-4 leading-tight">No conforto da sua casa, no seu fuso, com responsabilidade clínica</h2>
    <p class="mt-6 text-lg text-ink/75 leading-relaxed">As sessões são realizadas por videochamada, com Aline Politi no Brasil, dentro das normas profissionais brasileiras (Resolução CFP nº 9/2024) e mediante avaliação da adequação do atendimento online para cada situação. Antes do início, são combinados horários no seu fuso, recursos de privacidade, forma de contato e procedimentos para situações de urgência no país onde você está.</p>
    <ul class="mt-8 grid sm:grid-cols-2 gap-4">
      <?php foreach (['Atendimento 100% em português', 'Horários previamente combinados no fuso ' . $pais['fuso_nota'], 'Atendimento sigiloso, conforme as normas do CFP', 'Continuidade mesmo em viagens ou mudanças'] as $item): ?>
        <li class="flex items-start gap-3 text-ink/80">
          <span class="shrink-0 size-6 rounded-full bg-teal-mid/15 text-teal-mid flex items-center justify-center mt-0.5" aria-hidden="true">
            <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
          </span><?= e($item) ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<!-- 8 · CTA FINAL + FORMULÁRIO -->
<section id="form" class="py-16 lg:py-24 scroll-mt-6">
  <div class="max-w-5xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-10 items-start">
    <div>
      <span class="<?= $pill ?>">Vamos conversar?</span>
      <h2 class="font-display text-4xl md:text-5xl text-teal-dark mt-4 leading-tight">Dê o primeiro <em class="italic text-magenta">passo</em>, no seu tempo</h2>
      <p class="mt-6 text-ink/75 leading-relaxed">Você não precisa decidir tudo agora. Envie uma mensagem para entender se este atendimento combina com o que procura — eu explico como funciona, sem pressa e sem compromisso.</p>
      <ul class="mt-6 space-y-2.5">
        <?php foreach (['Atendimento em português', 'Atendimento sigiloso, conforme as normas do CFP', 'Resposta pessoal da psicóloga'] as $r): ?>
          <li class="flex items-center gap-3 text-teal-dark/85 font-medium">
            <span class="shrink-0 size-6 rounded-full bg-teal-mid/15 text-teal-mid flex items-center justify-center" aria-hidden="true">
              <svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
            </span><?= e($r) ?>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="mt-8"><?= $waBtn('Conversar agora no WhatsApp') ?></div>
    </div>

    <?php
      $inp = 'w-full bg-transparent border-b border-cream/30 py-3 focus:outline-none focus:border-amber transition-colors text-cream placeholder:text-cream/30';
      $lbl = 'block text-xs font-bold uppercase tracking-[0.2em] mb-2 text-cream/60';
    ?>
    <form method="post" action="<?= url('/contato') ?>" class="bg-teal-dark text-cream p-8 lg:p-10 rounded-[2rem] grid gap-5 relative overflow-hidden">
      <div class="absolute -top-20 -right-20 size-64 bg-magenta/30 rounded-full blur-3xl" aria-hidden="true"></div>
      <?php if ($enviado): ?>
        <div class="relative text-center py-4">
          <div class="mx-auto size-16 rounded-full bg-amber/20 text-amber flex items-center justify-center mb-5" aria-hidden="true">
            <svg class="size-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
          </div>
          <h3 class="font-display italic text-3xl text-cream mb-2">Recebi a sua mensagem 🌿</h3>
          <p class="text-cream/80 max-w-sm mx-auto leading-relaxed">Recebi a sua mensagem com carinho. Em breve entro em contato. Se preferir, você também pode falar comigo agora pelo WhatsApp.</p>
          <a href="<?= e($wa) ?>" target="_blank" rel="noopener" class="js-wa mt-6 inline-flex items-center gap-2 px-6 py-3 rounded-full bg-amber text-ink font-bold hover:bg-cream transition-colors"><?= icon('message-circle', 'size-4') ?> Falar no WhatsApp</a>
        </div>
      <?php else: ?>
        <div class="relative">
          <h3 class="font-display italic text-3xl text-cream">Prefere deixar uma mensagem? Eu retorno.</h3>
        </div>
        <?php if ($erros): ?>
          <div class="relative rounded-xl bg-cream/10 border border-cream/30 text-cream px-4 py-3 text-sm">
            <?php foreach ($erros as $err): ?><p>• <?= e($err) ?></p><?php endforeach; ?>
          </div>
        <?php endif; ?>
        <div>
          <label class="<?= $lbl ?>">Seu nome</label>
          <input type="text" name="nome" required value="<?= e($old['nome'] ?? '') ?>" class="<?= $inp ?>">
        </div>
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="<?= $lbl ?>">Seu e-mail</label>
            <input type="email" name="email" required value="<?= e($old['email'] ?? '') ?>" class="<?= $inp ?>">
          </div>
          <div>
            <label class="<?= $lbl ?>">WhatsApp (com código do país)</label>
            <input type="tel" name="telefone" required value="<?= e($old['telefone'] ?? '') ?>" placeholder="+00 000 000 000" class="<?= $inp ?>">
          </div>
        </div>
        <div>
          <label class="<?= $lbl ?>">Cidade onde você mora <?= e($pais['onde']) ?></label>
          <input type="text" name="local" required value="<?= e($old['local'] ?? '') ?>" placeholder="<?= e($pais['form']['placeholder_local']) ?>" class="<?= $inp ?>">
        </div>
        <div>
          <label class="<?= $lbl ?>">O que você gostaria de compartilhar? <span class="font-normal lowercase tracking-normal text-cream/40">(opcional)</span></label>
          <textarea name="mensagem" rows="3" class="<?= $inp ?> resize-none"><?= e($old['msg'] ?? '') ?></textarea>
        </div>
        <label class="flex items-start gap-2.5 text-sm text-cream/80">
          <input type="checkbox" name="consentimento" required class="mt-1 size-4 accent-amber shrink-0">
          <span>Autorizo o contato e concordo com o tratamento sigiloso dos meus dados.</span>
        </label>
        <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">
        <?= csrf_field() ?>
        <input type="hidden" name="origem" value="<?= e($pais['form']['origem']) ?>">
        <input type="hidden" name="assunto" value="<?= e($pais['form']['assunto']) ?>">
        <input type="hidden" name="retorno" value="/<?= e($pais['slug']) ?>">
        <button type="submit" class="mt-2 py-4 bg-amber text-ink font-bold rounded-full hover:bg-cream transition-colors">Enviar mensagem</button>
        <p class="text-xs text-cream/50 text-center">Seus dados são tratados com sigilo e não são compartilhados (LGPD).</p>
      <?php endif; ?>
    </form>
  </div>

  <p class="max-w-5xl mx-auto px-6 lg:px-8 mt-12 text-center text-xs text-ink/50">
    Aline Politi · Psicóloga Clínica · CRP 06/113904 · Atendimento online realizado do Brasil, em conformidade com a Resolução CFP nº 9/2024.<br>
    Esta página não é um canal de urgência. Em situação de risco imediato, procure o serviço de emergência do país onde você está.
  </p>
</section>

<!-- 8b · Atendimento por país (links internos cruzados → indexação) -->
<?php
$todosPaises = [
    'psicologa-para-brasileiros-moram-nos-estados-unidos' => 'nos Estados Unidos',
    'psicologa-para-brasileiros-moram-no-canada'          => 'no Canadá',
    'psicologa-para-brasileiros-moram-em-portugal'        => 'em Portugal',
    'psicologa-para-brasileiros-moram-na-irlanda'         => 'na Irlanda',
    'psicologa-para-brasileiros-moram-na-australia'       => 'na Austrália',
];
unset($todosPaises[$pais['slug']]);
?>
<section class="pb-4">
  <div class="max-w-5xl mx-auto px-6 lg:px-8 text-center">
    <p class="text-[11px] font-semibold uppercase tracking-[0.25em] text-ink/30 mb-4">Atendimento em outros países</p>
    <p class="text-sm leading-loose text-ink/60">
      <a href="<?= url('/psicologa-para-brasileiros-no-exterior') ?>" class="text-teal-dark/80 hover:text-magenta underline decoration-teal-dark/20 underline-offset-2">Psicóloga para brasileiros no exterior</a>
      <?php foreach ($todosPaises as $slugPais => $rotulo): ?>
        · <a href="<?= url('/' . $slugPais) ?>" class="text-teal-dark/80 hover:text-magenta underline decoration-teal-dark/20 underline-offset-2"><?= e($rotulo) ?></a>
      <?php endforeach; ?>
    </p>
  </div>
</section>

<!-- 9 · PRÉ-RODAPÉ: cidades com maior comunidade brasileira (acordeão fechado, botão discreto) -->
<section class="py-6">
  <div class="max-w-6xl mx-auto px-6 lg:px-8">
    <details class="group">
      <summary class="cursor-pointer list-none [&::-webkit-details-marker]:hidden text-center text-[11px] font-semibold uppercase tracking-[0.25em] text-ink/20 hover:text-ink/45 transition-colors select-none py-2">
        Atendimento online para brasileiros em todo o país <span class="inline-block transition-transform group-open:rotate-45" aria-hidden="true">+</span>
      </summary>
      <div class="mt-4 bg-teal-dark rounded-[2rem] px-6 py-8 lg:px-10 lg:py-10">
        <ul class="flex flex-wrap justify-center gap-x-2 gap-y-3 text-center">
          <?php foreach ($frasesCidades as $i => $frase): ?>
            <li class="inline">
              <a href="#form" class="text-cream/85 hover:text-amber transition-colors text-sm leading-relaxed"><?= e($frase) ?></a>
              <?php if ($i < count($frasesCidades) - 1): ?><span class="text-cream/25 text-sm" aria-hidden="true"> · </span><?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </details>
  </div>
</section>

<!-- WhatsApp fixo -->
<a href="<?= e($wa) ?>" target="_blank" rel="noopener" aria-label="Conversar no WhatsApp"
   class="js-wa fixed bottom-4 right-4 z-50 inline-flex items-center gap-2 pl-4 pr-5 py-3.5 rounded-full bg-teal-dark text-cream font-semibold shadow-2xl shadow-teal-dark/30 hover:bg-teal-mid transition-colors">
  <?= icon('message-circle', 'size-5') ?> WhatsApp
</a>

<script>
(function () {
  function track(ev){ try{ if(window.fbq) fbq('track', ev); }catch(e){} try{ (window.dataLayer=window.dataLayer||[]).push({event:'lp_'+ev.toLowerCase()}); }catch(e){} }
  document.querySelectorAll('.js-wa').forEach(function(a){ a.addEventListener('click', function(){ track('Contact'); }); });
  if (new URLSearchParams(location.search).get('enviado')) track('Lead');
})();
</script>
