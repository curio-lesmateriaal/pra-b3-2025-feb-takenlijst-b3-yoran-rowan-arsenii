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
        
        <div class="msg-block" style: pading>

            <?php
            if (isset($_GET['msg'])) {
                echo "<div class='msg' id='msg'>" . htmlspecialchars($_GET['msg']) . "</div>";
            }
            ?>

        </div>

        <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST">
            <input type="hidden" name="action" value="create">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
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
                <label for="category">Categorie</label>
                <div class="dropdown">
                    <select id="category" name="category"  class="form-input">
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
                <label for="deadline">Deadline:</label>
                <input type="date" name="deadline" id="deadline" class="datetime">
            </div>

            <div class="butten">
                <input type="submit" class="form-input" value="Taak aanmaken">
            </div>

        </form>
    </div>
</body>

<script>
        setTimeout(function () {
        var msg = document.getElementById('msg');
        if (msg) {
            msg.style.transition = "opacity 1s";
            msg.style.opacity = "0";

            setTimeout(function () {
                msg.remove();
            }, 1000);
        }
    }, 5000);
</script>