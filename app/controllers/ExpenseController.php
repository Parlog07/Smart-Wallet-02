<?php

class ExpenseController extends Controller
{
    public function index()
    {
        $this->requireAuth();

        $expense = new Expense();
        $category = new Category();

        $expenses = $expense->getAllByUser($_SESSION['user_id']);
        $categories = $category->getExpenseCategories($_SESSION['user_id']);

        $this->view('expenses/index', [
            'expenses' => $expenses,
            'categories' => $categories
        ]);
    }

    public function store()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $amount = $_POST['amount'] ?? '';
            $description = trim($_POST['description'] ?? '');
            $categoryId = $_POST['category_id'] ?? '';
            $date = $_POST['expense_date'] ?? '';

            if (!$amount || !$categoryId || !$date) {
                header('Location: ' . BASE_URL . '/expense/index');
                exit;
            }

            $expense = new Expense();
            $expense->create(
                $amount,
                $description,
                $categoryId,
                $date,
                $_SESSION['user_id']
            );

            header('Location: ' . BASE_URL . '/expense/index');
            exit;
        }
    }
}
