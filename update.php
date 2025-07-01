<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// UPDATE logic
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $number = $_POST['number'];

    $sql = "UPDATE regestration SET firstName=?, lastName=?, gender=?, email=?, number=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $firstName, $lastName, $gender, $email, $number, $id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Updated Successfully!'); window.location.href='display.php';</script>";
    } else {
        echo "❌ Update failed: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit;
}
if (isset($_POST['update'])) {
    // Debug this 👇
    echo "Number from form: " . $_POST['number'];
    exit;
}


// FETCH data by ID
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $query = "SELECT * FROM regestration WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
} else {
    echo "<script>alert('⚠️ No user selected to update!'); window.location.href='display.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" href="display.css">
    <style>
        body{
            padding: 0px;
            margin: 0;
            background-color: rgb(113, 153, 234);;

        }
        form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 16px rgba(0,0,0,0.1);
        }
        input, select {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .submit-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            transition: 0.3s;
        }
        .submit-btn:hover {
            background-color: white;
            color: #007BFF;
            border: 2px solid #007BFF;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Update User Info</h2>

<form method="POST" action="update.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    
    <input type="text" name="firstName" value="<?php echo $row['firstName']; ?>" required>
    <input type="text" name="lastName" value="<?php echo $row['lastName']; ?>" required>

    <select name="gender" required>
        <option value="Male" <?php if ($row['gender'] == 'Male') echo 'selected'; ?>>Male</option>
        <option value="Female" <?php if ($row['gender'] == 'Female') echo 'selected'; ?>>Female</option>
        <option value="Other" <?php if ($row['gender'] == 'Other') echo 'selected'; ?>>Other</option>
    </select>

    <input type="email" name="email" value="<?php echo $row['email']; ?>" required>
    
    <input type="text" name="number" value="<?php echo $row['number']; ?>" required>

    <button type="submit" name="update" class="action-btn submit-btn">Update</button>
</form>

</body>
</html>
