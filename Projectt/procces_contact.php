<?php
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "register");
    if (!$conn) {
        echo mysqli_connect_error();
        exit;
    }
    //validation
    $error_fields=array();
    if(! (isset ($_POST['name']) && !empty($_POST['name']))){
        $error_fields[]="name";
    }
    if(! (isset ($_POST['email']) && filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL))){
        $error_fields[]="email";
    }
    if(! (isset ($_POST['message']) && !empty($_POST['message']))){
        $error_fields[]="message";
    }
    if($error_fields){
        header("Location: contact.php?error_fields=".implode(",", $error_fields));
        exit;
    }

    //Conction to database
    $conn = mysqli_connect("localhost", "root", "","register");
    if (! $conn){
        echo mysqli_connect_error();
        exit;
    }
    //Prevent SQL Injection
    $name = mysqli_escape_string($conn, $_POST['name']);
    $email = mysqli_escape_string($conn, $_POST['email']);
    $message = mysqli_escape_string($conn, $_POST['message']);

    //insert the data
    $query = "INSERT INTO `contact_us` (`name`, `email`, `message`) VALUES ('".$name."', '".$email."', '".$message."')";
    if (mysqli_query($conn, $query)){
        $ticket_id = mysqli_insert_id($conn);
        header("Location: contact.php?ticket_id=" . $ticket_id);
    }   else {
        // echo $query;
        echo mysqli_error($conn);
    }
    //close the connection
    mysqli_close($conn);
?>