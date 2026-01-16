<?php

class IncomeController extends Controller
{
    public function index()
    {
        $this->requireAuth();

        $income = new Income();
        $category = new Category();

        $incomes = $income->getAllByUser($_SESSION['user_id']);
        $categories = $category->getIncomeCategories($_SESSION['user_id']);

        $this->view('incomes/index', [
            'incomes' => $incomes,
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
            $date = $_POST['income_date'] ?? '';

            if (!$amount || !$categoryId || !$date) {
                header('Location: ' . BASE_URL . '/income/index');
                exit;
            }

            $income = new Income();
            $income->create(
                $amount,
                $description,
                $categoryId,
                $date,
                $_SESSION['user_id']
            );

            header('Location: ' . BASE_URL . '/income/index');
            exit;
        }
    }
}
