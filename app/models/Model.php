<?php

namespace app\models;

use PDO;
use PDOException;

abstract class Model
{
    protected PDO $pdo;
    protected string $table;

    public function __construct()
    {
        $this->pdo = $this->connect();
    }

    private function connect(): PDO
    {
        $dsn = "mysql:hostname=" . DBHOST . ";dbname=" . DBNAME;
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            return new PDO($dsn, DBUSER, DBPASS, $options);
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
