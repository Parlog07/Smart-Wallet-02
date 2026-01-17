<?php

class AuthController extends Controller
{
    public function login()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                $errors[] = 'All fields are required';
            } else {
                $userModel = new User();
                $user = $userModel->findByEmail($email);

                if (!$user || !password_verify($password, $user['password'])) {
                    $errors[] = 'Invalid email or password';
                } else {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    header('Location: ' . BASE_URL . '/dashboard/index');
                    exit;
                }
            }
        }

        $this->view('auth/login', [
            'errors' => $errors
        ]);
    }

    public function register()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = trim($_POST['full_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($name === '' || $email === '' || $password === '') {
                $errors[] = 'All fields are required';
            } elseif (strlen($password) < 6) {
                $errors[] = 'Password must be at least 6 characters';
            } else {
                $userModel = new User();

                if ($userModel->findByEmail($email)) {
                    $errors[] = 'Email already exists';
                } else {
                    $userModel->create($name, $email, $password);
                    header('Location: ' . BASE_URL . '/auth/login');
                    exit;
                }
            }
        }

        $this->view('auth/register', [
            'errors' => $errors
        ]);
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }
}
