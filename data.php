<?php
// data.php

// Include your database connection file (e.g., connection.php)
require_once "connection.php";

session_start(); // Start the session

if (!isset($_SESSION["user"])) {
    // User is not logged in, redirect to the login page or handle as needed
    header("Location: login.php");
    exit; // Terminate script execution
}

// Get the user ID from the session
$userId = $_SESSION["user_id"];

// Construct the SQL query to retrieve data for the specific user
$sql = "SELECT name, mobile, address FROM records WHERE user_id = '$userId'";

// Execute the query
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>Mobile</th><th>Address</th></tr>";

    // Loop through the result set
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["mobile"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No records found for this user.";
}

// Close the database connection
mysqli_close($con);
?>
<!-- WHERE user_id = '$userId' -->