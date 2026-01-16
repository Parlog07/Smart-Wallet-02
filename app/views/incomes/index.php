<h2 class="text-2xl font-bold mb-6">Incomes</h2>

<form method="GET" class="mb-4">
  <select name="category" onchange="this.form.submit()" class="border p-2 rounded">
    <option value="">All categories</option>
    <?php foreach ($categories as $c): ?>
      <option value="<?= $c['id'] ?>" <?= ($categoryId == $c['id']) ? 'selected' : '' ?>>
        <?= htmlspecialchars($c['name']) ?>
      </option>
    <?php endforeach; ?>
  </select>
</form>

<button id="openAddIncome" class="bg-green-600 text-white px-4 py-2 rounded mb-4">
  + Add Income
</button>

<div class="bg-white rounded shadow overflow-hidden">
  <table class="min-w-full divide-y">
    <thead class="bg-blue-100">
      <tr>
        <th class="px-4 py-2 text-left">Amount</th>
        <th class="px-4 py-2 text-left">Description</th>
        <th class="px-4 py-2 text-left">Category</th>
        <th class="px-4 py-2 text-left">Date</th>
        <th class="px-4 py-2 text-left">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($incomes as $i): ?>
      <tr class="border-t">
        <td class="px-4 py-2"><?= number_format($i["amount"], 2) ?> MAD</td>
        <td class="px-4 py-2"><?= htmlspecialchars($i["description"]) ?></td>
        <td class="px-4 py-2"><?= htmlspecialchars($i["category"]) ?></td>
        <td class="px-4 py-2"><?= $i["income_date"] ?></td>
        <td class="px-4 py-2">
          <button
            class="edit-btn text-blue-600 mr-3"
            data-id="<?= $i["id"] ?>"
            data-amount="<?= $i["amount"] ?>"
            data-description="<?= htmlspecialchars($i["description"]) ?>"
            data-date="<?= $i["income_date"] ?>"
            data-category="<?= $i["category_id"] ?>"
          >Edit</button>

          <a href="<?= BASE_URL ?>/income/delete/<?= $i["id"] ?>"
             class="text-red-600"
             onclick="return confirm('Delete this income?')">
            Delete
          </a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<!-- ADD MODAL -->
<div id="addModal" class="fixed inset-0 hidden bg-black/40 flex items-center justify-center">
  <form method="POST" action="<?= BASE_URL ?>/income/store" class="bg-white p-6 rounded w-96">
    <h3 class="text-lg font-bold mb-4">Add Income</h3>

    <select name="category_id" required class="w-full border p-2 mb-3">
      <option value="">Select category</option>
      <?php foreach ($categories as $c): ?>
        <option value="<?= $c["id"] ?>"><?= htmlspecialchars($c["name"]) ?></option>
      <?php endforeach; ?>
    </select>

    <input name="amount" type="number" step="0.01" required class="w-full border p-2 mb-3">
    <input name="description" type="text" required class="w-full border p-2 mb-3">
    <input name="income_date" type="date" required class="w-full border p-2 mb-4">

    <div class="flex justify-end gap-2">
      <button type="button" id="closeAdd" class="border px-4 py-2">Cancel</button>
      <button class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
    </div>
  </form>
</div>

<!-- EDIT MODAL -->
<div id="editModal" class="fixed inset-0 hidden bg-black/40 flex items-center justify-center">
  <form id="editForm" method="POST" class="bg-white p-6 rounded w-96">
    <h3 class="text-lg font-bold mb-4">Edit Income</h3>

    <select id="editCategory" name="category_id" required class="w-full border p-2 mb-3">
      <?php foreach ($categories as $c): ?>
        <option value="<?= $c["id"] ?>"><?= htmlspecialchars($c["name"]) ?></option>
      <?php endforeach; ?>
    </select>

    <input id="editAmount" name="amount" type="number" step="0.01" required class="w-full border p-2 mb-3">
    <input id="editDescription" name="description" type="text" required class="w-full border p-2 mb-3">
    <input id="editDate" name="income_date" type="date" required class="w-full border p-2 mb-4">

    <div class="flex justify-end gap-2">
      <button type="button" id="closeEdit" class="border px-4 py-2">Cancel</button>
      <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </div>
  </form>
</div>

<script>
const addModal = document.getElementById("addModal");
const editModal = document.getElementById("editModal");

document.getElementById("openAddIncome").onclick = () => addModal.classList.remove("hidden");
document.getElementById("closeAdd").onclick = () => addModal.classList.add("hidden");

document.querySelectorAll(".edit-btn").forEach(btn => {
  btn.onclick = () => {
    editModal.classList.remove("hidden");
    editAmount.value = btn.dataset.amount;
    editDescription.value = btn.dataset.description;
    editDate.value = btn.dataset.date;
    editCategory.value = btn.dataset.category;
    editForm.action = "<?= BASE_URL ?>/income/update/" + btn.dataset.id;
  };
});

document.getElementById("closeEdit").onclick = () => editModal.classList.add("hidden");
</script>
