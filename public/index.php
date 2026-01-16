<?php
session_start();

require_once '../config/config.php';

/**
 * Load CORE classes ONCE (NO autoload for them)
 */
require_once '../app/core/Database.php';
require_once '../app/core/Model.php';
require_once '../app/core/Controller.php';
require_once '../app/core/App.php';

/**
 * Autoload ONLY controllers and models
 */
spl_autoload_register(function ($class) {

    $controllerPath = '../app/controllers/' . $class . '.php';
    if (file_exists($controllerPath)) {
        require_once $controllerPath;
        return;
    }

    $modelPath = '../app/models/' . $class . '.php';
    if (file_exists($modelPath)) {
        require_once $modelPath;
        return;
    }
});

// Run app
$app = new App();
