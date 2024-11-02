<?php

// Insert Manufacturer Function
function insertManufacturers($pdo, $company_name, $founding_date, $specialization, $user_id) {
    $stmt = $pdo->prepare("INSERT INTO manufacturers (company_name, founding_date, specialization, added_by, last_updated) VALUES (?, ?, ?, ?, NOW())");
    return $stmt->execute([$company_name, $founding_date, $specialization, $user_id]);
}


// Update Manufacturer Function
function updateManufacturers($pdo, $company_name, $founding_date, $specialization, $user_id, $manufacturer_id) {
    $stmt = $pdo->prepare("UPDATE manufacturers SET company_name = ?, founding_date = ?, specialization = ?, last_updated = NOW(), added_by = ? WHERE manufacturer_id = ?");
    return $stmt->execute([$company_name, $founding_date, $specialization, $user_id, $manufacturer_id]);
}


// Delete Manufacturer Function
function deleteManufacturers($pdo, $manufacturer_id) {
    $sql = "DELETE FROM manufacturers WHERE manufacturer_id = ?";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$manufacturer_id]);

    return $executeQuery ? true : false;
}

// Insert Product Functionfunction insertProducts($pdo, $manufacturer_id, $product_name, $date_manufactured, $quantity, $price, $brand, $warranty_period, $user_id) {
    function insertProducts($pdo, $manufacturer_id, $product_name, $date_manufactured, $quantity, $price, $brand, $warranty_period, $user_id) {
        $sql = "INSERT INTO products (manufacturer_id, product_name, date_manufactured, quantity, price, brand, warranty_period, added_by, last_updated) 
                VALUES (:manufacturer_id, :product_name, :date_manufactured, :quantity, :price, :brand, :warranty_period, :added_by, NOW())";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':manufacturer_id' => $manufacturer_id,
            ':product_name' => $product_name,
            ':date_manufactured' => $date_manufactured,
            ':quantity' => $quantity,
            ':price' => $price,
            ':brand' => $brand,
            ':warranty_period' => $warranty_period,
            ':added_by' => $user_id,
        ]);
    }
    






// Function to update a product
function updateProducts($pdo, $manufacturer_id, $product_name, $date_manufactured, $quantity, $price, $brand, $warranty_period, $user_id, $product_id) {
    $sql = "UPDATE products 
            SET manufacturer_id = :manufacturer_id, product_name = :product_name, date_manufactured = :date_manufactured, 
                quantity = :quantity, price = :price, brand = :brand, warranty_period = :warranty_period, 
                added_by = :user_id, last_updated = NOW()
            WHERE product_id = :product_id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':manufacturer_id' => $manufacturer_id,
        ':product_name' => $product_name,
        ':date_manufactured' => $date_manufactured,
        ':quantity' => $quantity,
        ':price' => $price,
        ':brand' => $brand,
        ':warranty_period' => $warranty_period,
        ':user_id' => $user_id,
        ':product_id' => $product_id
    ]);
}





// Function to delete a product
function deleteProducts($pdo, $product_id) {
    $stmt = $pdo->prepare("DELETE FROM products WHERE product_id = ?");
    return $stmt->execute([$product_id]);
}

// Get All Manufacturers
function getManufacturerById($pdo, $manufacturer_id) {
    $sql = "SELECT * FROM manufacturers WHERE manufacturer_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$manufacturer_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // Make sure you fetch the data as an associative array
}

// Function to get all productsfunction getAllProducts($pdo) {
    function getAllProducts($pdo) {
        $sql = "SELECT p.*, u.username 
                FROM products p
                LEFT JOIN users u ON p.added_by = u.user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


function getProductById($pdo, $product_id) {
    $sql = "SELECT * FROM Products WHERE product_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch as associative array
}

function registerUser($pdo, $username, $password, $first_name, $last_name, $address, $age, $added_by = null) {
    // Prepare an insert query
    $stmt = $pdo->prepare("INSERT INTO users (username, password, first_name, last_name, address, age, added_by) 
                           VALUES (?, ?, ?, ?, ?, ?, ?)");
    // Execute the query with parameter values
    return $stmt->execute([$username, $password, $first_name, $last_name, $address, $age, $added_by]);
}


function loginUser($pdo, $username, $password) {
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        return $user;  // Return user data for session
    }
    return false;
}

function logoutUser() {
    session_start();
    session_destroy();
}

function getUsernameById($pdo, $user_id) {
    $sql = "SELECT username FROM users WHERE user_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn(); // Fetches just the username
}



function getAllManufacturers($pdo) {
    $stmt = $pdo->prepare("
        SELECT m.*, u.username 
        FROM manufacturers m 
        LEFT JOIN users u ON m.added_by = u.username
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}