<?php

class DashboardController extends Controller
{
    public function index()
    {
        $this->requireAuth();

        $dashboard = new Dashboard();

        $totalIncome  = $dashboard->getTotalIncome($_SESSION['user_id']);
        $totalExpense = $dashboard->getTotalExpense($_SESSION['user_id']);
        $balance = $totalIncome - $totalExpense;

        $this->view('dashboard/index', [
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
            'balance' => $balance
        ]);
    }
}
