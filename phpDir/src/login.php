<?php
if (isset($_SESSION['user'])) {
    include_once('./components/config.php');
    header('Location: ' . BASE_URL);
    exit();
}

include_once './components/header.php';

if (isset($_POST['login_form'])) {
    try {
        if ($email == '') {
            throw new Exception('Email cannot be empty');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format (Example@example.com)');
        }

        if ($pwd == '') {
            throw new Exception('Password cannot be empty');
        }
    } catch (Exception $e) {
        $error_msg = $e->getMessage();
    }
}
?>

<h2 class="mb_10">Login</h2>

<?php if (isset($error_msg)) : ?>
    <p class='error'><?= $error_msg ?></p>
<?php endif; ?>

<form action="" method="post">
    <table class="t2">
        <tr>
            <td>Email</td>
            <td><input type="text" name="" autocomplete="off"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="" autocomplete="off"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Login" name="login_form">
                <a href="forget-password.php" class="primary_color">Forget Password</a>
            </td>
        </tr>
    </table>
</form>

<?php include './components/footer.php'; ?>