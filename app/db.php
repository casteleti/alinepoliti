<?php
declare(strict_types=1);

/**
 * Conexão PDO com MySQL — resiliente.
 * Retorna null (sem quebrar a página) se o banco não estiver disponível,
 * permitindo que o site funcione com conteúdo padrão antes de configurar o DB.
 */
function db(): ?PDO
{
    static $pdo = null;
    static $tried = false;
    if ($tried) {
        return $pdo;
    }
    $tried = true;

    try {
        $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
        $pdo = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_TIMEOUT            => 3, // nunca trava a página se o DB estiver fora
        ]);
    } catch (Throwable $e) {
        error_log('[alinepoliti] DB indisponível: ' . $e->getMessage());
        $pdo = null;
    }

    return $pdo;
}
