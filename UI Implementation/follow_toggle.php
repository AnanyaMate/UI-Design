<?php
session_start();
include 'database.php'; // Database connection details

$data = json_decode(file_get_contents('php://input'), true);
$userId = $data['userId'];
$follow = $data['follow'];

$currentUser = $_SESSION['user_id']; // Currently logged-in user

// Logic to determine current state and toggle it
if ($follow) {
    $sql = "INSERT INTO follows (follower_id, following_id) VALUES (?, ?)";
} else {
    $sql = "DELETE FROM follows WHERE follower_id = ? AND following_id = ?";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $currentUser, $userId);
$success = $stmt->execute();

// Send back success status
echo json_encode(['success' => $success]);

$stmt->close();
$conn->close();
?>
