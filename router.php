<?php
/**
 * Router APENAS para o servidor embutido do PHP em desenvolvimento:
 *   php -S localhost:8000 router.php
 * Serve arquivos reais (assets) e envia o resto ao front controller.
 * Em produção (Apache) este arquivo não é usado — quem roteia é o .htaccess.
 */
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
$file = __DIR__ . '/public' . $path;
if ($path !== '/' && is_file($file)) {
    return false; // deixa o servidor embutido servir o arquivo estático
}
require __DIR__ . '/public/index.php';
