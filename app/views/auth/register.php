<div class="flex items-center justify-center min-h-screen">
  <div class="bg-white w-full max-w-md p-8 rounded-xl shadow">

    <h1 class="text-2xl font-bold text-center text-blue-600 mb-2">
      Smart Wallet
    </h1>
    <p class="text-center text-gray-500 mb-6">
      Create a new account
    </p>

    <?php if (!empty($errors)): ?>
      <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <?php foreach ($errors as $error): ?>
          <p><?= htmlspecialchars($error) ?></p>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
      <input type="text" name="full_name" placeholder="Full name"
             class="w-full border p-2 rounded" required>

      <input type="email" name="email" placeholder="Email"
             class="w-full border p-2 rounded" required>

      <input type="password" name="password" placeholder="Password"
             class="w-full border p-2 rounded" required>

      <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
        Register
      </button>
    </form>

    <p class="text-center text-sm text-gray-500 mt-4">
      Already have an account?
      <a href="<?= BASE_URL ?>/auth/login"
         class="text-blue-600 hover:underline">
        Login
      </a>
    </p>

  </div>
</div>
