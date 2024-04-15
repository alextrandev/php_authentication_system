<?php
ob_start();
session_start();
if (!isset($_SESSION['user'])) {
    include('./components/config.php');
    header('Location: ' . BASE_URL . '/login.php');
    exit();
}

include './components/header.php'; ?>

<h2 class="mb_10">Dashboard</h2>
<p>Hi Alex, Welcome to dashboard</p>

<h2 class="mt_20">Your Profile Information</h2>
<table class="t1">
    <tr>
        <td>First Name:</td>
        <td>Alex</td>
    </tr>
    <tr>
        <td>Last Name:</td>
        <td>Tran</td>
    </tr>
    <tr>
        <td>Email:</td>
        <td>alex@gexample.com</td>
    </tr>
    <tr>
        <td>Phone:</td>
        <td>111111</td>
    </tr>
</table>

<?php include './components/footer.php'; ?>