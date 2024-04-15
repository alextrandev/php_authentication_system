<?php include './components/header.php';
if (!isset($_SESSION['user'])) {
    include('./components/config.php');
    header('Location: ' . BASE_URL . '/login.php');
    exit();
}

["firstname" => $fn, "lastname" => $ln, "email" => $email, "phone" => $phone, "status" => $status] = $_SESSION['user']; ?>

<?php if ($status == 0) : ?>
    <p class="error">Please verify your email to get full access</p>
<?php endif; ?>

<h2 class="mb_10">Dashboard</h2>
<p>Hi <?= $fn ?>, Welcome to dashboard</p>

<h2 class="mt_20">Your Profile Information</h2>
<table class="t1">
    <tr>
        <td>First Name:</td>
        <td><?= $fn ?></td>
    </tr>
    <tr>
        <td>Last Name:</td>
        <td><?= $ln ?></td>
    </tr>
    <tr>
        <td>Email:</td>
        <td><?= $email ?></td>
    </tr>
    <tr>
        <td>Phone:</td>
        <td><?= $phone ?>/td>
    </tr>
</table>

<?php include './components/footer.php'; ?>