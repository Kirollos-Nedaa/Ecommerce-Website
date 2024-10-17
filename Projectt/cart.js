function updateQuantity(productName, action) {
    $.ajax({
        url: 'update_quantity.php', // PHP file handling quantity update
        type: 'POST',
        data: {
            product_name: productName, // Send product name instead of product ID
            action: action
        },
        success: function(updatedQuantity) {
            // Update the quantity in the modal dynamically
            document.getElementById('quantity-' + productName).innerHTML = updatedQuantity;
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ', status, error);
        }
    });
}