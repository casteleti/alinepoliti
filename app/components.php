<?php
declare(strict_types=1);

/* ----------------------------------------------------------------------------
 * Componentes de UI (espelham Header / Footer / PageHero / CTASection / Prose)
 * ------------------------------------------------------------------------- */

function is_active(string $to): bool
{
    $p = current_path();
    if ($to === '/') {
        return $p === '/';
    }
    return $p === $to || str_starts_with($p, $to . '/');
}

function render_header(): void
{
    $nav = get_nav();
    ?>
    <header class="sticky top-0 z-50 bg-cream/85 backdrop-blur-md border-b border-teal-dark/5">
      <div class="max-w-7xl mx-auto px-5 lg:px-8 h-20 flex items-center justify-between gap-6">
        <a href="<?= url('/') ?>" class="flex items-center gap-3 shrink-0" aria-label="Aline Politi — Início">
          <img src="<?= asset('logo.svg') ?>" alt="Aline Politi" class="h-9 w-auto" width="240" height="72">
        </a>

        <nav class="hidden lg:flex items-center gap-7 text-sm font-medium text-teal-dark/80" aria-label="Principal">
          <?php foreach ($nav as $item): if ($item['label'] === 'Contato') continue; ?>
            <?php if (!empty($item['children'])): ?>
              <div class="group relative">
                <a href="<?= url($item['to']) ?>" aria-haspopup="true"<?= is_active($item['to']) ? ' aria-current="page"' : '' ?>
                   class="flex items-center gap-1 hover:text-magenta transition-colors py-2 <?= is_active($item['to']) ? 'text-magenta' : '' ?>">
                  <?= e($item['label']) ?>
                  <?= icon('chevron-down', 'size-3 opacity-60') ?>
                </a>
                <div class="absolute top-full -left-4 pt-3 hidden group-hover:block group-focus-within:block">
                  <div class="bg-white shadow-xl shadow-teal-dark/10 rounded-2xl p-3 w-64 border border-teal-dark/5 flex flex-col">
                    <?php foreach ($item['children'] as $c): ?>
                      <a href="<?= url($c['to']) ?>" class="px-3 py-2 rounded-lg hover:bg-cream hover:text-magenta transition-colors">
                        <?= e($c['label']) ?>
                      </a>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            <?php else: ?>
              <a href="<?= url($item['to']) ?>"<?= is_active($item['to']) ? ' aria-current="page"' : '' ?>
                 class="hover:text-magenta transition-colors <?= is_active($item['to']) ? 'text-magenta' : '' ?>">
                <?= e($item['label']) ?>
              </a>
            <?php endif; ?>
          <?php endforeach; ?>
          <a href="<?= url('/contato') ?>"
             class="px-5 py-2.5 bg-teal-dark text-cream rounded-full hover:bg-teal-mid transition-all shadow-lg shadow-teal-dark/15">
            Contato
          </a>
        </nav>

        <button type="button" id="menu-toggle"
                class="lg:hidden inline-flex items-center justify-center size-10 rounded-full border border-teal-dark/15 text-teal-dark"
                aria-label="Abrir menu" aria-expanded="false" aria-controls="mobile-menu">
          <span data-icon="open"><?= icon('menu') ?></span>
          <span data-icon="close" class="hidden"><?= icon('x') ?></span>
        </button>
      </div>

      <div id="mobile-menu" class="lg:hidden border-t border-teal-dark/10 bg-cream hidden">
        <nav class="max-w-7xl mx-auto px-5 py-4 flex flex-col gap-1 text-teal-dark" aria-label="Menu mobile">
          <?php foreach ($nav as $item): ?>
            <div class="py-1">
              <a href="<?= url($item['to']) ?>" class="block py-2 font-medium hover:text-magenta"><?= e($item['label']) ?></a>
              <?php if (!empty($item['children'])): ?>
                <div class="pl-4 border-l border-teal-dark/10 ml-1 flex flex-col">
                  <?php foreach ($item['children'] as $c): ?>
                    <a href="<?= url($c['to']) ?>" class="py-1.5 text-sm text-teal-dark/75 hover:text-magenta"><?= e($c['label']) ?></a>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
          <a href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener"
             class="mt-3 py-3 text-center rounded-full bg-amber text-ink font-semibold">
            Agendar pelo WhatsApp
          </a>
        </nav>
      </div>
    </header>
    <?php
}

