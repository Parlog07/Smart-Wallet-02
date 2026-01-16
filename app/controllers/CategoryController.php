<?php

class CategoryController extends Controller
{
    public function index()
    {
        $this->requireAuth();

        $category = new Category();
        $categories = $category->getAllByUser($_SESSION['user_id']);

        $this->view('categories/index', [
            'categories' => $categories
        ]);
    }

    public function store()
    {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = trim($_POST['name'] ?? '');
            $type = $_POST['type'] ?? '';

            if ($name === '' || !in_array($type, ['income', 'expense'])) {
                header('Location: ' . BASE_URL . '/category/index');
                exit;
            }

            $category = new Category();
            $category->create($name, $type, $_SESSION['user_id']);

            header('Location: ' . BASE_URL . '/category/index');
            exit;
        }
    }
}
