<?php include './components/header.php';

if (isset($_POST["registration_form"])) {
    try {
        list('firstname' => $fn, 'lastname' => $ln, 'email' => $email, 'phone' => $phone, 'password' => $pwd, 'retype_password' => $pwd_retype) = $_POST;

        include './components/input_validation.php';

        $password = password_hash($pwd, PASSWORD_DEFAULT);
        $token = time();
        $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, phone, password, token, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$fn, $ln, $email, $phone, $password, $token, 0]);

        //send verification mail with PHPMailer
        $link = BASE_URL . "/registration_verify.php" . "?email=$email&token=$token";
        $email_msg = 'Please click this link to verify your account <br>';
        $email_msg .= '<a href="' . $link . '">Click here</a>';
        $email_subject = 'Account verification';
        include './components/PHPMailer.php';
        $success_msg = 'Registration is completed. A verification email is sent to your email address.';

        unset($fn, $ln, $email, $phone);
    } catch (Exception $e) {
        $error_msg = $e->getMessage();
    }
}

?>

<h2 class="mb_10">Registration</h2>

<?php if (isset($error_msg)) : ?>
    <p class='error'><?= $error_msg ?></p>
<?php elseif (isset($success_msg)) : ?>
    <p class='success'><?= $success_msg ?></p>
<?php endif; ?>

<form action="" method="post">
    <table class="t2">
        <tr>
            <td>First Name</td>
            <td><input type="text" name="firstname" value="<?= $fn ?? '' ?>" autocomplete="off"></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="lastname" value="<?= $ln ?? '' ?>" autocomplete="off"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?= $email ?? '' ?>" autocomplete="off"></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><input type="text" name="phone" value="<?= $phone ?? '' ?>" autocomplete="off"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" autocomplete="off"></td>
        </tr>
        <tr>
            <td>Retype Password</td>
            <td><input type="password" name="retype_password" autocomplete="off"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Submit" name="registration_form"></td>
        </tr>
    </table>
</form>

<?php include './components/footer.php'; ?>