function render_footer(): void
{
    $nav = get_nav();
    ?>
    <footer class="bg-teal-dark text-cream rounded-t-[3rem] mt-24">
      <div class="max-w-7xl mx-auto px-6 lg:px-8 pt-20 pb-10">
        <div class="grid lg:grid-cols-3 gap-14">
          <div>
            <img src="<?= asset('logo-negativo.svg') ?>" alt="Aline Politi" class="h-12 w-auto mb-6" width="240" height="96">
            <p class="text-cream/70 text-sm leading-relaxed max-w-xs">
              Psicologia ética, humana e baseada em evidências. Acolhimento e Terapia Cognitivo-Comportamental
              para uma vida com mais clareza.
            </p>
            <p class="mt-6 text-xs uppercase tracking-[0.25em] text-amber"><?= e(SITE_CRP) ?></p>
          </div>

          <nav class="grid grid-cols-2 gap-8 text-sm" aria-label="Rodapé">
            <?php foreach ($nav as $sec): if (empty($sec['children'])) continue; ?>
              <div>
                <p class="font-heading text-amber/90 text-base mb-3"><?= e($sec['label']) ?></p>
                <ul class="space-y-2 text-cream/75">
                  <?php foreach ($sec['children'] as $c): ?>
                    <li><a href="<?= url($c['to']) ?>" class="hover:text-amber transition-colors"><?= e($c['label']) ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endforeach; ?>
          </nav>

          <div>
            <p class="font-heading text-amber/90 text-base mb-4">Contato</p>
            <ul class="space-y-3 text-sm text-cream/85">
              <li class="flex items-center gap-3">
                <?= icon('phone', 'size-4 text-amber shrink-0') ?>
                <a href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener" class="hover:text-amber">WhatsApp para agendamento</a>
              </li>
              <li class="flex items-center gap-3">
                <?= icon('mail', 'size-4 text-amber shrink-0') ?>
                <a href="mailto:<?= e(SITE_EMAIL) ?>" class="hover:text-amber"><?= e(SITE_EMAIL) ?></a>
              </li>
              <li class="flex items-center gap-3">
                <?= icon('instagram', 'size-4 text-amber shrink-0') ?>
                <a href="<?= e(SITE_INSTAGRAM_URL) ?>" target="_blank" rel="noopener" class="hover:text-amber"><?= e(SITE_INSTAGRAM_HANDLE) ?></a>
              </li>
              <li class="flex items-start gap-3">
                <?= icon('map-pin', 'size-4 text-amber shrink-0 mt-0.5') ?>
                <span><?= e(SITE_ADDRESS) ?> · atendimento presencial e online</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="mt-16 pt-8 border-t border-cream/10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-cream/55">
          <p>© <?= date('Y') ?> Aline Politi · Psicologia &amp; TCC. Todos os direitos reservados.</p>
          <p class="italic font-display text-sm text-amber/80">“O cuidado que começa no acolhimento.”</p>
        </div>
      </div>
    </footer>
    <?php
}

