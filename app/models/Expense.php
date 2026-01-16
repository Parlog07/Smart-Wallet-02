<?php

class Expense extends Model
{
    public function getAllByUser($userId)
    {
        $stmt = $this->db->prepare(
            "SELECT e.*, c.name AS category_name
             FROM expenses e
             LEFT JOIN categories c ON c.id = e.category_id
             WHERE e.user_id = :uid
             ORDER BY e.expense_date DESC"
        );
        $stmt->execute(['uid' => $userId]);
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
