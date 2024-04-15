<?php include './components/header.php'; ?>

<h2>Welcome to the registration website</h2>
<p>In this website, you can register an account and login</p>

<h2 class="mt_20 mb_20">Registered users</h2>
<table class="t1">
    <tr>
        <th>ID</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Phone</th>
    </tr>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM users");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $id => $user) :
        ["firstname" => $fn, "lastname" => $ln, "email" => $email, "phone" => $phone] = $user;
        $id++;
        echo <<<HTML
            <tr>
                <td>$id</td>
                <td>$fn</td>
                <td>$ln</td>
                <td>$email</td>
                <td>$phone</td>
            </tr>
        HTML;
    endforeach;
    ?>
</table>

<?php include './components/footer.php'; ?>