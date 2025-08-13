<?php

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'school_website');
define('DB_USER', 'root');
define('DB_PASS', '');

/**
 * Establishes a database connection.
 *
 * @return mysqli|null The mysqli connection object on success, or null on failure.
 */
function get_db_connection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check for connection errors
    if ($conn->connect_error) {
        // In a real application, you would log this error instead of echoing it.
        error_log("Connection failed: " . $conn->connect_error);
        return null;
    }

    return $conn;
}
