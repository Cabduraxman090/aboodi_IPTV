<?php
session_start();
require_once '../src/database.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // --- Validation ---
    // 1. Check for empty fields
    if (empty($full_name) || empty($email) || empty($password) || empty($role)) {
        $_SESSION['error_message'] = "All fields are required.";
        header("Location: index.php?page=register");
        exit();
    }

    // 2. Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Invalid email format.";
        header("Location: index.php?page=register");
        exit();
    }

    // 3. Validate role
    $allowed_roles = ['student', 'parent', 'teacher'];
    if (!in_array($role, $allowed_roles)) {
        $_SESSION['error_message'] = "Invalid role selected.";
        header("Location: index.php?page=register");
        exit();
    }

    $conn = get_db_connection();

    if ($conn) {
        // --- Check if email already exists ---
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $_SESSION['error_message'] = "An account with this email already exists.";
            header("Location: index.php?page=register");
            $stmt->close();
            $conn->close();
            exit();
        }
        $stmt->close();

        // --- Hash the password ---
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // --- Insert the new user into the database ---
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $full_name, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            // Registration successful
            $_SESSION['success_message'] = "Registration successful! You can now log in.";
            header("Location: index.php?page=login");
        } else {
            // Registration failed
            $_SESSION['error_message'] = "Registration failed. Please try again later.";
            header("Location: index.php?page=register");
        }

        $stmt->close();
        $conn->close();
    } else {
        $_SESSION['error_message'] = "Database connection failed. Please try again later.";
        header("Location: index.php?page=register");
    }
    exit();

} else {
    // If not a POST request, redirect to the registration page
    header("Location: index.php?page=register");
    exit();
}
?>
