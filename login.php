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
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php
    if (isset($_POST["login"]))
    {
        $email = $_POST["email"];
        $password = $_POST["password"];

        require_once "connection.php";
        $sql = "SELECT * FROM registered_users WHERE email = '$email'";
        $result  = mysqli_query($con, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        if($user) {
            if (password_verify($password, $user["password"]))
            {
                session_start();
                $_SESSION["user"] = "yes";
                $_SESSION["user_id"] = $user["id"];
                header("Location: index.php");
                die();
            }else {
                echo "<div>Password does not exist</div>";
            }
        }else {
            echo "<div>Email does not exist</div>";
        }
    }





    ?>
    <form action="login.php" method ="POST">


    <p>Email</p>
    <input type="email" name="email">
    <p>Password</p>
    <input type="password" name="password">
    <br>
    <input class="submit" type="submit" value="Login" name="login">




    </form>
    <p>New user? <a href="app.php">Register Now !</a></p>

    


</body>
</html>