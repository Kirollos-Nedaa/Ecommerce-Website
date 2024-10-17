<?php
session_start();

$product_id = $_GET['product_id'];

// Remove the product from the shopping bag
if (isset($_SESSION['shopping_bag'][$product_id])) {
    unset($_SESSION['shopping_bag'][$product_id]);
}

// Redirect back to the page with the modal
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>
