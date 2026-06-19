<?php
/** /contato — cards de contato + formulário (POST → server). */
$flash = $_SESSION['flash'] ?? null;
$old   = $_SESSION['old'] ?? [];
unset($_SESSION['flash'], $_SESSION['old']);
$enviado = isset($_GET['enviado']);

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

  <form id="form" method="post" action="<?= url('/contato') ?>" class="bg-teal-dark text-cream p-8 lg:p-10 rounded-[2rem] grid gap-5 relative overflow-hidden">
    <div class="absolute -top-20 -right-20 size-64 bg-magenta/30 rounded-full blur-3xl" aria-hidden="true"></div>
    <h2 class="font-display italic text-3xl text-cream relative">Envie uma mensagem</h2>

    <?php if ($enviado || ($flash['type'] ?? '') === 'ok'): ?>
      <div class="relative rounded-xl bg-amber/20 border border-amber/40 text-cream px-4 py-3 text-sm">Mensagem enviada com sucesso. Em breve retornarei o seu contato. 🌿</div>
    <?php elseif (($flash['type'] ?? '') === 'erro'): ?>
      <div class="relative rounded-xl bg-cream/10 border border-cream/30 text-cream px-4 py-3 text-sm">
        <?php foreach (($flash['errors'] ?? []) as $err): ?><p>• <?= e($err) ?></p><?php endforeach; ?>
      </div>
    <?php endif; ?>

    <div class="grid sm:grid-cols-2 gap-4 relative">
      <div>
        <label class="block text-xs font-bold uppercase tracking-[0.2em] mb-2 text-cream/60">Nome</label>
        <input type="text" name="nome" required value="<?= e($old['nome'] ?? '') ?>"
               class="w-full bg-transparent border-b border-cream/30 py-3 focus:outline-none focus:border-amber transition-colors text-cream">
      </div>
      <div>
        <label class="block text-xs font-bold uppercase tracking-[0.2em] mb-2 text-cream/60">E-mail</label>
        <input type="email" name="email" required value="<?= e($old['email'] ?? '') ?>"
               class="w-full bg-transparent border-b border-cream/30 py-3 focus:outline-none focus:border-amber transition-colors text-cream">
      </div>
    </div>
    <div class="relative">
      <label class="block text-xs font-bold uppercase tracking-[0.2em] mb-2 text-cream/60">Mensagem</label>
      <textarea name="mensagem" rows="5" required
                class="w-full bg-transparent border-b border-cream/30 py-3 focus:outline-none focus:border-amber transition-colors resize-none text-cream"><?= e($old['msg'] ?? '') ?></textarea>
    </div>
    <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">
    <button type="submit" class="relative mt-2 py-4 bg-amber text-ink font-bold rounded-full hover:bg-cream transition-colors">Enviar mensagem</button>
  </form>
</section>

<?php mapa_clinica('Atendimento presencial em Jaboticabal'); ?>
