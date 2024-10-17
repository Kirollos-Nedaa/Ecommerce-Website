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
// Include the cart modal
include 'cart.php';
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="Shop.css">
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
                    <li><a class="active" href="Shop.html">Shop</a></li>
                    <li><a href="Contact.php">Contact</a></li>
                    <li>
                        <?php if(isset($user)) echo $user; ?>
                        <?php if(isset($login)) echo $login; ?>
                    </li>
                    <?php if(isset($user)) echo $cart; ?>
                </ul>
            </div>
          </nav>
    </nav>



    <div class="container">
        <div class="row justify-content-right align-items-center">
            <div class="col-md-4">
                <form class="d-flex" role="search" method="GET" action="search.php">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search products..." aria-label="Search">
                    <button class="btn btn-outline" type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>




    <div class="container products">
    <div class="card-slider">
        <?php
        // Database connection
        $conn = mysqli_connect("localhost", "root", "", "products");
        if (!$conn) {
            echo mysqli_connect_error();
            exit;
        }

        // Fetch product details without pagination
        $result = $conn->query("SELECT id, name, price, image FROM inventory");

        if ($result && $result->num_rows > 0) {
            echo "<div class='row row-cols-1 row-cols-md-3 g-4'>";

            // Loop through each product and display its details
            while ($product = $result->fetch_assoc()) {
                $id = $product['id'];
                $name = $product['name'];
                $price = $product['price'];  // Format price to remove decimals
                $image = $product['image'];
                
                $image = empty($image) ? 'http://localhost/Projectt/assets/Artboard%201.png' : $image;
                // Display each product card
                echo "
                <div class='col'>
                    <div class='card'>
                        <img src='$image' class='card-img-top' alt='$name'>
                        <div class='card-body'>
                            <h5 class='card-title'>$name</h5>
                            <p class='card-text'>$$price</p>
                            <a href='product.php?id=$id' class='btn btn-primary detailes'>View Details</a>
                        </div>
                    </div>
                </div>";
            }

            echo "</div>"; // End of row
        } else {
            echo "No products found.";
        }
        ?>
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


    <script src="Shop.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>