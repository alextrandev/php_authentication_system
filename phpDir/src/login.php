<?php
if (isset($_SESSION['user'])) {
    include_once('./components/config.php');
    header('Location: ' . BASE_URL);
    exit();
}

include_once './components/header.php';

if (isset($_POST['login_form'])) {
    try {
        ['email' => $email, 'password' => $pwd] = $_POST;

        if ($email == '') {
            throw new Exception('Email cannot be empty');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format (Example@example.com)');
        }

        if ($pwd == '') {
            throw new Exception('Password cannot be empty');
        }

        $stmt = $pdo->prepare("SELECT password FROM users WHERE email=?");
        $stmt->execute([$email]);
        $total = $stmt->rowCount();
        if (!$total) {
            $loginLink = "<a href='" . BASE_URL . "/registration.php" . "'>Create new account</a>";
            throw new Exception('Email not found. Try again or ' . $loginLink);
        }

        $pwd_hash = $stmt->fetchColumn();
        if (!password_verify($pwd, $pwd_hash)) {
            $forgetPwdLink = "<a href='" . BASE_URL . "/forget_password.php" . "'>Recover password</a>";
            throw new Exception('Email or password does not match. Try again or ' . $forgetPwdLink);
        }

        echo "success!";
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
            <td><input type="text" name="email" value="<?= $email ?? '' ?>" autocomplete="off"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" autocomplete="off"></td>
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