<?php
session_start();
include 'database.php';  // Make sure this is the correct path to your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    if (empty($name) || empty($email) || empty($password) || $password !== $confirmPassword) {
        $_SESSION['error'] = "All fields are required and passwords must match.";
        header("Location: registration.html");
        exit();
    }

    $stmt = $db->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = "Email already exists.";
        header("Location: registration.html");
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    if ($stmt->execute([$name, $email, $passwordHash])) {
        $_SESSION['message'] = "Registration successful! Welcome, $name.";
        header("Location: registration_success.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to register.";
        header("Location: registration.html");
        exit();
    }
}
?>
