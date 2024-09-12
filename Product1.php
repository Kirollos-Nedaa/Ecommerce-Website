<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "","products");
if (! $conn){
    echo mysqli_connect_error();
    exit;
}

// Fetch product details 
$product_id = 1;
$result = $conn->query("SELECT name, quantity, price, image FROM inventory WHERE id = $product_id");

$product = $result->fetch_assoc();
$stock_quantity = $product['quantity'];
$price = $product['price'];
$image = $product['image'];
$stock_status = '';


// Determine the stock status based on quantity
if ($stock_quantity > 5) {
    $stock_status = '<h6 class="in-stock">In Stock</h6>';
} elseif ($stock_quantity > 0) {
    $stock_status = '<h6 class="only-stock">Only ' . $stock_quantity . ' left in stock</h6>';
} else {
    $stock_status = '<h6 class="out-stock">Out of Stock</h6>';
}

//Close the connection
mysqli_free_result($result);
mysqli_close($conn);
?>

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
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="Product1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <section class="section1">
        <h2><?php echo $product['name']; ?></h2>
        <h5>$<?php echo $price; ?></h5>
        <?php echo $stock_status; ?>
        <button class="button button3">Add to Bag</button>
        <p class="disc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus eget suscipit purus, eu laoreet purus. Aenean laoreet egestas purus, sit amet posuere lectus euismod sed. Donec finibus ligula libero, id hendrerit dolor consequat eu. Vestibulum suscipit libero auctor enim feugiat hendrerit. Nunc dictum tortor id turpis tempor, quis porttitor lorem fermentum. Praesent imperdiet enim ut mi convallis molestie. Mauris vitae mattis neque. Suspendisse sed ultrices enim. Vivamus ultrices libero eget eros tempor, molestie semper diam pulvinar. Quisque nec erat mollis, feugiat libero non, varius felis. Donec dui justo, gravida a ipsum sed, lobortis congue ipsum. Maecenas pharetra sollicitudin rhoncus. Quisque eget iaculis orci.</p>
        <img class="img" src="<?php echo $image; ?>">
    </section>
    <div class="YouMayLike">
        <p class="text1">YOU MAY ALSO LIKE</p>
    </div>
    <div class="layout-container square">
        <figure>
            <a href="Product5.html">
                <img class="y1" src="https://d2j6dbq0eux0bg.cloudfront.net/images/17298759/1112153425.jpg">
            </a>
            <figcaption>YELLOW SPORT</figcaption>
            <figcaption1>Bold yellow tennies</figcaption1>
        </figure>
        <figure>
            <a href="Product6.html">
                <img class="y1" src="https://d2j6dbq0eux0bg.cloudfront.net/images/17298759/1112153450.jpg">
            </a>
            <figcaption>ROSE BAG</figcaption>
            <figcaption1>Elegant hand wallet</figcaption1>
        </figure>
        <figure>
            <a href="Product8.html">
                <img class="y1" src="https://d2j6dbq0eux0bg.cloudfront.net/images/17823323/1126338445.jpg">
            </a>
            <figcaption>URBAN SPORT</figcaption>
            <figcaption1>Comfy in black</figcaption1>
        </figure>
    </div>
    <div class="footer">
        <div class="footer2">
            <p class="ht">NEPTUNO</p>
            <p class="hb">Neptuno.com is a web-based fashion outlet that has been helping the trend-conscious look fabulous for 10 years</p>
        </div>
    </div>
    <div class="cr">
        <p>©Kirollos Nedaa – All Rights Reserved</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>