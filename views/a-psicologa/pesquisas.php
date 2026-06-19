<?php
/** /a-psicologa/pesquisas — índice das pesquisas (mestrado + graduação) */
page_hero('Pesquisas &', 'publicações', 'A Psicóloga', 'A ciência que sustenta a minha prática clínica — da graduação ao mestrado.');
?>
<section class="max-w-5xl mx-auto px-6 lg:px-8 pb-12 space-y-8">

  <p class="text-lg text-ink/75 leading-relaxed">
    Há quase duas décadas investigo um mesmo tema: como as <strong>relações entre pais e filhos</strong> e as
    <strong>práticas educativas parentais</strong> moldam o desenvolvimento. Não é um curso — é uma linha de pesquisa
    que começou na graduação, em 2007, e amadureceu no <strong>mestrado na USP</strong>.
  </p>

  <!-- Mestrado -->
  <article class="bg-white rounded-[2rem] border border-teal-dark/10 p-8 lg:p-10 hover:border-magenta/40 transition-colors">
    <span class="text-xs font-bold tracking-[0.25em] uppercase text-magenta">Mestrado · USP · 2017</span>
    <h2 class="font-heading text-2xl md:text-3xl text-teal-dark mt-2 mb-4">Práticas parentais e depressão materna</h2>
    <p class="text-ink/75 leading-relaxed">
      No mestrado em Psicologia pela <strong>USP</strong> (FFCLRP, Ribeirão Preto), na área de Saúde e Desenvolvimento,
      sob orientação da <strong>Dra. Sônia Regina Loureiro</strong>, investiguei as <strong>práticas educativas
      parentais</strong> de famílias e o comportamento de crianças que convivem com a <strong>depressão materna</strong>.
    </p>
    <p class="mt-4 text-ink/75 leading-relaxed">
      Acompanhei 42 famílias e confirmei como o cuidado parental pode proteger — ou adoecer — o desenvolvimento
      infantil. É essa base científica que sustenta hoje o meu trabalho de orientação de pais e o atendimento de
      crianças e adolescentes em TCC.
    </p>
    <a href="<?= url('/a-psicologa/pesquisas/mestrado') ?>" class="inline-flex items-center gap-2 mt-6 text-teal-dark font-semibold hover:text-magenta transition-colors">
      Ler a pesquisa completa <?= icon('arrow-right', 'size-4') ?>
    </a>
  </article>

  <!-- Graduação -->
  <article class="bg-white rounded-[2rem] border border-teal-dark/10 p-8 lg:p-10 hover:border-magenta/40 transition-colors">
    <span class="text-xs font-bold tracking-[0.25em] uppercase text-magenta">Graduação · UNAERP · 2011</span>
    <h2 class="font-heading text-2xl md:text-3xl text-teal-dark mt-2 mb-4">Estilos parentais e comportamento de adolescentes</h2>
    <p class="text-ink/75 leading-relaxed">
      Tudo começou na graduação em Psicologia pela <strong>UNAERP</strong> (Universidade de Ribeirão Preto, 2011). Na
      monografia <em>“Estilos parentais e comportamento de adolescentes”</em>, estudei como o modo de educar se reflete
      na adolescência — fase de descobertas, conflitos e construção da identidade.
    </p>
    <p class="mt-4 text-ink/75 leading-relaxed">
      Foi a semente da linha de pesquisa que aprofundei no mestrado. Esse olhar sobre os estilos parentais e a
      juventude embasa, até hoje, o meu cuidado com adolescentes e com as famílias.
    </p>
    <a href="<?= url('/a-psicologa/pesquisas/graduacao') ?>" class="inline-flex items-center gap-2 mt-6 text-teal-dark font-semibold hover:text-magenta transition-colors">
      Ler a pesquisa completa <?= icon('arrow-right', 'size-4') ?>
    </a>
  </article>

</section>
<?php cta_section(); ?>
