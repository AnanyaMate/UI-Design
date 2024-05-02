<?php
// Database connection
include 'db_connection.php';

$user_id = $_GET['user_id'];

// Prepare and execute the query
$query = $conn->prepare("SELECT name, age, (SELECT COUNT(*) FROM posts WHERE user_id = ?) AS post_count FROM users WHERE id = ?");
$query->bind_param("ii", $user_id, $user_id);
$query->execute();
$result = $query->get_result();

if ($data = $result->fetch_assoc()) {
    // Output user data (this could also return JSON data to be used via Ajax)
    echo "Name: " . $data['name'] . "<br>";
    echo "Age: " . $data['age'] . "<br>";
    echo "Number of Posts: " . $data['post_count'];
} else {
    echo "User not found.";
}

$query->close();
$conn->close();
?>
