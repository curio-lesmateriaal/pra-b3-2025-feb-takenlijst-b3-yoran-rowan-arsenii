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
                <label for="attractie">Naam Taak</label>
                <div>
                    <input type="text" name="attractie" id="attractie" class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label for="capaciteit">Naam melder</label>
                <div>
                    <input type="text"  name="capaciteit" id="capaciteit" class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label for="overige_info">info over taak </label>
                <div>
                    <textarea name="overig" id="overig" class="form-input" rows="4"></textarea>
                </div>
            </div>
            <div class="form-group">

                <label for="type">afdeling</label>
                <div class="dropdown">
                    <select name="type" id="type" class="form-input">
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
            <div class="butten">
                <input type="submit" class="form-input" value="Verstuur melding">
            </div>

        </form>
    </div>
</body>