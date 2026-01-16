<?php

class IncomeController extends Controller
{
   public function index()
{
    $this->requireAuth();

    $incomeModel = new Income();
    $categoryModel = new Category();

    $categoryId = $_GET['category'] ?? null;

    $incomes = $incomeModel->getAllByUser(
        $_SESSION['user_id'],
        $categoryId
    );

    $categories = $categoryModel->getIncomeCategories($_SESSION['user_id']);

    $this->view('incomes/index', [
        'incomes' => $incomes,
        'categories' => $categories,
        'categoryId' => $categoryId
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
    public function edit($id)
{
    $this->requireAuth();

    $income = new Income();
    $category = new Category();

    $data = $income->findById($id, $_SESSION['user_id']);
    $categories = $category->getIncomeCategories($_SESSION['user_id']);

    if (!$data) {
        header('Location: ' . BASE_URL . '/income/index');
        exit;
    }

    $this->view('incomes/edit', [
        'income' => $data,
        'categories' => $categories
    ]);
}

public function update($id)
{
    $this->requireAuth();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $income = new Income();
        $income->update(
            $id,
            $_POST['amount'],
            $_POST['description'],
            $_POST['category_id'],
            $_POST['income_date'],
            $_SESSION['user_id']
        );

        header('Location: ' . BASE_URL . '/income/index');
        exit;
    }
}

public function delete($id)
{
    $this->requireAuth();

    $income = new Income();
    $income->delete($id, $_SESSION['user_id']);

    header('Location: ' . BASE_URL . '/income/index');
    exit;
}

}
