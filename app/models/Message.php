<?php

namespace app\models;

class Message extends Model
{
    protected string $table = 'messages';

    public function saveMessage(array $data): bool
    {
        $query = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)";
        $result = $this->execute($query, $data);

        if (!$result) {
            $this->logError();
        }

        return $result;
    }

    public function getAllMessages(): array
    {
        $query = "SELECT * FROM $this->table ORDER BY created_at DESC";
        return $this->fetchAll($query);
    }

    public function logError(): void
    {
        error_log('Error inserting data into the database.');
    }

    public function getMessageCount(): int
    {
        $query = "SELECT COUNT(*) FROM $this->table";
        $stmt = $this->pdo->query($query);
        return (int) $stmt->fetchColumn();
    }
}
