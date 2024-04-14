<?php
$dbhost = 'db';
$dbname = 'authentication_php';
$dbuser = 'root';
$dbpass = 'nimda';

try {
    $pdo = new PDO("mysql:host=$dbhost; dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection error: ", $e->getMessage();
}
