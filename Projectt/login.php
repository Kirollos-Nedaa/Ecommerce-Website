<?php
    //Store the signe in user
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Connect to database
        $conn = mysqli_connect("localhost", "root", "", "register");
        if(! $conn){
            echo mysqli_connect_error();
            exit;
        }
    
    //Avoid SQL injection
    $email = mysqli_escape_string($conn, $_POST['email']);
    $password = mysqli_escape_string($conn, $_POST['password']);

    //Select
    $query = "SELECT * FROM `users` WHERE `email` = '".$email."' and `password` = '".$password."' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)){
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['fname'] = $row['fname'];
        header("Location: Home.php");
        exit;
    }   else {
        $error= '<div class="error-text">Invalid email or password</div>';
    }
    //Close the connection
    mysqli_free_result($result);
    mysqli_close($conn);
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="card">
        <img src="http://localhost/Projectt/Assets/vlogo.svg" class="logo">
        <form method="post" class="needs-validation" id="loginForm" novalidate>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                </div>
                <?php if(isset($error)) echo $error; ?>
                <div class="form-actions">
                    <a href="#">Forgot Password?</a>
                    <a href="signup.php" style="padding-top: 10px;">Create new account</a>
                </div>
                <div class="form-actions">
                    <button type="submit" value="login">Login</button>
                </div>
        </form>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>