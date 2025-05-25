<?php
session_start();
require 'db_connection.php';  // Your DB connection script

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
  
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password using password_verify()
        if (password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            header("Location: login.php?error=Invalid credentials");
            exit();
        }
    } else {
        header("Location: login.php?error=Invalid credentials");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
