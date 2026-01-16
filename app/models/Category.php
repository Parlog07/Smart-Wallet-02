<?php

class Category extends Model
{
    public function getAllByUser($userId)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM categories WHERE user_id = :uid ORDER BY created_at DESC"
        );
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll();
    }

    public function create($name, $type, $userId)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO categories (name, type, user_id)
             VALUES (:name, :type, :uid)"
        );

        return $stmt->execute([
            'name' => $name,
            'type' => $type,
            'uid'  => $userId
        ]);
    }
    public function getIncomeCategories($userId)
{
    $stmt = $this->db->prepare(
        "SELECT * FROM categories
         WHERE user_id = :uid AND type = 'income'
         ORDER BY name ASC"
    );
    $stmt->execute(['uid' => $userId]);
    return $stmt->fetchAll();
}

}
