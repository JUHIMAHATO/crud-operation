<?php
# variable declaration for sql connection
$servername = "localhost";
$username = "root";
$password = "";
$db_name ="test";

# create connection
$conn = mysqli_connect($servername, $username, $password ,$db_name);

# checking connection
if(!$conn){
    die("Connection is failed." .mysqli_connect_error());
}
else {
    echo " database connected";
}
?>
