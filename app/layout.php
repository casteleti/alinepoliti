<?php
/**
 * Layout/shell HTML. Espera no escopo:
 *   $meta    array  (title, description, canonical, ogTitle, ogDescription, ogImage, jsonld)
 *   $content string (HTML do corpo da página)
 */
declare(strict_types=1);

$title       = $meta['title']       ?? (SITE_NAME . ' — ' . SITE_TAGLINE);
$description = $meta['description']  ?? 'Psicóloga clínica especializada em Terapia Cognitivo-Comportamental (TCC). Atendimento presencial e online. ' . SITE_CRP . '.';
$canonical   = isset($meta['canonical']) ? abs_url($meta['canonical']) : '';
$ogTitle     = $meta['ogTitle']     ?? $title;
$ogDesc      = $meta['ogDescription'] ?? $description;
$ogImage     = $meta['ogImage']     ?? asset('og.jpg');
if ($ogImage !== '' && $ogImage[0] === '/') { $ogImage = abs_url($ogImage); } // OG/Twitter exigem URL absoluta
$extraJsonLd = $meta['jsonld']      ?? '';

$_orgId     = SITE_ORIGIN . '/#organizacao';
$_personId  = SITE_ORIGIN . '/#aline-politi';
$_knowsAbout = [
    'Terapia Cognitivo-Comportamental', 'Ansiedade', 'Depressão', 'Orientação de Pais',
    'Supervisão Clínica', 'Terapia de Aceitação e Compromisso (ACT)',
    'Terapia Comportamental Dialética (DBT)', 'Terapia do Esquema',
    'Terapia Focada na Compaixão', 'Autocompaixão', 'Regulação Emocional', 'Mindfulness',
];
$_endereco = [
    '@type' => 'PostalAddress',
    'streetAddress' => 'Avenida 15 de Novembro, 418 - Centro',
    'addressLocality' => 'Jaboticabal',
    'addressRegion' => 'SP',
    'postalCode' => '14870-600',
    'addressCountry' => 'BR',
];
// @graph com identidade explícita: Organization/Psychologist + Person (E-E-A-T / GEO)
$siteJsonLd = json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'       => ['Psychologist', 'LocalBusiness', 'Organization'],
            '@id'         => $_orgId,
            'name'        => 'Aline Politi · Psicologia',
            'url'         => SITE_ORIGIN,
            'image'       => abs_url('/assets/og.jpg'),
            'logo'        => abs_url('/assets/logo.png'),
            'description' => 'Psicóloga clínica especializada em Terapia Cognitivo-Comportamental (TCC), com atendimento presencial em Jaboticabal e online.',
            'telephone'   => SITE_PHONE_E164,
            'email'       => SITE_EMAIL,
            'address'     => $_endereco,
            'areaServed'  => ['@type' => 'Country', 'name' => 'Brasil'],
            'knowsAbout'  => $_knowsAbout,
            'sameAs'      => [SITE_INSTAGRAM_URL],
            'founder'     => ['@id' => $_personId],
            'employee'    => ['@id' => $_personId],
            'availableService' => [
                ['@type' => 'MedicalTherapy', 'name' => 'Atendimento Clínico em TCC'],
                ['@type' => 'MedicalTherapy', 'name' => 'Orientação de Pais'],
                ['@type' => 'Service', 'name' => 'Supervisão para Psicólogos'],
            ],
        ],
        [
            '@type'         => 'Person',
            '@id'           => $_personId,
            'name'          => SITE_NAME,
            'jobTitle'      => 'Psicóloga Clínica',
            'identifier'    => SITE_CRP,
            'url'           => abs_url('/a-psicologa'),
            'image'         => abs_url('/assets/portrait.jpg'),
            'worksFor'      => ['@id' => $_orgId],
            'knowsLanguage' => 'pt-BR',
            'knowsAbout'    => $_knowsAbout,
            'sameAs'        => [SITE_INSTAGRAM_URL],
            'alumniOf'      => [
                ['@type' => 'CollegeOrUniversity', 'name' => 'Universidade de São Paulo (USP)'],
                ['@type' => 'CollegeOrUniversity', 'name' => 'UNAERP — Universidade de Ribeirão Preto'],
            ],
        ],
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<?php if (GTM_CONTAINER_ID !== ''): ?>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','<?= e(GTM_CONTAINER_ID) ?>');</script>
  <!-- End Google Tag Manager -->
