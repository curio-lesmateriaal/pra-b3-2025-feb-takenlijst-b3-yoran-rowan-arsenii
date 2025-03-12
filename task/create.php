<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once '../components/head.php'; ?>
</head>

<body>
    <?php require_once '../components/header.php'; ?>
    <div class="container" id="createTask">

        <h1>Nieuwe melding</h1>

        <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST">
            <input type="hidden" name="action" value="create">

            <div class="form-group">
                <label for="titel">Naam Taak</label>
                <div>
                    <input type="text" name="titel" id="titel" class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label for="user">Nummer melder</label>
                <div>
                    <input type="number" name="user" id="user" class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label for="beschrijving">info over taak </label>
                <div>
                    <textarea name="beschrijving" id="beschrijving" class="form-input" rows="4"></textarea>
                </div>
            </div>
            <div class="form-group">

                <label for="afdeling">afdeling</label>
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

                <label for="status">status</label>
                <div class="dropdown">
                    <select name="status" id="status" class="form-input">
                        <option value=""></option>
                        <option value="Personeel">To do</option>
                        <option value="Horeca">Doing</option>
                        <option value="Techniek">Done</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <input type="date" name="deadline" id="deadline" class="datetime">
            </div>
            <div class="butten">
                <input type="submit" class="form-input" value="Verstuur melding">
            </div>

        </form>
    </div>
</body>