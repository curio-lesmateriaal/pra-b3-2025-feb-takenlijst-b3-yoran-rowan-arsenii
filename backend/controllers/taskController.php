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

    $deadline = $_POST["deadline"];
    if (empty($deadline)) {
        $errors[] = "Vul de deadline in. ";
    }

    $status = "Todo";
    $user = $_POST['user_id'];
    
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
        ":deadline"=>$deadline,
        ":user"=>$user,
    ]);

    header("Location: ../../task/index.php?msg=Taak aangemaakt!");
}

if ($action == "update") {
    $id = $_POST["id"];

    $titel = $_POST["titel"];
    $beschrijving = $_POST["beschrijving"];
    $afdeling = $_POST["afdeling"];
    $deadline = $_POST["deadline"];
    $status = $_POST['status'];


    $query = "UPDATE taken SET titel = :titel, beschrijving = :beschrijving, status = :status, deadline = :deadline, afdeling = :afdeling WHERE id = :id;";
    $statement = $conn->prepare($query);

    echo $id;

    $statement->execute([
        ":titel"=> $titel,
        ":beschrijving"=> $beschrijving,
        ":status"=> $status,
        ":afdeling"=> $afdeling,
        ":deadline"=> $deadline,
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