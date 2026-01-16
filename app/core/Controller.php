<?php

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        require_once "../app/views/$view.php";
    }

    protected function requireAuth()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
    }
}
