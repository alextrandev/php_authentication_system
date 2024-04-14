<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include './components/header.php';

if (isset($_POST["registration_form"])) {
    try {
        list('firstname' => $fn, 'lastname' => $ln, 'email' => $email, 'phone' => $phone, 'password' => $pwd, 'retype_password' => $pwd_retype) = $_POST;

        include './components/input_validation.php';

        $password = password_hash($pwd, PASSWORD_DEFAULT);
        $token = time();
        $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, phone, password, token, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$fn, $ln, $email, $phone, $password, $token, 0]);

        include './components/PHPMailer.php';

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