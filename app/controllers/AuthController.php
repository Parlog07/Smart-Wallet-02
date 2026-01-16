<?php

class AuthController extends Controller
{
    public function login()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === '' || $password === '') {
            $this->view('auth/login', ['error' => 'All fields are required']);
            return;
        }

        $user = new User();
        $foundUser = $user->findByEmail($email);

        if (!$foundUser) {
            $this->view('auth/login', ['error' => 'Invalid email or password']);
            return;
        }

        if (!password_verify($password, $foundUser['password'])) {
            $this->view('auth/login', ['error' => 'Invalid email or password']);
            return;
        }

        // LOGIN SUCCESS
        $_SESSION['user_id'] = $foundUser['id'];
        $_SESSION['username'] = $foundUser['username'];

        header('Location: ' . BASE_URL . '/dashboard/index');
        exit;
    }

    $this->view('auth/login');
}


   public function register()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = trim($_POST['username']);
        $email    = trim($_POST['email']);
        $password = $_POST['password'];

        if (!$username || !$email || !$password) {
            $this->view('auth/register', ['error' => 'All fields are required']);
            return;
        }

        $user = new User();

        if ($user->findByEmail($email)) {
            $this->view('auth/register', ['error' => 'Email already exists']);
            return;
        }

        $user->create($username, $email, $password);
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }

    $this->view('auth/register');
}


    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/auth/login');
        exit;
    }
}
