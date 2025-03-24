<?php
require_once '../conn.php';

session_start();
$action = $_POST['action'];

if ($action == 'create') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    if (empty($name)) {
        $errors[] = "Vul name in. ";
    }

    if (empty($username)) {
        $errors[] = "Vul username in. ";
    }

    if (empty($password )) {
        $errors[] = "Vul de password in. ";
    }

    if (isset($errors)) {
        header('Location: ../../register.php?msg=niet alles ingevuld!');
        exit;

    }
    if ($password != $passwordConfirm) {
        header('Location: ../../register.php?msg=Wachtwoord is niet hetzelfde!');
        exit;
    }

    $query = "SELECT username FROM users WHERE username = :username";
    $statement = $conn->prepare($query);
    $statement->execute([':username' => $username]);

    if ($statement->rowCount() > 0) {
        header('Location: ../../register.php?msg=Username is al in gebruik!');
        exit;
    }
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);


    $query = "INSERT INTO users (naam, username, password)
    VALUES (:name, :username, :password);";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":name"=> $username,
        ":username"=> $username,
        ":password"=> $hashPassword,
    ]);

    header("Location: ../../login.php?msg=Account aangemaakt!");


}

if ($action == 'login') {
    $username = $_POST['username'];
    
    $password = $_POST['password'];
    
    
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
}
?>