/** Hero padrão das páginas internas (espelha PageHero). */
function page_hero(string $title, string $italic = '', string $eyebrow = '', string $intro = ''): void
{
    ?>
    <section class="relative overflow-hidden pt-20 pb-16 lg:pt-28 lg:pb-20">
      <div class="absolute -top-24 -left-24 size-80 bg-teal-mid/15 blob-1 blur-3xl" aria-hidden="true"></div>
      <div class="absolute top-10 right-0 size-72 bg-amber/15 blob-2 blur-3xl" aria-hidden="true"></div>
      <div class="relative max-w-5xl mx-auto px-6 lg:px-8">
        <?php if ($eyebrow): ?>
          <span class="inline-block px-4 py-1 rounded-full bg-magenta/10 text-magenta text-xs font-bold tracking-[0.2em] uppercase mb-6"><?= e($eyebrow) ?></span>
        <?php endif; ?>
        <h1 class="font-display text-5xl md:text-7xl text-teal-dark leading-[0.95] max-w-3xl">
          <?= e($title) ?> <?php if ($italic): ?><em class="font-display italic text-magenta"><?= e($italic) ?></em><?php endif; ?>
        </h1>
        <?php if ($intro): ?><p class="mt-8 max-w-2xl text-lg text-ink/70 leading-relaxed"><?= e($intro) ?></p><?php endif; ?>
      </div>
    </section>
    <?php
}

/** Bloco CTA final (espelha CTASection). */
function cta_section(): void
{
    ?>
    <section class="px-6 lg:px-8 mt-12">
      <div class="max-w-6xl mx-auto bg-teal-dark text-cream rounded-[3rem] p-10 md:p-16 relative overflow-hidden">
        <div class="absolute -top-20 -left-20 size-72 bg-magenta/30 rounded-full blur-3xl" aria-hidden="true"></div>
        <div class="absolute -bottom-20 -right-20 size-72 bg-amber/25 rounded-full blur-3xl" aria-hidden="true"></div>
        <div class="relative grid lg:grid-cols-[1.5fr_1fr] gap-10 items-center">
          <div>
            <h2 class="font-display italic text-4xl md:text-5xl leading-tight">Vamos iniciar sua jornada?</h2>
            <p class="mt-5 text-cream/75 max-w-lg">O primeiro passo para a mudança é o mais importante. Conte comigo para caminhar com você.</p>
          </div>
          <div class="flex flex-col sm:flex-row lg:flex-col gap-3 lg:items-end">
            <a href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener"
               class="px-7 py-4 rounded-full bg-amber text-ink font-semibold hover:bg-cream transition-colors text-center">Falar pelo WhatsApp</a>
            <a href="mailto:<?= e(SITE_EMAIL) ?>"
               class="px-7 py-4 rounded-full border border-cream/30 text-cream hover:bg-cream/10 transition-colors text-center">Enviar e-mail</a>
          </div>
        </div>
      </div>
    </section>
    <?php
}

/**
 * Faixa de quebra (citation band) — reflexão/conceito + CTA. Reutilizável.
 * $tom: 'teal' (escuro), 'magenta' ou 'cream' (claro).
 */
function faixa(string $texto, string $cta = 'Vamos conversar?', ?string $href = null, string $atrib = '', string $tom = 'teal'): void
{
    $href = $href ?? whatsapp_url();
    $ext  = str_starts_with($href, 'http');
    [$bg, $fg, $muted, $btn] = match ($tom) {
        'magenta' => ['bg-magenta', 'text-cream', 'text-cream/70', 'bg-cream text-magenta hover:bg-amber hover:text-ink'],
        'cream'   => ['bg-white', 'text-teal-dark', 'text-ink/55', 'bg-teal-dark text-cream hover:bg-teal-mid'],
        default   => ['bg-teal-dark', 'text-cream', 'text-cream/65', 'bg-amber text-ink hover:bg-cream'],
    };
    ?>
    <section class="px-6 lg:px-8 my-16">
      <div class="relative overflow-hidden max-w-5xl mx-auto <?= $bg ?> <?= $fg ?> rounded-[2.5rem] p-10 md:p-16 text-center ring-1 ring-teal-dark/5">
        <div class="absolute -top-16 -left-16 size-64 bg-teal-mid/15 blob-1 blur-3xl" aria-hidden="true"></div>
        <div class="absolute -bottom-16 -right-16 size-64 bg-amber/15 blob-2 blur-3xl" aria-hidden="true"></div>
        <blockquote class="relative">
          <p class="font-display italic text-[clamp(1.5rem,3.2vw,2.6rem)] leading-snug max-w-3xl mx-auto">“<?= e($texto) ?>”</p>
          <?php if ($atrib): ?><footer class="mt-5 text-xs font-bold uppercase tracking-[0.22em] <?= $muted ?>"><?= e($atrib) ?></footer><?php endif; ?>
        </blockquote>
        <a href="<?= e($href) ?>" <?= $ext ? 'target="_blank" rel="noopener"' : '' ?>
           class="relative inline-flex items-center gap-2 mt-9 px-7 py-3.5 rounded-full font-semibold <?= $btn ?> transition-colors">
          <?= e($cta) ?> <?= icon('arrow-right', 'size-4') ?>
        </a>
      </div>
    </section>
    <?php
}

