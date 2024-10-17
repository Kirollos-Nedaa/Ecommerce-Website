<?php
session_start();

$product_id = isset($_POST['product_id']);
$product_name = $_POST['product_name'] ?? '';
$product_price = $_POST['product_price'] ?? 0;
$product_image = $_POST['product_image'] ?? '';


if ($product_id > 0) {
    if (!isset($_SESSION['shopping_bag'])) {
        $_SESSION['shopping_bag'] = [];
    }

    if (isset($_SESSION['shopping_bag'][$product_id])) {
        $_SESSION['shopping_bag'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['shopping_bag'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'image' => $product_image,
            'quantity' => 1,
        ];
    } header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
} else {
    echo 'Invalid Product ID';
    exit;
}
?>