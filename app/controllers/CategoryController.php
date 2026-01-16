<?php

class CategoryController extends Controller
{
    public function index()
{
    $this->requireAuth();

    $categoryModel = new Category();

    $error = null;
    $success = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $categoryId = $_POST['category_id'] ?? null;
        $limit = $_POST['monthly_limit'] ?? null;

        if (!$categoryId || !$limit || $limit <= 0) {
            $error = 'Invalid limit value';
        } else {
            $categoryModel->updateLimit(
                $categoryId,
                $limit,
                $_SESSION['user_id']
            );
            $success = 'Monthly limit saved successfully';
        }
    }

    $categories = $categoryModel->getAllByUser($_SESSION['user_id']);

    // build limits array like old code
    $limits = [];
    foreach ($categories as $c) {
        if ($c['monthly_limit'] !== null) {
            $limits[$c['id']] = $c['monthly_limit'];
        }
    }

    $this->view('categories/index', [
        'categories' => $categories,
        'limits'     => $limits,
        'error'      => $error,
        'success'    => $success
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
