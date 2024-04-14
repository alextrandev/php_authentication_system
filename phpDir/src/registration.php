<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

include './components/header.php';

if (isset($_POST["registration_form"])) {
    try {
        list('firstname' => $fn, 'lastname' => $ln, 'email' => $email, 'phone' => $phone, 'password' => $pwd, 'retype_password' => $pwd_retype) = $_POST;

        if ($fn == '') {
            throw new Exception('First name cannot be empty');
        }

        if ($ln == '') {
            throw new Exception('Last name cannot be empty');
        }

        if ($email == '') {
            throw new Exception('Email cannot be empty');
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format (Example@example.com)');
        }

        // check if email already exist in db
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$email]);
        $total = $stmt->rowCount();
        if ($total) {
            throw new Exception('Email already exists');
        }

        if ($phone == '') {
            throw new Exception('Phone number cannot be empty');
        }

        if ($pwd == '' || $pwd_retype == '') {
            throw new Exception('Password cannot be empty');
        } elseif ($pwd !== $pwd_retype) {
            throw new Exception('Passwords does not match');
        }

        $password = password_hash($pwd, PASSWORD_DEFAULT);
        $token = time();

        $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, phone, password, token, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$fn, $ln, $email, $phone, $password, $token, 0]);

        // send verification mail
        $link = BASE_URL . $_SERVER['PHP_SELF'] . "?email=$email&token=$token";
        $email_msg = 'Please click this link to verify your account <br>';
        $email_msg .= '<a href="' . $link . '">Click here</a>';

        require './vendor/autoload.php';
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth   = true;
            $mail->Username   = '5dce458b8033d8';
            $mail->Password   = '3e7f627df5b510';
            $mail->Port       = 2525;
            //Recipients
            $mail->setFrom('contact@example.com');
            $mail->addAddress($email);
            $mail->addReplyTo('contact@example.com', 'Information');
            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Account verification';
            $mail->Body    = $email_msg;
            $mail->send();

            $success_msg = 'Registration is completed. A verification email is sent to your email address.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
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