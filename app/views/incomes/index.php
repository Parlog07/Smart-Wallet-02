<h2>Incomes</h2>

<form method="POST" action="<?= BASE_URL ?>/income/store">
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

    <input type="date" name="income_date" required>

    <button type="submit">Add Income</button>
</form>

<hr>

<table border="1" cellpadding="5">
    <tr>
        <th>Date</th>
        <th>Amount</th>
        <th>Category</th>
        <th>Description</th>
    </tr>

    <?php foreach ($incomes as $income): ?>
        <tr>
            <td><?= htmlspecialchars($income['income_date']) ?></td>
            <td><?= htmlspecialchars($income['amount']) ?></td>
            <td><?= htmlspecialchars($income['category_name']) ?></td>
            <td><?= htmlspecialchars($income['description']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
