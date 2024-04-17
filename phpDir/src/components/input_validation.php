<?php
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

if ($pwd == '') {
    throw new Exception('Password cannot be empty');
}

if ($pwd !== $pwd_retype) {
    throw new Exception('Passwords does not match');
}
