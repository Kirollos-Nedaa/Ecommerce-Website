<?php
    //Check if the user is logedin
    session_start();
    if(isset($_SESSION['id'])){
        $user = '<div class="dropdown">
                <p class="user-text">'.$_SESSION['fname'].'</p>
                <div class="dropdown-content">
                <a href="logout.php">Logout</a>
                </div>
                </div>';
        $cart = '<div class="col-md-1 text-end">
                <a type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn">
                    <i class="fas fa-shopping-bag"></i>
                </a>
              </div>';
    }   else {
        $login = '<div class="dropdown">
                <a href="login.php" class="user-login">Login</a>
                </div>';
    }
    
?>

<?php
    $errors_arr = array();
    if(isset($_GET['error_fields'])){
        $errors_arr = explode(",", $_GET['error_fields']);
    }
?>

<?php
// Include the cart modal
include 'cart.php';
?>

<?php
    //ticket id
    $ticket_id = isset($_GET['ticket_id']) ? str_pad(htmlspecialchars($_GET['ticket_id']), 3, '0', STR_PAD_LEFT) : null;
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="Contact.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="Home.php">
                <img id="logo" src="http://localhost/Projectt/Assets/vlogo.svg" alt="logo" width="164" height="22.313">
            </a>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <ul>
                    <li><a href="Home.php">Home</a></li>
                    <li><a href="About.html">About</a></li>
                    <li><a href="Shop.php">Shop</a></li>
                    <li><a class="active" href="Contact.php">Contact</a></li>
                    <li>
                        <?php if(isset($user)) echo $user; ?>
                        <?php if(isset($login)) echo $login; ?>
                    </li>
                    <?php if(isset($user)) echo $cart; ?>
                </ul>
            </div>
          </nav>
    </nav>
    <form class="main-element" id="main-element" method="POST" action="procces_contact.php" onsubmit="return validateForm()">
    <!-- This is the ticket number part -->
    <div class="contact-submit <?php if (!$ticket_id) echo 'hidden'; ?>">
        <div class="after-submit">
            <?php if ($ticket_id): ?>
                <div>
                    <h2 class="ticket-text">Thank you for reaching out!</h2>
                    <p class="ticket-id">Your ticket ID is #<?= str_pad($ticket_id, 3, '0', STR_PAD_LEFT); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- This is the form part -->
    <div class="contact-form <?php if ($ticket_id) echo 'hidden'; ?>">
        <h2 style="display: flex; justify-content: center; margin-bottom: 20px; text-transform: uppercase; color: #7C51CA; font-weight: 600; font-family: 'Montserrat';">Contact Us</h2>
        <div class="form-row">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="<?php if(in_array("name",$errors_arr)) echo '* Please enter your name'; ?>" required>
        </div>
        <div class="form-row">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="<?php if(in_array("email",$errors_arr)) echo '* Please enter a valid email'; ?>" required>
        </div>
        <div class="form-row">
            <label for="message">Message</label>
            <textarea id="message" name="message" required style="height: 190px; resize: none;" rows="7" placeholder="<?php if(in_array("message",$errors_arr)) echo '* Please do not enter more than 350 words'; ?>"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    <div class="contact-info">
        <div class="contact-upper-text">
            <h2>Call Us</h2>
            <p>1 (234) 567-891</p>
            <p>1 (234) 987-654</p>
            <br>
            <h2>Location</h2>
            <p>121 Rock Street, 21 Avenue,</p>
            <p>New York, NY 92103-9000</p>
            <br>
            <h2>Email</h2>
            <p>support@neptuno.com</p>
        </div>
    </div>

</form>
    <div class="footer">
        <div class="footer2">
            <p class="ht">NEPTUNO</p>
            <p class="hb">Neptuno.com is a web-based fashion outlet that has been helping the trend-conscious look fabulous for 10 years</p>
        </div>
    </div>
    <div class="cr">
        <p>©Kirollos Nedaa – All Rights Reserved</p>
    </div>
<script src="Contact.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>