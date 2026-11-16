<?php
declare(strict_types=1);

/**
 * Conexão com SQLite para PetShop (petshop.db)
 * Salva o arquivo petshop.db na pasta pai deste arquivo.
 */
class Database {
    public static function getConnection(): PDO
    {
        $dbFile = __DIR__ . '/petshop.db'; // caminho ajustado para a raiz do projeto
        $dsn = "sqlite:" . $dbFile;

        try {
            $pdo = new PDO($dsn);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // Habilita foreign keys
            $pdo->exec('PRAGMA foreign_keys = ON');
            return $pdo;
        } catch (PDOException $e) {
            // Em produção, registre o erro em log em vez de exibir
            throw new RuntimeException('Erro ao conectar ao banco de dados SQLite: ' . $e->getMessage());
        }
    }
}


/*
 *Exemplo de uso:
 *$pdo = Database::getConnection();
 *$stmt = $pdo->query('SELECT sqlite_version() AS v');
 *echo $stmt->fetchColumn();
*/