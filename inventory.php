<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "products");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add new item
if (isset($_POST['new_item'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    if (!empty($name) && is_numeric($quantity) && $quantity >= 0) {
        $stmt = $conn->prepare("INSERT INTO inventory (name, quantity, price, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sii", $name, $quantity, $price);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Update quantity when + or - button is clicked
if (isset($_POST['action'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action == 'increase') {
        $stmt = $conn->prepare("UPDATE inventory SET quantity = quantity + 1 WHERE id = ?");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } elseif ($action == 'decrease') {
        $stmt = $conn->prepare("UPDATE inventory SET quantity = quantity - 1 WHERE id = ? AND quantity > 0");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Fetch items from database
$result = $conn->query("SELECT * FROM inventory");
if (!$result) {
    die("Error fetching data: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <style>
        table {
            width: 50%;
            margin: auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        button {
            padding: 5px 10px;
        }
        form {
            margin-bottom: 20px;
        }
        .add-item-form {
            text-align: center;
            margin: 20px;
        }
        .add-item-form input {
            padding: 5px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Inventory Management</h2>

    <!-- Form to add new items -->
    <div class="add-item-form">
        <h3>Add New Item</h3>
        <form method="post">
            <input type="text" name="name" placeholder="Item Name" required>
            <input type="number" name="quantity" placeholder="Quantity" min="0" required>
            <input type="number" name="price" placeholder="Price" required>
            <input type="text" name="image" placeholder="image url" required>
            <button type="submit" name="new_item">Add Item</button>
        </form>
    </div>

    <!-- Inventory Table -->
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Image url</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                <td><?php echo htmlspecialchars($row['price']); ?></td>
                <td><?php echo htmlspecialchars($row['image']); ?></td>
                <td>
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <button type="submit" name="action" value="decrease">-</button>
                    </form>
                    <form method="post" style="display:inline-block;">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <button type="submit" name="action" value="increase">+</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
