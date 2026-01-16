<aside class="w-64 bg-gray-900 text-white min-h-screen p-5">
    <h2 class="text-2xl font-bold mb-8">Smart Wallet</h2>

    <nav class="space-y-3">
        <a href="<?= BASE_URL ?>/dashboard/index"
           class="block px-3 py-2 rounded hover:bg-gray-700">
           Dashboard
        </a>

        <a href="<?= BASE_URL ?>/income/index"
           class="block px-3 py-2 rounded hover:bg-gray-700">
           Incomes
        </a>

        <a href="<?= BASE_URL ?>/expense/index"
           class="block px-3 py-2 rounded hover:bg-gray-700">
           Expenses
        </a>

        <a href="<?= BASE_URL ?>/category/index"
           class="block px-3 py-2 rounded hover:bg-gray-700">
           Categories
        </a>

        <hr class="border-gray-700 my-4">

        <a href="<?= BASE_URL ?>/auth/logout"
           class="block px-3 py-2 rounded bg-red-600 hover:bg-red-700">
           Logout
        </a>
    </nav>
</aside>
