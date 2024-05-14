<?php
session_start();
if (isset($_SESSION["user"]))
{
    header("Location: index.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    
    <form action="app.php" method="post">

        <p>Name :</p>
        <input type="text" name="Name">
        <p>Email :</p>
        <input type="email" name="Email">
        <p>Mobile :</p>
        <input type="text" name="Mobile">
        <p>Password :</p>
        <input type="password" name="Password">
        <br>
        <p>Confirm Password</p>
        <input type="password" name="Confirm_Password">
        <br>
        <input class="submit" type="submit" name="register" value="Register">
    </form>

    <p>Already registered ? <a href="login.php">Login here !</a></p>

    <?php



if (isset($_POST["register"]))
{
    $name = $_POST["Name"];
    $email = $_POST["Email"];
    $mobile = $_POST["Mobile"];
    $password = $_POST["Password"];
    $confirm_password = $_POST["Confirm_Password"];
    $errors = array();

    $password_hash = password_hash($password, PASSWORD_DEFAULT);



    if (empty($name) OR empty($email) OR empty($password) OR empty($mobile) OR empty($confirm_password))
    {
        array_push($errors, "All fields are required");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        array_push($errors, "Email is not valid !");
    }

    if (strlen($password) < 8)
    {
        array_push($errors, "Password must be at least 8 characters long");
    }

    if ($password !== $confirm_password)
    {
        array_push($errors, "Password did not match");
    }

    require_once "connection.php";
    $sql = "SELECT * FROM registered_users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);
    $row_count = mysqli_num_rows($result);
    if ($row_count > 0)
    {
        array_push($errors, "Email already exists");
    }

    if (count($errors) > 0)
    {
        foreach($errors as $error)
        {
            echo "<div class = 'alert alert-danger'>$error</div>";
        }

    }else 
    {
        
        // $sql = "insert into registered_users (name,email,mobile,password) values ($name,$email,$mobile,$password_hash)";


        // $name = mysqli_real_escape_string($con, $name);
        // $email = mysqli_real_escape_string($con, $email);
        // $mobile = mysqli_real_escape_string($con, $mobile);
        // $password_hash = mysqli_real_escape_string($con, $password_hash);
        
        $sql = "INSERT INTO registered_users (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$password_hash')";
        
        if (mysqli_query($con, $sql)) {
            echo "<div class='alert alert-success'>You are registered successfully.</div>";
        } else {
            die("Something went wrong: " . mysqli_error($con));
        }
        


        // $sql = "INSERT INTO registered_users (name, email, mobile, password) VALUES ( ?,?,?,?)";

        // $stmt = mysqli_stmt_init($con);
        // $prepare_stmt = mysqli_stmt_prepare($stmt,$sql);
        // if ($prepare_stmt)
        // {
        // mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $mobile, $password_hash);
        // mysqli_stmt_execute($stmt);
        // echo "<div class = 'alert alert-success' >You are registered successfully.</div>";
        // }
        // else {
        //     die("Something went wrong");
        // }
    }
}    
?>
</body>
</html>