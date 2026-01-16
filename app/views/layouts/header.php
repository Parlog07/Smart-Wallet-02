<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Smart Wallet</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
<div class="flex">

    <?php
    // Hide sidebar on auth pages
    $url = $_GET['url'] ?? '';
    if (!str_starts_with($url, 'auth')):
        require_once __DIR__ . '/sidebar.php';
    endif;
    ?>

    <!-- Main content -->
    <main class="flex-1 p-6">
