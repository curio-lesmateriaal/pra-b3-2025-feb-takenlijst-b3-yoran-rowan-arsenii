<?php
require_once '../conn.php';

$action = $_POST['action'];

if ($action == "create") {
    $titel = $_POST["titel"];
    $beschrijving = $_POST["beschrijving"];
    $afdeling = $_POST["afdeling"];
    $status = "todo";
    $deadline = $_POST["deadline"];
    $user = $_POST["user"];

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