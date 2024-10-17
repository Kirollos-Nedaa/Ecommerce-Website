<?php
session_start();

// Clear the shopping bag session
unset($_SESSION['shopping_bag']);

// Redirect back to the previous page
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>
