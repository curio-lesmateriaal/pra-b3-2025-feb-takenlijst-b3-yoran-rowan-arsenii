<?php


session_start();
$username = $_POST['username'];
$password = $_POST['password'];

require_once '../conn.php';

$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([":username" => $username]);
$user=$statement->fetch(PDO::FETCH_ASSOC);

$statement->execute([
    ":username"=>$username,
]);


if ($statement->rowCount() < 1) {
    header("Location: ../../login.php?msg=Gegevens kloppen niet!");
    exit;
}
if (!password_verify($password, $user['password'])) {
        header("Location: ../../login.php?msg=Gegevens kloppt niet!");
        exit;
}

$_SESSION['user_id'] = $user['id'];


header("Location: ../../index.php");

?>