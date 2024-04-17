<?php include './components/header.php';
if (isset($_SESSION['user'])) {
    header('Location: ' . BASE_URL);
    exit();
}


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

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $total = $stmt->rowCount();
        if (!$total) {
            $loginLink = "<a href='" . BASE_URL . "/registration.php" . "'>Create new account</a>";
            throw new Exception('Email not found. Try again or ' . $loginLink);
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $row = $result[0];
        if (!password_verify($pwd, $row['password'])) {
            $forgetPwdLink = "<a href='" . BASE_URL . "/forget_password.php" . "'>Recover password</a>";
            throw new Exception('Email or password does not match. Try again or ' . $forgetPwdLink);
        }

        unset($row['password']);
        $_SESSION['user'] = $row;
        header('Location: ' . BASE_URL . '/dashboard.php');
    } catch (Exception $e) {
        $error_msg = $e->getMessage();
    }
} ?>

<h2 class="mb_10">Login</h2>

<?php if (isset($error_msg)) : ?>
    <p class='error'><?= $error_msg ?></p>
<?php elseif (isset($_GET['logout'])) : ?>
    <p class='success'>Successfully logged out</p>
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
                <a href="<?= BASE_URL ?>/forget_password.php" class="primary_color">Forget Password</a>
            </td>
        </tr>
    </table>
</form>

<?php include_once './components/footer.php'; ?>