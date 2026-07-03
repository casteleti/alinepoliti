<?php
/**
 * Importa os 16 artigos de fábrica (app/seed_artigos.php) para a tabela `posts`,
 * já com SEO/GEO completo: recorta as referências do texto → campo `fontes`,
 * aplica meta título/descrição, palavra-chave, tags automáticas, TL;DR e FAQ
 * (de app/seed_blog_seo.php).
 *
 * Uso (com MySQL configurado): php bin/seed.php
 * Idempotente (slug como chave). NÃO sobrescreve a capa já enviada.
 */
declare(strict_types=1);

require __DIR__ . '/../app/config.php';
require __DIR__ . '/../app/db.php';
require __DIR__ . '/../app/helpers.php';

$pdo = db();
if (!$pdo) {
    fwrite(STDERR, "MySQL indisponível. Configure app/config.php e importe schema.sql primeiro.\n");
    exit(1);
}

$artigos = require __DIR__ . '/../app/seed_artigos.php';
$seoAll  = require __DIR__ . '/../app/seed_blog_seo.php';

$sql = 'INSERT INTO posts (slug, titulo, resumo, conteudo, meta_titulo, meta_descricao, keyword_foco, tags, tldr, faq, fontes, publicado_em, ativo)
        VALUES (:slug, :titulo, :resumo, :conteudo, :meta_titulo, :meta_descricao, :keyword_foco, :tags, :tldr, :faq, :fontes, :pub, 1)
        ON DUPLICATE KEY UPDATE titulo=VALUES(titulo), resumo=VALUES(resumo), conteudo=VALUES(conteudo),
          meta_titulo=VALUES(meta_titulo), meta_descricao=VALUES(meta_descricao), keyword_foco=VALUES(keyword_foco),
          tags=VALUES(tags), tldr=VALUES(tldr), faq=VALUES(faq), fontes=VALUES(fontes),
          publicado_em=VALUES(publicado_em), ativo=1';
$stmt = $pdo->prepare($sql);

$n = 0;
foreach ($artigos as $a) {
    $seo = $seoAll[$a['slug']] ?? [];
    // recorta referências do fim do texto → fontes
    [$conteudo, $fontes] = blog_extrair_referencias((string)$a['conteudo']);
    // enriquecimento: abertura com a palavra-chave + fechamento útil
    $lead = isset($seo['lead']) ? $seo['lead'] . "\n\n" : '';
    $comp = isset($seo['complemento']) ? "\n\n" . $seo['complemento'] : '';
    $conteudo = trim($lead . $conteudo . $comp);
    $faq  = !empty($seo['faq'])  ? json_encode($seo['faq'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null;
    $tldr = !empty($seo['tldr']) ? implode("\n", $seo['tldr']) : null;

    $stmt->execute([
        ':slug'           => $a['slug'],
        ':titulo'         => $a['titulo'],
        ':resumo'         => $a['resumo'],
        ':conteudo'       => $conteudo,
        ':meta_titulo'    => $seo['meta_titulo'] ?? null,
        ':meta_descricao' => $seo['meta_descricao'] ?? null,
        ':keyword_foco'   => $seo['keyword_foco'] ?? null,
        ':tags'           => implode(', ', blog_extrair_tags($a['titulo'], $conteudo, 10)),
        ':tldr'           => $tldr,
        ':faq'            => $faq,
        ':fontes'         => $fontes ? implode("\n", $fontes) : null,
        ':pub'            => date('Y-m-d H:i:s', strtotime((string)$a['publicado_em'])),
    ]);
    $n++;
    echo "✓ {$a['slug']}" . ($fontes ? ' (' . count($fontes) . ' ref.)' : '') . "\n";
}
echo "\n{$n} artigos importados/atualizados com SEO/GEO.\n";
