<?php

class Income extends Model
{
    public function getAllByUser($userId)
    {
        $stmt = $this->db->prepare(
            "SELECT i.*, c.name AS category_name
             FROM incomes i
             LEFT JOIN categories c ON c.id = i.category_id
             WHERE i.user_id = :uid
             ORDER BY i.income_date DESC"
        );
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetchAll();
    }

    public function create($amount, $description, $categoryId, $date, $userId)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO incomes (amount, description, category_id, income_date, user_id)
             VALUES (:amount, :description, :category_id, :date, :user_id)"
        );

        return $stmt->execute([
            'amount' => $amount,
            'description' => $description,
            'category_id' => $categoryId,
            'date' => $date,
            'user_id' => $userId
        ]);
    }
    public function findById($id, $userId)
{
    $stmt = $this->db->prepare(
        "SELECT * FROM incomes WHERE id = :id AND user_id = :uid"
    );
    $stmt->execute([
        'id' => $id,
        'uid' => $userId
    ]);
    return $stmt->fetch();
}

public function update($id, $amount, $description, $categoryId, $date, $userId)
{
    $stmt = $this->db->prepare(
        "UPDATE incomes
         SET amount = :amount,
             description = :description,
             category_id = :category_id,
             income_date = :date
         WHERE id = :id AND user_id = :uid"
    );

    return $stmt->execute([
        'amount' => $amount,
        'description' => $description,
        'category_id' => $categoryId,
        'date' => $date,
        'id' => $id,
        'uid' => $userId
    ]);
}

public function delete($id, $userId)
{
    $stmt = $this->db->prepare(
        "DELETE FROM incomes WHERE id = :id AND user_id = :uid"
    );
    return $stmt->execute([
        'id' => $id,
        'uid' => $userId
    ]);
}

}
