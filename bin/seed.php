<?php
/**
 * Importa os 6 artigos de fábrica (app/seed_artigos.php) para a tabela `posts`.
 * Uso (com MySQL configurado em app/config.php):
 *   php bin/seed.php
 * Idempotente: usa o slug como chave (atualiza se já existir).
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
$sql = 'INSERT INTO posts (slug, titulo, resumo, conteudo, publicado_em, ativo)
        VALUES (:slug, :titulo, :resumo, :conteudo, :pub, 1)
        ON DUPLICATE KEY UPDATE titulo=VALUES(titulo), resumo=VALUES(resumo),
          conteudo=VALUES(conteudo), publicado_em=VALUES(publicado_em), ativo=1';
$stmt = $pdo->prepare($sql);

$n = 0;
foreach ($artigos as $a) {
    $stmt->execute([
        ':slug' => $a['slug'],
        ':titulo' => $a['titulo'],
        ':resumo' => $a['resumo'],
        ':conteudo' => $a['conteudo'],
        ':pub' => date('Y-m-d H:i:s', strtotime((string)$a['publicado_em'])),
    ]);
    $n++;
    echo "✓ {$a['slug']}\n";
}
echo "\n{$n} artigos importados para o banco.\n";
