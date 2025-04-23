<?php

namespace app\models;

class Message extends Model
{
    protected string $table = 'messages';

    public function saveMessage(array $data): bool
    {
        $query = "INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)";
        return $this->execute($query, $data);
    }

    public function getAllMessages(): array
    {
        return $this->fetchAll("SELECT * FROM $this->table ORDER BY created_at DESC");
    }
}
