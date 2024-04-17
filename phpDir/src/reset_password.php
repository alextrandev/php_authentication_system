<?php include './components/header.php';

if (isset($_POST["reset_form"])) {
    ["password" => $pwd, "retype_password" => $pwd_retype] = $_POST;
    try {
        if ($pwd == '') {
            throw new Exception('Password cannot be empty');
        }

        if ($pwd !== $pwd_retype) {
            throw new Exception('Passwords does not match');
        }
    } catch (Exception $e) {
        $error_msg = $e->getMessage();
    }
}
?>

<h2 class="mb_10">Reset Password</h2>

<?php if (isset($error_msg)) : ?>
    <p class='error'><?= $error_msg ?></p>
<?php elseif (isset($success_msg)) : ?>
    <p class='success'><?= $success_msg ?></p>
<?php endif; ?>

<form action="" method="post">
    <table class="t2">
        <tr>
            <td>New password</td>
            <td><input type="password" name="password" autocomplete="off"></td>
        </tr>
        <tr>
            <td>Retype new password</td>
            <td><input type="password" name="retype_password" autocomplete="off"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Submit" name="reset_form">
                <a href="<?= BASE_URL ?>/login.php" class="primary_color">Back to Login Page</a>
            </td>
        </tr>
    </table>
</form>

<?php include './components/footer.php'; ?>