<?php

class Dashboard extends Model
{
    public function getTotalIncome($userId)
    {
        $stmt = $this->db->prepare(
            "SELECT COALESCE(SUM(amount), 0) AS total
             FROM incomes
             WHERE user_id = :uid"
        );
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetch()['total'];
    }

    public function getTotalExpense($userId)
    {
        $stmt = $this->db->prepare(
            "SELECT COALESCE(SUM(amount), 0) AS total
             FROM expenses
             WHERE user_id = :uid"
        );
        $stmt->execute(['uid' => $userId]);
        return $stmt->fetch()['total'];
    }
}