<?php endif; ?>
<?php if (GA_MEASUREMENT_ID !== ''): ?>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=<?= e(GA_MEASUREMENT_ID) ?>"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '<?= e(GA_MEASUREMENT_ID) ?>');
  </script>
<?php endif; ?>
<?php if (META_PIXEL_ID !== ''): ?>
  <!-- Meta Pixel -->
  <script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
  n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');fbq('init','<?= e(META_PIXEL_ID) ?>');fbq('track','PageView');</script>
  <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=<?= e(META_PIXEL_ID) ?>&ev=PageView&noscript=1"/></noscript>
  <!-- End Meta Pixel -->
<?php endif; ?>
  <title><?= e($title) ?></title>
  <meta name="description" content="<?= e($description) ?>">
  <meta name="author" content="Aline Politi">
  <meta name="theme-color" content="<?= e(SITE_THEME_COLOR) ?>">
  <link rel="icon" href="<?= asset('favicon.svg') ?>" type="image/svg+xml">
  <link rel="apple-touch-icon" href="<?= asset('favicon.svg') ?>">
  <?php if ($canonical): ?><link rel="canonical" href="<?= e($canonical) ?>"><?php endif; ?>

  <meta property="og:site_name" content="Aline Politi · Psicologia">
  <meta property="og:type" content="website">
  <meta property="og:locale" content="pt_BR">
  <meta property="og:title" content="<?= e($ogTitle) ?>">
  <meta property="og:description" content="<?= e($ogDesc) ?>">
  <meta property="og:image" content="<?= e($ogImage) ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:type" content="image/jpeg">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e($ogTitle) ?>">
  <meta name="twitter:description" content="<?= e($ogDesc) ?>">
  <meta name="twitter:image" content="<?= e($ogImage) ?>">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,500&family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Manrope:wght@400;500;600;700&display=swap">

  <?php $cssVer = @filemtime(dirname(__DIR__) . '/public/assets/app.css') ?: '1'; ?>
  <link rel="stylesheet" href="<?= asset('app.css') ?>?v=<?= e((string)$cssVer) ?>">

  <script type="application/ld+json"><?= $siteJsonLd ?></script>
  <?php if ($extraJsonLd): ?><script type="application/ld+json"><?= $extraJsonLd ?></script><?php endif; ?>
</head>
<body class="min-h-screen flex flex-col bg-cream text-ink">
<?php if (GTM_CONTAINER_ID !== ''): ?>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= e(GTM_CONTAINER_ID) ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
<?php endif; ?>
  <a href="#conteudo" class="skip-link">Pular para o conteúdo</a>
  <?php render_header(); ?>
  <?php if (empty($meta['no_breadcrumb'])) { render_breadcrumbs(); } ?>
  <main id="conteudo" class="flex-1"><?= $content ?></main>
  <?php pre_rodape(); ?>
  <?php render_footer(); ?>

  <script>
    (function () {
      var btn = document.getElementById('menu-toggle');
      var menu = document.getElementById('mobile-menu');
      if (!btn || !menu) return;
      btn.addEventListener('click', function () {
        var open = menu.classList.toggle('hidden') === false;
        btn.setAttribute('aria-expanded', String(open));
        btn.setAttribute('aria-label', open ? 'Fechar menu' : 'Abrir menu');
        btn.querySelector('[data-icon="open"]').classList.toggle('hidden', open);
        btn.querySelector('[data-icon="close"]').classList.toggle('hidden', !open);
      });
    })();

    // Sombra no header ao rolar
    (function () {
      var hdr = document.querySelector('header');
      if (!hdr) return;
      var onScroll = function () { hdr.classList.toggle('scrolled', window.scrollY > 8); };
      onScroll();
      window.addEventListener('scroll', onScroll, { passive: true });
    })();

    // Scroll-reveal (progressive enhancement — sem JS o conteúdo aparece normal)
    (function () {
      var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      if (reduce || !('IntersectionObserver' in window)) return;
      var els = document.querySelectorAll('main section, footer');
      els.forEach(function (el) { el.classList.add('reveal'); });
      var io = new IntersectionObserver(function (entries) {
        entries.forEach(function (en) {
          if (en.isIntersecting) { en.target.classList.add('is-visible'); io.unobserve(en.target); }
        });
      }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
      els.forEach(function (el) { io.observe(el); });
    })();
  </script>
</body>
</html>
