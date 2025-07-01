<!DOCTYPE html>
<html>
<head>
    <title>Register New User</title>
    <link rel="stylesheet" href="display.css">
    <style>
        body {
            background-color: #28a745;
            padding: 0px;
            margin: 0px;
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
            width: 100%;
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
            color: #ff33cc;
            border: 2px solid purple;
            transform: scale(1.05);
        }
        .error {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Register New User</h2>

<form id="regForm" action="connect.php" method="POST" onsubmit="return validateForm()">
    <input type="text" name="firstName" placeholder="First Name" id="firstName" required>
    <div id="firstNameError" class="error"></div>

    <input type="text" name="lastName" placeholder="Last Name" id="lastName" required>
    <div id="lastNameError" class="error"></div>

    <select name="gender" id="gender" required>
        <option value="" disabled selected>Select Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>
    <div id="genderError" class="error"></div>

    <input type="email" name="email" placeholder="Email" id="email" required>
    <div id="emailError" class="error"></div>

    <input type="password" name="password" placeholder="Password (Min 6 characters)" id="password" required>
    <div id="passwordError" class="error"></div>

    <input type="text" name="number" placeholder="Phone Number (10 digits)" id="number" required>
    <div id="numberError" class="error"></div>

    <button type="submit" class="action-btn submit-btn">Submit</button>
</form>

<script>
function validateForm() {
    let isValid = true;

    const firstName = document.getElementById("firstName").value.trim();
    const lastName = document.getElementById("lastName").value.trim();
    const gender = document.getElementById("gender").value;
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const number = document.getElementById("number").value.trim();


    document.querySelectorAll(".error").forEach(e => e.textContent = "");

    if (!/^[A-Za-z]{2,}$/.test(firstName)) {
        document.getElementById("firstNameError").textContent = "Enter valid first name";
        isValid = false;
    }


    if (!/^[A-Za-z]{2,}$/.test(lastName)) {
        document.getElementById("lastNameError").textContent = "Enter valid last name";
        isValid = false;
    }

  
    if (!gender) {
        document.getElementById("genderError").textContent = "Please select gender";
        isValid = false;
    }

    if (!/^\S+@\S+\.\S+$/.test(email)) {
        document.getElementById("emailError").textContent = "Enter valid email";
        isValid = false;
    }


    if (password.length < 6) {
        document.getElementById("passwordError").textContent = "Password must be at least 6 characters";
        isValid = false;
    }

  
    if (!/^[0-9]{10}$/.test(number)) {
        document.getElementById("numberError").textContent = "Phone number must be 10 digits";
        isValid = false;
    }

    return isValid;
}
</script>

</body>
</html>

<?php
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $number = $_POST['number'] ?? '';

    // Validate basic fields (same as frontend)
    if (!preg_match("/^[A-Za-z]{2,}$/", $firstName) || !preg_match("/^[A-Za-z]{2,}$/", $lastName)) {
        $error = "Name must contain only letters and be at least 2 characters.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif (strlen($password) < 6) {
        $error = "Password too short.";
    } elseif (!preg_match("/^[0-9]{10}$/", $number)) {
        $error = "Phone number must be 10 digits.";
    } else {
        $conn = new mysqli("localhost", "root", "", "test");

        if ($conn->connect_error) {
            $error = "Connection failed.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO regestration (firstName, lastName, gender, email, password, number) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $firstName, $lastName, $gender, $email, $hashedPassword, $number);

            if ($stmt->execute()) {
                $success = "Registration Successful!";
            } else {
                $error = "Database error: " . $stmt->error;
            }

            $stmt->close();
            $conn->close();
        }
    }
}
?>

