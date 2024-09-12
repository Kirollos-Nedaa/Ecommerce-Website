<?php
//validation
$error_fields=array();
    if(! (isset ($_POST['fname']) && !empty($_POST['fname']))){
        $error_fields[]="fname";
    }
    if(! (isset ($_POST['lname']) && !empty($_POST['lname']))){
        $error_fields[]="lname";
    }
    if(! (isset ($_POST['email']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))){
        $error_fields[]="email";
    }
    if(! (isset ($_POST['phnum']) && strlen($_POST['phnum']) == 11)){
        $error_fields[]="phnum";
    }
    if(! (isset ($_POST['password']) && strlen($_POST['password']) >= 8)){
        $error_fields[]="password";
    }

    if($error_fields){
        header("Location: signup.php?error_fields=".implode(",", $error_fields));
        exit;
    }

//Conction to database
$conn = mysqli_connect("localhost", "root", "","register");
    if (! $conn){
        echo mysqli_connect_error();
        exit;
    }
//Prevent SQL Injection
$fname = mysqli_escape_string($conn, $_POST['fname']);
$lname = mysqli_escape_string($conn, $_POST['lname']);
$email = mysqli_escape_string($conn, $_POST['email']);
$phnum = mysqli_escape_string($conn, $_POST['phnum']);
$password = mysqli_escape_string($conn, $_POST['password']);

//insert the data
$query = "INSERT INTO `users` (`fname`, `lname`, `email`, `phnum`, `password`) VALUES ('".$fname."', '".$lname."', '".$email."', '".$phnum."', '".$password."')";
    if (mysqli_query($conn, $query)){
        header("Location: login.php");
    }   else {
        // echo $query;
        echo mysqli_error($conn);
    }
//close the connection
mysqli_close($conn);