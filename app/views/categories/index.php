<div class="flex items-center justify-between mb-6">
    <h2 class="text-2xl font-bold">Category Limits</h2>
</div>

<?php if (!empty($error)): ?>
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>
<div class="bg-white p-4 rounded shadow mb-6">
    <h3 class="text-lg font-bold mb-3">Add Category</h3>

    <form method="POST" action="<?= BASE_URL ?>/category/store" class="flex gap-3">
        <input
            type="text"
            name="name"
            placeholder="Category name"
            required
            class="border p-2 rounded flex-1"
        >

        <select name="type" required class="border p-2 rounded">
            <option value="">Type</option>
            <option value="income">Income</option>
            <option value="expense">Expense</option>
        </select>

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Add
        </button>
    </form>
</div>

<div class="bg-white rounded shadow overflow-hidden">
    <table class="min-w-full divide-y">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-3 text-left text-sm">Category</th>
                <th class="px-4 py-3 text-left text-sm">Monthly Limit (MAD)</th>
                <th class="px-4 py-3 text-left text-sm">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td class="px-4 py-3 font-medium">
                        <?= htmlspecialchars($category["name"]) ?>
                    </td>

                    <td class="px-4 py-3">
                        <?= isset($limits[$category["id"]])
                            ? number_format($limits[$category["id"]], 2)
                            : "-" ?>
                    </td>

                    <td class="px-4 py-3">
                        <form method="POST" class="flex gap-2">
                            <input type="hidden"
                                   name="category_id"
                                   value="<?= $category["id"] ?>">

                            <input
                                type="number"
                                name="monthly_limit"
                                step="0.01"
                                min="0.01"
                                required
                                placeholder="Limit"
                                class="border p-2 rounded w-32"
                            >

                            <button
                                class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700">
                                Save
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
