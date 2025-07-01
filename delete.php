<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$sql = "DELETE FROM regestration WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Deleted successfully!";
} else {
    echo "Delete failed: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Redirect back
header("Location: display.php");
exit;
?>
