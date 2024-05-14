



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<?php
session_start();
if (!isset($_SESSION["user"]))
{
    header("Location: login.php");
}
require_once "connection.php";


?>


    <a href="insert.php">Insert Data</a>
    <a href="data.php">View Data</a>



    <h1>
        This is the Dashboard
    </h1>
    <h5>
        Under construction
    </h5>

    <a href="logout.php">Log Out</a>
</body>
</html>