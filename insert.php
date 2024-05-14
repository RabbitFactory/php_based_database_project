<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    

    <form action="insert.php" method="post">

    <p>Name: </p>
    <input type="text" name="name_records">
    <p>Mobile: </p>
    <input type="text" name="mobile_records">
    <p>Address: </p>
    <input type="text" name="address_records">
    <input type="submit" name="add" value="Add">

    </form>




<?php
// insert.php

// Include your database connection file (e.g., connection.php)
require_once "connection.php";

session_start(); // Start the session

// if (isset($_SESSION["user"])) {
//     // User is already logged in, redirect to the main page
//     header("Location: index.php");
//     exit; // Terminate script execution
// }

if (isset($_POST["add"])) {
    // Retrieve form input values
    $name = $_POST["name_records"];
    $mobile = $_POST["mobile_records"];
    $address = $_POST["address_records"];

    // Validate input (you can add more validation as needed)

    // Get the user's ID from the session
    $userId = $_SESSION["user_id"];

    // Construct the SQL query
    $sql = "INSERT INTO records (name, mobile, address, user_id) VALUES ('$name', '$mobile', '$address', '$userId')";

    // Execute the query
    if (mysqli_query($con, $sql)) {
        echo "Record inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>


</body>
</html>