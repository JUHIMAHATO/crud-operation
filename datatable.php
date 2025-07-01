<?php

$servername = "localhost";
$username = "root";
$password = "";
$db_name ="test";

$conn = mysqli_connect($servername, $username, $password, $db_name);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$query = "SELECT * FROM regestration";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html>
<head>
    <title>DataTable with DB</title>
    <link rel="stylesheet" href="data.css"> 
    <style>::after

body{
    padding: 0px;
    margin: 0px;
    background-color: #99ccff;

}
table.dataTable {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

table.dataTable thead th {
    background-color: #003366;
    color: white;
    text-align: center;
    padding: 12px;
}

table.dataTable tbody td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

table.dataTable tbody tr:hover {
    background-color: #f0f8ff;
    transition: 0.2s;
}

h2 {
    text-align: center;
    margin-top: 30px;
    font-size: 28px;
    color: #003366;
    font-weight: 600;
}
</style>
</head>
<body>

    <h2>Registered Users</h2>
    <table id="userTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Number</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= ucwords($row['firstName']); ?></td>
                <td><?= ucwords($row['lastName']); ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['number']; ?></td>
                <td><?= ucfirst($row['gender']); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- jQuery -->
    <script src="jquery.js"></script>
    <!-- DataTables JS -->
    <script src="data.js"></script>
    <!-- Activate DataTable -->
    <script>
        $(document).ready(function () {
            $('#userTable').DataTable();
        });
    </script>

</body>
</html>