/** Abre/fecha o container de texto rico (espelha Prose). */
function prose_open(): void
{
    echo '<section class="max-w-3xl mx-auto px-6 lg:px-8 py-12"><div class="space-y-6 text-ink/80 text-[17px] leading-[1.8] [&>h2]:font-heading [&>h2]:text-teal-dark [&>h2]:text-3xl [&>h2]:mt-12 [&>h2]:mb-4 [&>h3]:font-heading [&>h3]:text-teal-dark [&>h3]:text-xl [&>h3]:mt-8 [&>h3]:mb-3 [&>ul]:list-disc [&>ul]:pl-6 [&>ul]:space-y-2 [&_strong]:text-teal-dark">';
}

function prose_close(): void
{
    echo '</div></section>';
}

/* ----------------------------------------------------------------------------
 * Breadcrumbs (visual + Schema.org BreadcrumbList) — gerado automaticamente
 * ------------------------------------------------------------------------- */
function page_label_map(): array
{
    return [
        '/a-psicologa' => 'A Psicóloga',
        '/a-psicologa/trajetoria' => 'Trajetória Acadêmica',
        '/a-psicologa/especializacoes' => 'Especializações',
        '/a-psicologa/pesquisas' => 'Pesquisas & Artigos',
        '/a-psicologa/valores' => 'Missão & Valores',
        '/abordagem-tcc' => 'Abordagem TCC',
        '/abordagem-tcc/o-que-e' => 'O que é a TCC?',
        '/abordagem-tcc/presencial' => 'Atendimento Presencial',
        '/abordagem-tcc/online' => 'Atendimento Online',
        '/abordagem-tcc/orientacao-de-pais' => 'Orientação de Pais',
        '/abordagem-tcc/supervisao' => 'Supervisão para Psicólogos',
        '/blog' => 'Blog',
        '/perguntas-frequentes' => 'Perguntas Frequentes',
        '/contato' => 'Contato',
    ];
}

