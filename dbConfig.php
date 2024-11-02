<?php  

$host = "localhost";
$user = "root";
$password = "";
$dbname = "patawaran_a4";
$dsn = "mysql:host={$host};dbname={$dbname}";

$pdo = new PDO($dsn,$user,$password);
$pdo->exec("SET time_zone = '+08:00';");

