<?php
require_once '../conn.php';

$action = $_POST['action'];

if ($action == "create") {
    $titel = $_POST["titel"];
    if (empty($titel)) {
        $errors[] = "Vul de taak-naam in. ";
    }

    $beschrijving = $_POST["beschrijving"];
    if (empty($beschrijving)) {
        $errors[] = "Vul de beschrijving in. ";
    }
    $afdeling = $_POST["afdeling"];
    if (empty($afdeling)) {
        $errors[] = "Vul de afdeling in. ";
    }

    $status = $_POST["status"];
    if (empty($status)) {
        $errors[] = "Vul de status in. ";
    }


    $deadline = $_POST["deadline"];
    if (empty($deadline)) {
        $errors[] = "Vul de deadline in. ";
    }

    $user = $_POST["user"];
    if (empty($user)) {
        $errors[] = "Vul de user in. ";
    }

    if (isset($errors)) {
        var_dump($errors);
        die();
    }
    $query = "INSERT INTO taken (titel, beschrijving, afdeling, status, deadline, user )
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

if ($action == "update") {
    $id = $_POST["id"];

    $titel = $_POST["titel"];
    $beschrijving = $_POST["beschrijving"];
    $afdeling = $_POST["afdeling"];
    $status = $_POST['status'];
    $deadline = $_POST["deadline"];
    $user = $_POST["user"];


    $query = "UPDATE taken SET titel = :titel, beschrijving = :beschrijving, afdeling = :afdeling, status = :status, deadline = :deadline, user = :user WHERE id = :id;";
    $statement = $conn->prepare($query);

    $statement->execute([
        ":titel"=> $titel,
        ":beschrijving"=> $beschrijving,
        ":afdeling"=> $afdeling,
        ":status"=> $status,
        ":deadline"=> $deadline,
        ":user"=> $user,
        ":id" => $id
    ]);

    header("Location: ../../task/index.php?msg=Taak veranderd!");

}

if ($action == 'delete') {
    require_once '../conn.php';

    if (!isset($_POST['id']) || empty($_POST['id'])) {
        header("Location: ../../../resources/views/meldingen/index.php?msg=Geen ID opgegeven!");
        exit();
    }

    $id = $_POST['id'];
    $query = "DELETE FROM taken WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([':id' => $id]);

    header("Location: ../../task/index.php?msg=Taak verwijderd!");
    exit();
}
?>