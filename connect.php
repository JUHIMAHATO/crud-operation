<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
    $number = $_POST['number'] ?? '';

    if (!$firstName || !$lastName || !$email || !$password || !$number) {
        die("All fields are required!");
    }

    $conn = new mysqli('localhost', 'root', '', 'test');

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO regestration(firstName, lastName, gender, email, password, number) VALUES (?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ssssss", $firstName, $lastName, $gender, $email, $password, $number);

    if ($stmt->execute()) {

        header("Location: display.php");
        exit();
    } else {
        echo "Execute failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "⚠️ Please submit the form.";
}
?>
