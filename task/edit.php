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
    // if (!isset($_SESSION['user_id'])) 
    // {
    // header("Location: ../../../loginController.php?msg=Je moet eerst inloggen!");
    // exit;
    // }
    ?>

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

                <label for="status">Status:</label>
                <div class="dropdown">
                    <select name="status" id="status" class="form-input" value="">
                        <option value="<?php echo $tasks['status']; ?>"><?php echo $tasks['status']; ?></option>
                        <option value="Todo">Todo</option>
                        <option value="Doing">Doing</option>
                        <option value="Done">Done</option>
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