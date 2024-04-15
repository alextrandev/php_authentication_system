<?php include_once('./components/config.php');

if (!isset($_REQUEST['email']) || !isset($_REQUEST['token'])) {
    header("Location: " . BASE_URL);
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE email=? AND token=?");
$stmt->execute([$_GET['email'], $_GET['token']]);
$total = $stmt->rowCount();

if ($total) {
    $stmt = $pdo->prepare("UPDATE users SET token=?, status=? WHERE email=? AND token=?");
    $stmt->execute(['', 1, $_REQUEST['email'], $_REQUEST['token']]);
    header("Location: " . BASE_URL . "/registration_success.php");
} else {
    header("Location: " . BASE_URL);
}
