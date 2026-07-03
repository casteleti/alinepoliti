<?php
/** /contato — cards de contato + formulário geral (com seleção de assunto). */
$cards = [
    ['icon' => 'message-circle', 't' => 'WhatsApp', 's' => 'Resposta mais rápida — ideal para agendamento.', 'href' => whatsapp_url(), 'cta' => 'Abrir WhatsApp'],
    ['icon' => 'mail', 't' => 'E-mail', 's' => SITE_EMAIL, 'href' => 'mailto:' . SITE_EMAIL, 'cta' => 'Enviar e-mail'],
    ['icon' => 'instagram', 't' => 'Instagram', 's' => SITE_INSTAGRAM_HANDLE . ' — conteúdo e bastidores', 'href' => SITE_INSTAGRAM_URL, 'cta' => 'Seguir'],
    ['icon' => 'map-pin', 't' => 'Atendimento', 's' => 'Presencial em consultório · Online para todo o Brasil', 'href' => ''],
];
page_hero('Vamos', 'conversar?', 'Contato', 'O primeiro passo costuma ser o mais difícil. Estou aqui para acolher sua mensagem com cuidado.');
?>
<section class="max-w-6xl mx-auto px-6 lg:px-8 pb-16 grid lg:grid-cols-[1fr_1.2fr] gap-10">
  <div class="space-y-4">
    <?php foreach ($cards as $c): $ext = $c['href'] !== '' && str_starts_with($c['href'], 'http'); ?>
      <?php if ($c['href'] !== ''): ?><a href="<?= e($c['href']) ?>" <?= $ext ? 'target="_blank" rel="noopener"' : '' ?> class="block p-6 rounded-2xl bg-white border border-teal-dark/10 hover:border-magenta transition-all group"><?php else: ?><div class="block p-6 rounded-2xl bg-white border border-teal-dark/10"><?php endif; ?>
        <div class="flex items-start gap-4">
          <div class="size-11 rounded-xl bg-teal-mid/10 text-teal-mid flex items-center justify-center group-hover:bg-magenta/10 group-hover:text-magenta transition-colors shrink-0"><?= icon($c['icon']) ?></div>
          <div class="min-w-0">
            <p class="font-heading text-lg text-teal-dark"><?= e($c['t']) ?></p>
            <p class="text-ink/70 text-sm"><?= e($c['s']) ?></p>
            <?php if (!empty($c['cta'])): ?><span class="mt-2 inline-block text-sm font-semibold text-magenta"><?= e($c['cta']) ?> →</span><?php endif; ?>
          </div>
        </div>
      <?php echo $c['href'] !== '' ? '</a>' : '</div>'; ?>
    <?php endforeach; ?>
  </div>

  <?php render_form_contato(['origem' => 'contato', 'titulo' => 'Envie uma mensagem', 'retorno' => '/contato']); ?>
</section>

<?php mapa_clinica('Atendimento presencial em Jaboticabal'); ?>

<?php bloco_psicologa('Você não precisa dar conta de tudo sozinho. Pedir ajuda também é um ato de coragem.'); ?>
