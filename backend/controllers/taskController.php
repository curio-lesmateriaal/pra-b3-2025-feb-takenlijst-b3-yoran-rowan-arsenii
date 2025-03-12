<?php
require_once '../conn.php';

$action = $_POST['action'];

if ($action == "create") {
    $titel = $_POST["titel"];
    if (empty($titel)) {
        $errors[] = "Vul de taak-naam in. ";
    }

    $beschrijving = $_POST["beschrijving"];
    if (empty($titel)) {
        $errors[] = "Vul de beschrijving in. ";
    }
    $afdeling = $_POST["afdeling"];
    if (empty($titel)) {
        $errors[] = "Vul de afdeling in. ";
    }


    //!!!! ondere nog maken
    $status = "status";
    if (empty($titel)) {
        $errors[] = "Vul de status in. ";
    }


    $deadline = $_POST["deadline"];
    if (empty($titel)) {
        $errors[] = "Vul de deadline in. ";
    }

    $user = $_POST["user"];
    if (empty($titel)) {
        $errors[] = "Vul de user in. ";
    }

    if (isset($errors)) {
        var_dump($errors);
        die();
    }
    $query = "INSERT INTO taken (titel, beschrijving, afdeling, status, deadline, user)
    VALUES (:titel, :beschrijving, :afdeling, :status, :deadline, :user);";

    $statement = $conn->prepare($query);

    $statement->execute([
        ":titel"=> $titel,
        ":beschrijving"=> $beschrijving,
        ":afdeling"=> $afdeling,
        ":status"=> $status,
        ":deadline"=> $deadline,
        ":user"=> $user
    ]);

    header("Location: ../../task/index.php?msg=Taak aangemaakt!");
}

?>