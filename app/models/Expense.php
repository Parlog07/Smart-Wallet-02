<?php

class Expense extends Model
{
    public function getAllByUser($userId, $categoryId = null)
{
    $sql = "SELECT e.*, c.name AS category
            FROM expenses e
            LEFT JOIN categories c ON c.id = e.category_id
            WHERE e.user_id = :uid";

    $params = ['uid' => $userId];

    if ($categoryId) {
        $sql .= " AND e.category_id = :cid";
        $params['cid'] = $categoryId;
    }

    $sql .= " ORDER BY e.expense_date DESC";

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll();
}


    public function create($amount, $description, $categoryId, $date, $userId)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO expenses (amount, description, category_id, expense_date, user_id)
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
}
