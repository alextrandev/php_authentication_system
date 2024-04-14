<?php include './components/header.php'; ?>

<?php
if (isset($_POST["registration_form"])) {
    try {
        if ($_POST['firstname'] == '') {
            throw new Exception('First name cannot be empty');
        }

        if ($_POST['lastname'] == '') {
            throw new Exception('Last name cannot be empty');
        }

        if ($_POST['email'] == '') {
            throw new Exception('Email cannot be empty');
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format (Example@example.com)');
        }

        // check if email already exist in db
        include_once 'config.php';
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$_POST['email']]);
        $total = $stmt->rowCount();
        if ($total) {
            throw new Exception('Email already exists');
        }

        if ($_POST['phone'] == '') {
            throw new Exception('Phone number cannot be empty');
        }

        if ($_POST['password'] == '' || $_POST['retype_password'] == '') {
            throw new Exception('Password cannot be empty');
        } elseif ($_POST['password'] !== $_POST['retype_password']) {
            throw new Exception('Passwords does not match');
        }

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (firstname, lastname, email, phone, password, token, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone'], $password, '', 0]);

        $_POST = array();
        $success_msg = 'Registration is completed. A verification email is sent to your email address.';
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
            <td><input type="text" name="firstname" value="<?= $_POST['firstname'] ?? '' ?>" autocomplete="off"></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type="text" name="lastname" value="<?= $_POST['lastname'] ?? '' ?>" autocomplete="off"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?= $_POST['email'] ?? '' ?>" autocomplete="off"></td>
        </tr>
        <tr>
            <td>Phone</td>
            <td><input type="text" name="phone" value="<?= $_POST['phone'] ?? '' ?>" autocomplete="off"></td>
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