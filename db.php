<?php
    $conn = mysqli_connect("localhost", "root", "","register");
        if (! $conn){
            echo mysqli_connect_error();
            exit;
        }
    $query = "SELECT * FROM `users`";
    $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)){
            echo "Id: ".$row['id']."<br />";
            echo "First Name: ".$row['fname']."<br />";
            echo "Last Name: ".$row['lname']."<br />";
            echo "Email: ".$row['email']."<br />";
            echo "Phone Number: ".$row['phnum']."<br />";
            echo "Password: ".$row['password']."<br />";
            echo str_repeat("-", 50)."<br />";
        }
    mysqli_free_result($result);
    mysqli_close($conn);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>