<?php
ob_start();
session_start();
include('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication System</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="wrapper">
        <div class="container">

            <div class="nav">
                <ul>
                    <li><a href="<?= BASE_URL ?>">Home</a></li>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <li><a href="<?= BASE_URL ?>/dashboard.php">Dashboard</a></li>
                        <li><a href="<?= BASE_URL ?>/logout.php">Logout</a></li>
                    <?php else : ?>
                        <li><a href="<?= BASE_URL ?>/registration.php">Register</a></li>
                        <li><a href="<?= BASE_URL ?>/login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>

            <div class="main">