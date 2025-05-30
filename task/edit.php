<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php?msg=Je moet eerst inloggen!");
    exit;
}
?>

<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once '../components/head.php'; ?>
</head>

<body>
    <?php require_once '../components/header.php'; ?>



    <?php
    //1. verbinding
    require_once '../backend/conn.php';

    $id = $_GET['id'];
    $query = "SELECT * FROM taken WHERE id = :id";
    $statement = $conn->prepare($query);
    $statement->execute([':id' => $id]);
    $tasks = $statement->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="container" id="createTask">
        <h1>Taak aanpassen</h1>

        <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
                <label for="titel">Titel:</label>
                <div>
                    <input type="text" name="titel" id="titel" class="form-input"
                        value="<?php echo $tasks['titel']; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="beschrijving">Beschrijving:</label>
                <div>
                    <textarea name="beschrijving" id="beschrijving" class="form-input"
                        rows="4"><?php echo $tasks['beschrijving']; ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <?php 

                    $query = "SELECT naam, id FROM users";
                    $statement = $conn->prepare($query);
                    $statement->execute();
                    $users = $statement->fetchAll(PDO::FETCH_ASSOC);

                    ?>

                    <div class="form-group">
                        <label for="forID">Toegewezen gebruiker:</label>
                        <div class="dropdown">
                            <select id="forID" name="forID"  class="form-input">
                                <?php foreach($users as $user): ?>
                                    <option value="<?php echo $user['id']; ?>" <?php if ($tasks['forID'] == $user['id']) echo 'selected'; ?>><?php echo $user['naam']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            <div class="form-group">

                <label for="afdeling">Afdeling:</label>
                <div class="dropdown">
                    <select name="afdeling" id="afdeling" class="form-input">
                        <option value="<?php echo $tasks['afdeling']; ?>"><?php echo $tasks['afdeling']; ?></option>
                        <option value="Personeel">Personeel</option>
                        <option value="Horeca">Horeca</option>
                        <option value="Techniek">Techniek</option>
                        <option value="Inkoop">Inkoop</option>
                        <option value="Klantenservice">Klantenservice </option>
                        <option value="Groen">Groen</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="category">Categorie</label>
                <div class="dropdown">
                    <select id="category" name="category"  class="form-input">
                        <option value="<?php echo $tasks['category']; ?>"><?php echo ucfirst($tasks['category']); ?></option>
                        <option value="black">Geen kleur</option>
                        <option value="red">Rood</option>
                        <option value="blue">Blauw</option>
                        <option value="green">Groen</option>
                        <option value="yellow">Geel</option>
                        <option value="orange">Oranje</option>
                        <option value="purple">Paars</option>
                    </select>
                </div>
            </div>

            <div class="form-group">

                <label for="status">Status:</label>
                <div class="dropdown">
                    <select name="status" id="status" class="form-input" value="">
                    <option value="Todo" <?php if ($tasks['status'] == 'Todo') echo 'selected'; ?>>Todo</option>
                    <option value="Doing" <?php if ($tasks['status'] == 'Doing') echo 'selected'; ?>>Doing</option>
                    <option value="Done" <?php if ($tasks['status'] == 'Done') echo 'selected'; ?>>Done</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" name="deadline" id="deadline" class="datetime"
                    value="<?php echo $tasks['deadline']; ?>">
            </div>
            
            <div class="form-container">
                <input type="submit" value="Melding opslaan" class="buttonOP">

        </form>

        <form action="<?php echo $base_url; ?>../backend/controllers/taskController.php" method="POST"
            onsubmit="return confirm('Weet je zeker dat je deze melding wilt verwijderen?');">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="VerwijderenButten">
                <input type="submit" value="Verwijderen" class="buttonVV">
            </div>
        </form>
    </div>
    </div>

</body>

</html>