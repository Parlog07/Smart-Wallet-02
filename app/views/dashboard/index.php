<h1>Welcome <?= htmlspecialchars($_SESSION['username']) ?></h1>

<a href="<?= BASE_URL ?>/income/index">Incomes</a> |
<a href="<?= BASE_URL ?>/expense/index">Expenses</a> |
<a href="<?= BASE_URL ?>/category/index">Categories</a> |
<a href="<?= BASE_URL ?>/auth/logout">Logout</a>
