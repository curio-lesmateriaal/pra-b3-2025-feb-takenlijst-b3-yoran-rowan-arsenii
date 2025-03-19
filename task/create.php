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
    <div class="container" id="changesTask">

        <h1>Nieuwe taak</h1>

        <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST">
            <input type="hidden" name="action" value="create">

            <div class="form-group">
                <label for="titel">Titel:</label>
                <div>
                    <input type="text" name="titel" id="titel" class="form-input">
                </div>
            </div>



            <div class="form-group">
                <label for="beschrijving">Beschrijving:</label>
                <div>
                    <textarea name="beschrijving" id="beschrijving" class="form-input" rows="4"></textarea>
                </div>
            </div>
            <div class="form-group">

                <label for="afdeling">Afdeling:</label>
                <div class="dropdown">
                    <select name="afdeling" id="afdeling" class="form-input">
                        <option value=""></option>
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
                <label for="deadline">Deadline:</label>
                <input type="date" name="deadline" id="deadline" class="datetime">
            </div>
            
            <div class="butten">
                <input type="submit" class="form-input" value="Taak aanmaken">
            </div>

        </form>
    </div>
</body>