function render_breadcrumbs(): void
{
    $path = current_path();
    if ($path === '/') {
        return;
    }
    $map = page_label_map();
    $trail = [['label' => 'Início', 'to' => '/']];

    if (str_starts_with($path, '/blog/')) {
        $trail[] = ['label' => 'Blog', 'to' => '/blog'];
        $trail[] = ['label' => $GLOBALS['breadcrumb_leaf'] ?? 'Artigo', 'to' => $path];
    } else {
        $cur = '';
        foreach (explode('/', trim($path, '/')) as $seg) {
            $cur .= '/' . $seg;
            $trail[] = ['label' => $map[$cur] ?? ucfirst($seg), 'to' => $cur];
        }
    }

    // Visual
    echo '<nav aria-label="Trilha de navegação" class="max-w-7xl mx-auto px-6 lg:px-8 pt-6 text-sm text-ink/55">';
    echo '<ol class="flex flex-wrap items-center gap-2">';
    $last = count($trail) - 1;
    foreach ($trail as $i => $c) {
        if ($i === $last) {
            echo '<li class="text-teal-dark font-medium" aria-current="page">' . e($c['label']) . '</li>';
        } else {
            echo '<li><a href="' . url($c['to']) . '" class="hover:text-magenta transition-colors">' . e($c['label']) . '</a></li>';
            echo '<li class="text-ink/30" aria-hidden="true">/</li>';
        }
    }
    echo '</ol></nav>';

    // Schema.org BreadcrumbList
    $items = [];
    foreach ($trail as $i => $c) {
        $items[] = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $c['label'], 'item' => abs_url($c['to'])];
    }
    echo '<script type="application/ld+json">'
        . json_encode(['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        . '</script>';
}

/**
 * Bloco de localização da clínica (texto "fácil de chegar" + mapa Google).
 * O iframe é lazy (não pesa no carregamento inicial / 3G).
 */
function mapa_clinica(string $titulo = 'Fácil de chegar'): void
{
    $q     = 'Avenida 15 de Novembro, 418 - Centro, Jaboticabal - SP, 14870-600';
    $embed = 'https://www.google.com/maps?q=' . rawurlencode($q) . '&z=16&hl=pt-BR&output=embed';
    $dir   = 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode($q);
    ?>
    <section class="max-w-6xl mx-auto px-6 lg:px-8 my-16">
      <div class="grid lg:grid-cols-[1fr_1.25fr] gap-8 items-stretch bg-white rounded-[2.5rem] border border-teal-dark/10 p-6 lg:p-8">
        <div class="flex flex-col justify-center">
          <span class="text-xs font-bold tracking-[0.25em] uppercase text-magenta">Onde fica</span>
          <h2 class="font-heading text-2xl md:text-3xl text-teal-dark mt-3 mb-4"><?= e($titulo) ?></h2>
          <p class="text-ink/75 leading-relaxed">
            O consultório fica em um ponto <strong>central e de fácil acesso</strong> de Jaboticabal —
            você chega <strong>descendo o Hospital e Maternidade Santa Isabel</strong>.
          </p>
          <ul class="mt-6 space-y-3 text-sm text-teal-dark/85">
            <li class="flex items-start gap-3"><?= icon('map-pin', 'size-5 text-amber shrink-0 mt-0.5') ?> Avenida 15 de Novembro, 418 — Centro · Jaboticabal/SP · CEP 14870-600</li>
            <li class="flex items-start gap-3"><?= icon('message-circle', 'size-5 text-amber shrink-0 mt-0.5') ?> Estacionamento e referência conhecida na região</li>
            <li class="flex items-start gap-3"><?= icon('monitor', 'size-5 text-amber shrink-0 mt-0.5') ?> Prefere de casa? Também atendo <strong>online</strong>.</li>
          </ul>
          <div class="mt-7 flex flex-wrap gap-3">
            <a href="<?= e($dir) ?>" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-teal-dark text-cream font-semibold hover:bg-teal-mid transition-colors">
              Como chegar <?= icon('arrow-right', 'size-4') ?>
            </a>
            <a href="<?= e(whatsapp_url()) ?>" target="_blank" rel="noopener"
               class="inline-flex items-center gap-2 px-6 py-3 rounded-full border border-teal-dark/20 text-teal-dark font-semibold hover:bg-cream transition-colors">
              Agendar pelo WhatsApp
            </a>
          </div>
        </div>
        <div class="rounded-[2rem] overflow-hidden ring-1 ring-teal-dark/10 bg-teal-dark/5 min-h-[320px] lg:min-h-[380px]">
          <iframe
            src="<?= e($embed) ?>"
            title="Mapa da localização do consultório em Jaboticabal"
            width="100%" height="100%" style="border:0; min-height:320px;"
            loading="lazy" referrerpolicy="no-referrer-when-downgrade"
            allowfullscreen></iframe>
        </div>
      </div>
    </section>
    <?php
}
