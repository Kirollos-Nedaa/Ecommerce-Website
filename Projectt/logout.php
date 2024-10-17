<?php
session_start(); // Start the session at the beginning

// Store the URL of the previous page before destroying the session
if (isset($_SERVER['HTTP_REFERER'])) {
    $_SESSION['prev_url'] = $_SERVER['HTTP_REFERER'];
}

// Clear the session data and destroy the session
$_SESSION = array();
session_destroy();

// Redirect to the stored URL or a default page if the previous URL is not set
$redirectUrl = isset($_SESSION['prev_url']) ? $_SESSION['prev_url'] : 'home.php';
unset($_SESSION['prev_url']); // Clear the stored URL after redirection

header("Location: " . $redirectUrl);
exit;
?>
