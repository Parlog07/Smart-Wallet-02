<h2>Expenses</h2>

<form method="POST" action="<?= BASE_URL ?>/expense/store">
    <input type="number" step="0.01" name="amount" placeholder="Amount" required>

    <input type="text" name="description" placeholder="Description">

    <select name="category_id" required>
        <option value="">Select category</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>">
                <?= htmlspecialchars($cat['name']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="date" name="expense_date" required>

    <button type="submit">Add Expense</button>
</form>

<hr>

<table border="1" cellpadding="5">
    <tr>
        <th>Date</th>
        <th>Amount</th>
        <th>Category</th>
        <th>Description</th>
    </tr>

    <?php foreach ($expenses as $expense): ?>
        <tr>
            <td><?= htmlspecialchars($expense['expense_date']) ?></td>
            <td><?= htmlspecialchars($expense['amount']) ?></td>
            <td><?= htmlspecialchars($expense['category_name']) ?></td>
            <td><?= htmlspecialchars($expense['description']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
