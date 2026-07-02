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

$siteJsonLd = json_encode([
    '@context'      => 'https://schema.org',
    '@type'         => 'Psychologist',
    'name'          => SITE_NAME,
    'jobTitle'      => 'Psicóloga Clínica',
    'description'   => 'Psicóloga clínica especializada em Terapia Cognitivo-Comportamental (TCC), com atendimento presencial e online.',
    'identifier'    => SITE_CRP,
    'knowsLanguage' => 'pt-BR',
    'knowsAbout'    => [
        'Terapia Cognitivo-Comportamental', 'Ansiedade', 'Depressão', 'Orientação de Pais',
        'Supervisão Clínica', 'Terapia de Aceitação e Compromisso (ACT)',
        'Terapia Comportamental Dialética (DBT)', 'Terapia do Esquema',
        'Terapia Focada na Compaixão', 'Autocompaixão', 'Regulação Emocional', 'Mindfulness',
    ],
    'telephone'     => SITE_PHONE_E164,
    'email'         => SITE_EMAIL,
    'address'       => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Avenida 15 de Novembro, 418 - Centro',
        'addressLocality' => 'Jaboticabal',
        'addressRegion' => 'SP',
        'postalCode' => '14870-600',
        'addressCountry' => 'BR',
    ],
    'sameAs'        => [SITE_INSTAGRAM_URL],
    'areaServed'    => ['@type' => 'Country', 'name' => 'Brasil'],
    'availableService' => [
        ['@type' => 'MedicalTherapy', 'name' => 'Atendimento Clínico em TCC'],
        ['@type' => 'MedicalTherapy', 'name' => 'Orientação de Pais'],
        ['@type' => 'Service', 'name' => 'Supervisão para Psicólogos'],
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

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: { extend: {
        colors: {
          'teal-dark':'#117B7F','teal-mid':'#1FB6A8','magenta':'#A52A7E','amber':'#F2A91E','cream':'#FCF9F5','ink':'#1F3334',
          background:'#FCF9F5', foreground:'#1F3334', primary:'#117B7F', muted:'#F1EBE1', accent:'#F2A91E'
        },
        fontFamily: {
          display: ['"Cormorant Garamond"','ui-serif','Georgia','serif'],
          heading: ['"Fraunces"','ui-serif','Georgia','serif'],
          sans:    ['"Manrope"','ui-sans-serif','system-ui','sans-serif']
        }
      } }
    }
  </script>
  <style>
    body{font-family:"Manrope",ui-sans-serif,system-ui,sans-serif;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;}
    h1,h2,h3,h4{font-family:"Fraunces",ui-serif,Georgia,serif;letter-spacing:-0.01em;}
    .font-display{font-family:"Cormorant Garamond",ui-serif,Georgia,serif;}
    .font-heading{font-family:"Fraunces",ui-serif,Georgia,serif;}
    ::selection{background:#A52A7E;color:#FCF9F5;}
    .blob-1{border-radius:40% 60% 70% 30% / 40% 50% 60% 40%;}
    .blob-2{border-radius:60% 40% 30% 70% / 50% 30% 70% 50%;}
    .blob-3{border-radius:30% 70% 50% 50% / 60% 40% 60% 40%;}
    /* Anti-CLS enquanto o Tailwind carrega */
    header > div{min-height:80px;}
    /* Microinterações / efeitos */
    a,button{transition:color .2s ease, background-color .2s ease, transform .2s ease, box-shadow .2s ease;}
    /* Cabeçalho: vidro fosco ao rolar (desktop) + logo 20% maior no topo */
    .site-header{transition:background .3s ease, backdrop-filter .3s ease, box-shadow .3s ease, border-color .3s ease;
      background:rgba(252,249,245,.88); -webkit-backdrop-filter:blur(8px); backdrop-filter:blur(8px);
      border-bottom:1px solid rgba(17,123,127,.05);}
    .site-logo{height:2.25rem; transition:height .3s ease;}
    @media (min-width:1024px){
      .site-header{background:transparent; -webkit-backdrop-filter:none; backdrop-filter:none; border-bottom-color:transparent; box-shadow:none;}
      .site-header.scrolled{background:rgba(252,249,245,.72); -webkit-backdrop-filter:blur(14px) saturate(150%); backdrop-filter:blur(14px) saturate(150%); box-shadow:0 10px 34px rgba(17,123,127,.12); border-bottom-color:rgba(17,123,127,.06);}
      .site-header:not(.scrolled) .site-logo{height:2.7rem;} /* +20% no início */
    }
    .reveal{opacity:0;transform:translateY(20px);transition:opacity .7s cubic-bezier(.2,.7,.2,1),transform .7s cubic-bezier(.2,.7,.2,1);}
    .reveal.is-visible{opacity:1;transform:none;}
    details>summary{transition:color .2s ease;} details[open]>summary{color:#A52A7E;}
    .skip-link{position:absolute;left:-9999px;top:0;z-index:100;background:#117B7F;color:#FCF9F5;padding:.65rem 1.1rem;border-radius:0 0 .6rem 0;font-weight:600;}
    .skip-link:focus{left:0;}
    @media (prefers-reduced-motion: reduce){
      .reveal{opacity:1 !important;transform:none !important;transition:none !important;}
      *{scroll-behavior:auto !important;}
    }
    html{scroll-behavior:smooth;}
  </style>

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
  <?php render_breadcrumbs(); ?>
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
