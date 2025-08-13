<?php
session_start(); // Start the session at the very beginning

// This will be our simple router.
$page = $_GET['page'] ?? 'home';

// Basic security: Whitelist of allowed pages.
$allowed_pages = ['home', 'register', 'login', 'dashboard'];

if (in_array($page, $allowed_pages)) {
    // Include the header
    include '../templates/header.php';

    // Include the requested page
    include "../templates/{$page}.php";

    // Include the footer
    include '../templates/footer.php';
} else {
    // If the page is not found, show a 404 error
    http_response_code(404);
    echo "<h1>404 Page Not Found</h1>";
}
