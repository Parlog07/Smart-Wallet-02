<h2>Categories</h2>

<form method="POST" action="<?= BASE_URL ?>/category/store">
    <input type="text" name="name" placeholder="Category name" required>

    <select name="type" required>
        <option value="">Type</option>
        <option value="income">Income</option>
        <option value="expense">Expense</option>
    </select>

    <button type="submit">Add Category</button>
</form>

<hr>

<ul>
<?php foreach ($categories as $cat): ?>
    <li>
        <?= htmlspecialchars($cat['name']) ?>
        (<?= htmlspecialchars($cat['type']) ?>)
    </li>
<?php endforeach; ?>
</ul>
