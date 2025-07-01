<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM regestration";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Data</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: powderblue;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: navy;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
            background-color: #fff;
            border: 2px solid #007BFF;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }

        th,
        td {
            padding: 10px 15px;
            text-align: center;
            border: 1px solid #ddd;

        }

        th {
            background-color: #000099;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
        }

        tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s ease;
        }

        .action-btn {
            padding: 8px 14px;
            margin: 3px;
            border: 2px solid transparent;
            border-radius: 5px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .create-btn {
            background-color: #28a745;
            color: white;
            border-color: rgb(4, 47, 15);
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            border-color: rgb(46, 4, 8);
        }

        .update-btn {
            background-color: rgb(113, 153, 234);
            color: white;
            border-color: rgb(13, 7, 136);
        }

        .view-btn {
            background-color: rgb(255, 255, 26);
            color: white;
            border-color: #808000;
        }

        .update-btn:hover,
        .delete-btn:hover,
        .create-btn:hover,
        .view-btn:hover {
            background-color: white;
            color: inherit;
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .delete-btn:hover {
            border-color: rgb(18, 59, 131);
            color: rgb(82, 192, 222);
        }

        .top-btn-container {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <h2>User Data</h2>
    <div class="top-btn-container">
        <form action="create.php" method="POST">
            <button class="action-btn create-btn" type="submit">Create New User</button>
        </form>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Actions</th>
        </tr>

        <?php

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
            <td>" . $row['id'] . "</td>
  <td>" . ucwords(strtolower($row['firstName'])) . "</td>
<td>" . ucwords(strtolower($row['lastName'])) . "</td>

       <td>" . ucwords(strtolower($row['gender'])) . "</td>

            <td>" . strtolower($row['email']) . "</td>
            <td>" . $row['number'] . "</td>
            <td>
                <form style='display:inline;' action='view.php' method='POST'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button class='action-btn view-btn' type='submit'>View</button>
                </form>
                <form style='display:inline;' action='update.php' method='POST'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button class='action-btn update-btn' type='submit'>Update</button>
                </form>
                <form style='display:inline;' action='delete.php' method='POST' onsubmit='return confirm(\"Are you sure?\");'>
                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                    <button class='action-btn delete-btn' type='submit'>Delete</button>
                </form>
            </td>
        </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        ?>