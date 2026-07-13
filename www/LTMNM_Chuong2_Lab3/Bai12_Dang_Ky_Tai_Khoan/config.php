<?php
$pdo = new PDO(
    'mysql:host=db;dbname=ltmnm;charset=utf8mb4',
    'root',
    'root'
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
