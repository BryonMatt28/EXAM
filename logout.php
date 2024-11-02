<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out - Manufacturers and Products Management System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #2c3e50;
        }
        .message {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s ease;
        }
        .button:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Logged Out</h1>
    <div class="message">
        <p>You have been successfully logged out.</p>
    </div>
    <a href="login.php" class="button">Return to Login Page</a>
</body>
</html>
