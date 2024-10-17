<?php
session_start();

$product_name = $_POST['product_name'];
$action = $_POST['action'];

// Check if the product exists in the shopping bag
if (isset($_SESSION['shopping_bag'][$product_name])) {
    if ($action == 'increase') {
        $_SESSION['shopping_bag'][$product_name]['quantity'] += 1;
    } elseif ($action == 'decrease' && $_SESSION['shopping_bag'][$product_name]['quantity'] > 1) {
        $_SESSION['shopping_bag'][$product_name]['quantity'] -= 1;
    }
    // Return the updated quantity
    echo $_SESSION['shopping_bag'][$product_name]['quantity'];
} else {
    echo 'Error: Product not found.';
}
?>
