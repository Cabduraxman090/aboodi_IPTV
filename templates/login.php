<h2>User Login</h2>

<?php
if (isset($_SESSION['success_message'])) {
    echo '<div style="color: green; background-color: #ccffcc; border: 1px solid green; padding: 10px; margin-bottom: 15px; border-radius: 4px;">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
    unset($_SESSION['success_message']); // Clear the message after displaying it
}
?>

<p>The login form will be here.</p>
