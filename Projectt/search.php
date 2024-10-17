<?php
$searchTerm = isset($_GET['query']) ? $_GET['query'] : '';

$conn = new mysqli('localhost', 'root', '', 'products');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query the products table using the search term
$sql = "SELECT * FROM inventory WHERE name LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($products);

$conn->close();
?>
