<?php
require_once '../conn.php';


$action = $_POST['action'];


if ($action === 'update_status') {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $query = "UPDATE taken SET status = :status WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ':status' => $status,
        ':id' => $id
    ]);

    header("Location: ../../task/index.php?msg=Taak bijgewerkt!");
    exit;
}


if ($action == "create") {
    $titel = $_POST["titel"];
    if (empty($titel)) {
        $errors[] = "Vul de taak-naam in.";
    }
    
    $beschrijving = $_POST["beschrijving"];
    if (empty($beschrijving)) {
        $errors[] = "Vul de beschrijving in.";
    }

    $forID = $_POST["forID"];
    if (empty($forID)) {
        $errors[] = "Vul een gebruiker in.";
    }

    $afdeling = $_POST["afdeling"];
    if (empty($afdeling)) {
        $errors[] = "Vul de afdeling in.";
    }

    $category = $_POST["category"];

    $deadline = $_POST["deadline"];
    if (empty($deadline)) {
        $errors[] = "Vul de deadline in.";
    }

    $status = "Todo";
    $user = $_POST['user_id'];

    if (isset($errors)) {
        header("Location: ../../task/create.php?msg=Alle velden moeten ingevuld worden!");
        exit;
    }

    $query = "INSERT INTO taken (titel, beschrijving, forID, afdeling, status, deadline, user, category)
              VALUES (:titel, :beschrijving, :forID, :afdeling, :status, :deadline, :user, :category)";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":titel"=> $titel,
        ":beschrijving"=> $beschrijving,
        ":forID"=>$forID,
        ":afdeling"=> $afdeling,
        ":status"=> $status,
        ":deadline"=> $deadline,
        ":user"=> $user,
        ':category' => $category,

    ]);

    header("Location: ../../task/index.php?msg=Taak aangemaakt!");
    exit;
}


if ($action == "update") {
    $id = $_POST["id"];
    $titel = $_POST["titel"];
    $beschrijving = $_POST["beschrijving"];
    $forID = $_POST['forID'];
    $afdeling = $_POST["afdeling"];
    $deadline = $_POST["deadline"];
    $status = $_POST['status'];
    $category = $_POST["category"];


    $query = "UPDATE taken SET titel = :titel, beschrijving = :beschrijving, forID = :forID, status = :status, deadline = :deadline, afdeling = :afdeling, category =:category WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([
        ":titel"=> $titel,
        ":beschrijving"=> $beschrijving,
        ":forID"=>$forID,
        ":status"=> $status,
        ":afdeling"=> $afdeling,
        ":deadline"=> $deadline,
        ":id" => $id,
        ":category"=> $category
    ]);

    header("Location: ../../task/index.php?msg=Taak veranderd!");
    exit;
}


if ($action == 'delete') {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        header("Location: ../../../resources/views/meldingen/index.php?msg=Geen ID opgegeven!");
        exit();
    }

    $id = $_POST['id'];
    $query = "DELETE FROM taken WHERE id = :id LIMIT 1";
    $statement = $conn->prepare($query);
    $statement->execute([':id' => $id]);

    header("Location: ../../task/index.php?msg=Taak verwijderd!");
    exit;
}
