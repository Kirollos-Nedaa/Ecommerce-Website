<?php
// Check if the session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<head>
    <link rel="stylesheet" href="cart.css">
</head>
<body>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content custom-modal">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Shopping Bag</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-scrollable">
            <?php
            if (isset($_SESSION['shopping_bag']) && !empty($_SESSION['shopping_bag'])) {
                foreach ($_SESSION['shopping_bag'] as $product_id => $product) {
                    echo '<div class="product-cart">
                            <img class="product-img" src="' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '">
                            <div class="product-body">
                                <h5 class="product-title">' . htmlspecialchars($product['name']) . '</h5>
                                <p class="product-text">
                                    Quantity 
                                    <button class="quantity-btn" onclick="updateQuantity(' . $product_id . ', \'decrease\')">-</button>
                                    <span id="quantity-' . $product_id . '">' . $product['quantity'] . '</span>
                                    <button class="quantity-btn" onclick="updateQuantity(' . $product_id . ', \'increase\')">+</button>
                                </p>
                            </div>
                            <a href="remove_from_bag.php?product_id=' . $product_id . '" class="remove btn">Remove</a>
                          </div>
                        </div>
                          <div class="modal-footer">
                <a type="button" href="clear_bag.php" class="btn btn-danger">Clear Bag</a>
                <button type="button" class="btn btn-success">Proceed to Payment</button>
            </div>';
                }
            } else {
                echo '<p>Your shopping bag is empty.</p>';
            }
            ?>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="cart.js"></script>
</body>
