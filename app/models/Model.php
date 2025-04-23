<?php

namespace app\models;

use app\core\Dotenv;
use PDO;
use PDOException;

abstract class Model
{
    protected PDO $pdo;
    protected string $table;

    public function __construct()
    {
        $this->loadEnv();
        $this->pdo = $this->connect();
    }

    private function loadEnv(): void
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->safeLoad();
    }

    private function connect(): PDO
    {
        $host = $_ENV['DBHOST'] ?? 'localhost';
        $db   = $_ENV['DBNAME'] ?? 'portfolio_db';
        $user = $_ENV['DBUSER'] ?? 'root';
        $pass = $_ENV['DBPASS'] ?? '';
        $port = $_ENV['DBPORT'] ?? '8888';

        $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            return new PDO($dsn, $user, $pass, $options);
        } catch (PDOException $e) {
            throw new PDOException("DB connection failed: " . $e->getMessage(), $e->getCode());
        }
    }

    public function fetch(string $query): mixed
    {
        return $this->pdo->query($query)->fetch();
    }

    public function fetchAll(string $query): array
    {
        return $this->pdo->query($query)->fetchAll();
    }

    public function fetchAllWithParams(string $query, array $data = []): array|false
    {
        $stmt = $this->pdo->prepare($query);
        $success = $stmt->execute($data);
        return $success ? $stmt->fetchAll() : false;
    }

    public function execute(string $query, array $data = []): bool
    {
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($data);
    }
}
