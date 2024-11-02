
<?php
session_start();
require_once 'dbConfig.php';
require_once 'models.php';

// Check if user is logged in
if (!isset($_SESSION['firstName'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manufacturers and Products Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1, h2 {
            color: #2c3e50;
        }
        form {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #2980b9;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            width: calc(33.333% - 20px);
            box-sizing: border-box;
        }
        .card h3 {
            margin-top: 0;
            color: #2c3e50;
        }
        .card p {
            margin: 5px 0;
        }
        .card-actions {
            margin-top: 10px;
        }
        .card-actions a {
            text-decoration: none;
            color: #3498db;
            margin-right: 10px;
        }
        .card-actions a:hover {
            text-decoration: underline;
        }
        @media (max-width: 768px) {
            .card {
                width: calc(50% - 20px);
            }
        }
        @media (max-width: 480px) {
            .card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Manufacturers and Products Management System</h1>
    
    <h2>Add a New Manufacturer</h2>
    <form action="core/handleForms.php" method="POST">
        <label for="company_name">Company Name</label>
        <input type="text" name="company_name" id="company_name" required>
        
        <label for="founding_date">Founding Date</label>
        <input type="date" name="founding_date" id="founding_date" required>
        
        <label for="specialization">Specialization</label>
        <input type="text" name="specialization" id="specialization" required>
        
        <input type="submit" name="insertManufacturerBtn" value="Add Manufacturer">
    </form>
    
    <h2>All Manufacturers</h2>
<div class="container">
    <?php $getAllManufacturers = getAllManufacturers($pdo); ?>
    <?php foreach ($getAllManufacturers as $manufacturer) { ?>
        <div class="card">
            <h3><?php echo htmlspecialchars($manufacturer['company_name']); ?></h3>
            <p>Founded: <?php echo htmlspecialchars($manufacturer['founding_date']); ?></p>
            <p>Specialization: <?php echo htmlspecialchars($manufacturer['specialization']); ?></p>
            <p>Added By: <?php echo htmlspecialchars(getUsernameById($pdo, $manufacturer['added_by']) ?: 'N/A'); ?></p>
            <p>Last Updated: <?php echo htmlspecialchars($manufacturer['last_updated']); ?></p>
            <div class="card-actions">
                <a href="viewproducts.php?manufacturer_id=<?php echo $manufacturer['manufacturer_id']; ?>">View Products</a>
                <a href="core/editmanufacturer.php?manufacturer_id=<?php echo $manufacturer['manufacturer_id']; ?>">Edit</a>
                <a href="core/deletemanufacturer.php?manufacturer_id=<?php echo $manufacturer['manufacturer_id']; ?>">Delete</a>
            </div>
        </div>
    <?php } ?>
</div>
    <h2>Add a New Product</h2>
    <form action="core/handleForms.php" method="POST">
        <label for="manufacturer_id">Manufacturer ID</label>
        <input type="number" name="manufacturer_id" id="manufacturer_id" required>
        
        <label for="product_name">Product Name</label>
        <input type="text" name="product_name" id="product_name" required>
        
        <label for="date_manufactured">Date Manufactured</label>
        <input type="date" name="date_manufactured" id="date_manufactured" required>
        
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" id="quantity" required>
        
        <label for="price">Price</label>
        <input type="number" step="0.01" name="price" id="price" required>
        
        <label for="brand">Brand</label>
        <input type="text" name="brand" id="brand" required>
        
        <label for="warranty_period">Warranty Period (months)</label>
        <input type="number" name="warranty_period" id="warranty_period" required>
        
        <input type="submit" name="insertProductBtn" value="Add Product">
    </form>

    <h2>All Products</h2>
    <div class="container">
    <?php $getAllProducts = getAllProducts($pdo); ?>
    <?php foreach ($getAllProducts as $product) { ?>
        <div class="card">
            <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
            <p>Brand: <?php echo htmlspecialchars($product['brand']); ?></p>
            <p>Manufactured: <?php echo htmlspecialchars($product['date_manufactured']); ?></p>
            <p>Quantity: <?php echo htmlspecialchars($product['quantity']); ?></p>
            <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
            <p>Warranty: <?php echo htmlspecialchars($product['warranty_period']); ?> months</p>
            <p>Added By: <?php echo htmlspecialchars($product['username']); ?></p>
            <p>Last Updated: <?php echo htmlspecialchars($product['last_updated']); ?></p>
            <div class="card-actions">
                <a href="core/editproduct.php?product_id=<?php echo $product['product_id']; ?>">Edit</a>
                <a href="core/deleteproduct.php?product_id=<?php echo $product['product_id']; ?>">Delete</a>
            </div>
        </div>
    <?php } ?>
</div>



    <p><a href="logout.php">Logout</a></p>
</body>
</html>