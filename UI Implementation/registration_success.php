<?php
session_start();
if (!isset($_SESSION['message'])) {
    header("Location: registration.html");  // Redirect if no session message set
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
</head>
<body>
    <h1>Registration Successful</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['message']); ?></p>
    <?php unset($_SESSION['message']); ?>
    <a href="index.html">Go to Homepage</a>
</body>
</html>
