<?php

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";
date_default_timezone_set('Indian/Maldives');
// Create connection
$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
);
$name = $_REQUEST['name'];
$mobile = $_REQUEST['mob'];
$email = $_REQUEST['email1'];
$payment_mode = $_REQUEST['gender'];
$roll = $_REQUEST['roll'];
$password = $_REQUEST['pass'];
$timestamp = date('Y-m-d H:i:s');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}

$sqlquery = "INSERT INTO table_name (name, mobile, email, payment_mode, roll, password,timestamp) VALUES ('$name', '$mobile', '$email', '$payment_mode', '$roll','$password','$timestamp')";


if ($conn->query($sql) === TRUE) {
    echo "record inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}