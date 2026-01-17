<?php

class DashboardController extends Controller
{
    public function index()
    {
        $this->requireAuth();

        $dashboard = new Dashboard();

        $totals = $dashboard->getTotals($_SESSION['user_id']);
        $monthly = $dashboard->getMonthlyData($_SESSION['user_id']);

        $total_income = $totals['income'];
        $total_expense = $totals['expense'];
        $balance = $total_income - $total_expense;

        $this->view('dashboard/index', [
            'total_income' => $total_income,
            'total_expense' => $total_expense,
            'balance' => $balance,
            'monthLabels' => $monthly['labels'],
            'incomeData' => $monthly['income'],
            'expenseData' => $monthly['expense']
        ]);
    }
}
