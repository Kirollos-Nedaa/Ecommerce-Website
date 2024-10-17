<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "products");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch items from the inventory table
$result = $conn->query("SELECT * FROM inventory");

// Add new item
if (isset($_POST['new_item'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $type = $_POST['type'];

    if (!empty($name) && is_numeric($quantity) && $quantity >= 0) {
        $stmt = $conn->prepare("INSERT INTO inventory (name, quantity, price, image, type) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiss", $name, $quantity, $price, $image, $type);
        $stmt->execute();
        $stmt->close();
    }
}

// Delete item
if (isset($_POST['delete_item'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM inventory WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Update item
if (isset($_POST['update_item'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $type = $_POST['type'];

    if (!empty($name) && is_numeric($quantity) && $quantity >= 0) {
        $stmt = $conn->prepare("UPDATE inventory SET name = ?, quantity = ?, price = ?, image = ?, type = ? WHERE id = ?");
        $stmt->bind_param("siissi", $name, $quantity, $price, $image, $type, $id);
        $stmt->execute();
        $stmt->close();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <style>
        /* Dark Mode Base Styles */
        body::-webkit-scrollbar {
    display: none;
}
        body {
            background-color: #121212;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
            color: #ffffff;
            font-size: 32px;
            font-weight: 300;
        }

        /* Table Styles */
        table {
            width: 95%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #1e1e1e;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        }
        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #333;
        }
        th {
            background-color: #333333;
            font-weight: 500;
        }
        td {
            background-color: #1b1b1b;
        }
        tr:hover {
            background-color: #333333;
        }

        /* Button Styles */
        button {
            padding: 8px 15px;
            margin: 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        .btn-delete {
            background-color: #f44336;
        }
        .btn-delete:hover {
            background-color: #e53935;
        }
        .btn-edit {
            background-color: #2196F3;
        }
        .btn-edit:hover {
            background-color: #1976D2;
        }
        .btn-update {
            background-color: #FF9800;
        }
        .btn-update:hover {
            background-color: #F57C00;
        }
        
        /* Input Form Styles */
        .add-item-form {
            display: flex;
            justify-content: space-around;
            margin: 20px auto;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 10px;
            width: 92%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
        }
        .add-item-form input {
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
            border: 1px solid #444;
            background-color: #333;
            color: #fff;
            width: 190px;
        }
        .add-item-form button {
            flex: 1;
            padding: 10px;
            margin-left: 10px;
            background-color: #2196F3;
            border-radius: 5px;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .add-item-form button:hover {
            background-color: #1976D2;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .add-item-form {
                flex-direction: column;
                width: 100%;
            }
            .add-item-form input {
                width: 100%;
                margin-bottom: 10px;
            }
        }
        td input {
            width: 100%;
            box-sizing: border-box;
            background-color: #1b1b1b;
            color: #fff;
            border: none;
            padding: 10px;
        }
        td input[readonly] {
            background-color: #1b1b1b;
            border: none;
        }
        th:nth-child(2) {
        width: 250px;
        }
        th:nth-child(3) {
        width: 50px;
        }
        th:nth-child(4) {
        width: 70px;
        }
        th:nth-child(5) {
        width: 570px;
        }
        th:nth-child(6) {
        width: 80px;
        }
        th:nth-child(7) {
        width: 151px;
        }
    </style>
</head>
<body>

<h2>Inventory Management</h2>

<!-- Add New Item Form -->
<div class="add-item-form">
    <form method="post" style="display: flex;">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="number" name="quantity" placeholder="Quantity" min="0" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="text" name="image" placeholder="Image URL" required>
        <input type="text" name="type" placeholder="Product Type" required>
        <button type="submit" name="new_item">Add New Item</button>
    </form>
</div>

<!-- Display Items from Inventory Table -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Image</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <form method="post">
                <td><?php echo $row['id']; ?></td>
                <td><input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" readonly></td>
                <td><input type="number" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>" readonly></td>
                <td><input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" readonly></td>
                <td><input type="text" name="image" value="<?php echo htmlspecialchars($row['image']); ?>" readonly></td>
                <td><input type="text" name="type" value="<?php echo htmlspecialchars($row['type']); ?>" readonly></td>
                <td>
                    <button type="button" class="btn-edit" onclick="editRow(this)">Edit</button>
                    <button type="submit" name="update_item" class="btn-update" style="display: none;">Update</button>
                    <button type="submit" name="delete_item" class="btn-delete">Delete</button>
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                </td>
            </form>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<!-- JavaScript to Handle Edit Button Clicks -->
<script>
    function editRow(button) {
        const row = button.closest('tr');
        const inputs = row.querySelectorAll('input[readonly]');
        inputs.forEach(input => input.removeAttribute('readonly'));

        const updateButton = row.querySelector('.btn-update');
        updateButton.style.display = 'inline-block'; // Show the update button
    }
</script>

<!-- Close Database Connection -->
<?php $conn->close(); ?>

</body>
</html>