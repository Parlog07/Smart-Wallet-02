<h1>Dashboard</h1>

<p><strong>Total Income:</strong> <?= number_format($totalIncome, 2) ?></p>
<p><strong>Total Expense:</strong> <?= number_format($totalExpense, 2) ?></p>
<p><strong>Balance:</strong> <?= number_format($balance, 2) ?></p>

<hr>

<a href="<?= BASE_URL ?>/income/index">Incomes</a> |
<a href="<?= BASE_URL ?>/expense/index">Expenses</a> |
<a href="<?= BASE_URL ?>/category/index">Categories</a> |
<a href="<?= BASE_URL ?>/auth/logout">Logout</a>
