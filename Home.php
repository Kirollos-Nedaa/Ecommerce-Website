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
    }   else {
        $login = '<div class="dropdown">
                <a href="login.php" class="user-login">Login</a>
                </div>';
    }
    
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neptuno Home</title>
    <link rel="stylesheet" href="Home.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="Home.php">
                <img id="logo" src="http://localhost/Projectt/Assets/vlogo.svg" alt="Bootstrap" width="164" height="22.313">
            </a>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <ul>
                    <li><a class="active" href="Home.php">Home</a></li>
                    <li><a href="About.html">About</a></li>
                    <li><a href="Shop.html">Shop</a></li>
                    <li><a href="Contact.html">Contact</a></li>
                    <li>
                        <?php if(isset($user)) echo $user; ?>
                        <?php if(isset($login)) echo $login; ?>
                    </li>
                </ul>
            </div>
          </nav>
    </nav>
    <section class="main">
        <img src="http://localhost/Projectt/Assets/welcome-01-01.png" class="img mx-auto d-block">
    </section>
    <section>
        <h1 class="subtitle">- Summer Collection -</h1>
    </section>
        <div class="container products">
            <div class="item">
                <a href="Product1.php">
                <img src="https://d2j6dbq0eux0bg.cloudfront.net/images/17298759/1107715196.jpg" alt="Shoes">
                <div class="price">$20</div>
                </a>
            </div>
            <div class="item">
                <a href="Product2.html">
                <img src="https://d2j6dbq0eux0bg.cloudfront.net/images/17298759/1107715178.jpg" alt="Dress">
                <div class="price">$60</div>
                </a>
            </div>
            <div class="item">
                <a href="Product3.html">
                <img src="https://d2j6dbq0eux0bg.cloudfront.net/images/17298759/1107715203.jpg" alt="Jacket">
                <div class="price">$30</div>
                </a>
            </div>
            <div class="item">
                <a href="Product4.html">
                <img src="https://d2j6dbq0eux0bg.cloudfront.net/images/17298759/1112153538.jpg" alt="Outfit">
                <div class="price">$40</div>
                </a>
            </div>
            <div class="item">
                <a href="Product5.html">
                <img src="https://d2j6dbq0eux0bg.cloudfront.net/images/17298759/1112153425.jpg" alt="Shoes">
                <div class="price">$40</div>
                </a>
            </div>
            <div class="item">
                <a href="Product6.html">
                <img src="https://d2j6dbq0eux0bg.cloudfront.net/images/17298759/1112153450.jpg" alt="Shoes">
                <div class="price">$80</div>
                </a>
            </div>
            <div class="item">
                <a href="Product7.html">
                <img src="https://d2j6dbq0eux0bg.cloudfront.net/images/17298759/1112153534.jpg" alt="Shoes">
                <div class="price">$90</div>
                </a>
            </div>
            <div class="item">
                <a href="Product8.html">
                <img src="https://d2j6dbq0eux0bg.cloudfront.net/images/17823323/1126338445.jpg" alt="Shoes">
                <div class="price">$120</div>
                </a>
            </div>
        </div>
    </div>
<div class="footer">
    <div class="footer2">
        <p class="ht">NEPTUNO</p>
        <p class="hb">Neptuno.com is a web-based fashion outlet that has been helping the trend-conscious look fabulous for 10 years</p>
    </div>
        <div class="cr">
            <p>©Kirollos Nedaa – All Rights Reserved</p>
        </div>
    </div>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>