<?php

class Dashboard extends Model
{
    public function getTotals($userId)
    {
        $income = $this->db->prepare(
            "SELECT COALESCE(SUM(amount),0) FROM incomes WHERE user_id = :uid"
        );
        $income->execute(['uid' => $userId]);

        $expense = $this->db->prepare(
            "SELECT COALESCE(SUM(amount),0) FROM expenses WHERE user_id = :uid"
        );
        $expense->execute(['uid' => $userId]);

        return [
            'income' => $income->fetchColumn(),
            'expense' => $expense->fetchColumn()
        ];
    }

    public function getMonthlyData($userId)
    {
        $months = [];
        $incomeData = [];
        $expenseData = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = date('Y-m', strtotime("-$i months"));
            $months[] = date('M Y', strtotime($month));

            $inc = $this->db->prepare(
                "SELECT COALESCE(SUM(amount),0)
                 FROM incomes
                 WHERE user_id = :uid
                 AND TO_CHAR(income_date,'YYYY-MM') = :m"
            );
            $inc->execute(['uid' => $userId, 'm' => $month]);
            $incomeData[] = $inc->fetchColumn();

            $exp = $this->db->prepare(
                "SELECT COALESCE(SUM(amount),0)
                 FROM expenses
                 WHERE user_id = :uid
                 AND TO_CHAR(expense_date,'YYYY-MM') = :m"
            );
            $exp->execute(['uid' => $userId, 'm' => $month]);
            $expenseData[] = $exp->fetchColumn();
        }

        return [
            'labels' => $months,
            'income' => $incomeData,
            'expense' => $expenseData
        ];
    }
}
