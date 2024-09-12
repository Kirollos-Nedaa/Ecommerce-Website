<?php
    $errors_arr = array();
    if(isset($_GET['error_fields'])){
        $errors_arr = explode(",", $_GET['error_fields']);
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="Signup.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body>
    <div class="card">
        <img src="http://localhost/Projectt/Assets/vlogo.svg" class="logo">
        <form method="post" action="procces_db.php" class="needs-validation" id="SignupForm" novalidate>
            <div class="form-group">
                <label for="fname">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" required><?php if(in_array("fname",$errors_arr)) echo '<span class="error-text">* Please enter your first name</span>'; ?>
                <div class="valid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="lname">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" required><?php if(in_array("lname",$errors_arr)) echo '<span class="error-text">* Please enter your last name</span>'; ?>
                <div class="valid-feedback"></div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="inputGroupPrepend" required><?php if(in_array("email",$errors_arr)) echo '<span class="error-text">* Please enter your email'; ?>
            </div>
            <div class="form-group">
                <label for="phnum">Phone number</label>
                <input type="number" class="form-control" id="phnum" name="phnum" aria-describedby="inputGroupPrepend" required maxlength="11"><?php if(in_array("phnum",$errors_arr)) echo '<span class="error-text">* Please enter your phone number'; ?>
            </div>
            <p id="phoneError" style="color: red; display: none;">Phone number must be 11 digits and start with "01"</p>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="inputGroupPrepend" required><?php if(in_array("password",$errors_arr)) echo '<span class="error-text">* Please enter a Pasword not less than 8 characters'; ?>
                    <div class="invalid-feedback">
                        Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" aria-describedby="inputGroupPrepend" required><?php if(in_array("password",$errors_arr)) echo '<span class="error-text">* Please enter a Pasword not less than 8 characters'; ?>
                    <div class="invalid-feedback">
                        Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters
                    </div>
                </div>
                <p id="passwordMismatch" style="color: red; display: none;">Password does't match</p>
                <div class="form-actions">
                    <a href="login.php">Already have an account?</a>
                    <button class="btn btn-primary" type="submit">Signup</button>
                </div>
        </form>
    </div>
        <script src="signup.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>