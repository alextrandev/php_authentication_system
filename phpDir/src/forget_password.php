<?php include './components/header.php';

if (isset($_POST['forget_form'])) {
    try {
        $email = htmlentities($_POST['email']);

        if ($email == '') {
            throw new Exception('Email cannot be empty');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format (Example@example.com)');
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $total = $stmt->rowCount();
        if (!$total) {
            $registerLink = "<a href='" . BASE_URL . "/registration.php" . "'>Create new account</a>";
            throw new Exception('Email not found. Try again or ' . $registerLink);
        }

        $success_msg = "Please check your email for password reset instruction";
    } catch (Exception $e) {
        $error_msg = $e->getMessage();
    }
} ?>

<h2 class="mb_10">Forget Password</h2>

<?php if (isset($error_msg)) : ?>
    <p class='error'><?= $error_msg ?></p>
<?php elseif (isset($success_msg)) : ?>
    <p class='success'><?= $success_msg ?></p>
<?php endif; ?>

<form action="" method="post">
    <table class="t2">
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" autocomplete="off"></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" value="Submit" name="forget_form">
                <a href="<?= BASE_URL ?>/login.php" class="primary_color">Back to Login Page</a>
            </td>
        </tr>
    </table>
</form>

<?php include './components/footer.php'; ?>