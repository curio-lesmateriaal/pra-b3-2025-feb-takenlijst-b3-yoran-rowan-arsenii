<!doctype html>
<html lang="nl">

<head>

    <?php require_once 'components/head.php'; ?>
</head>

<body>
    <?php require_once 'components/header.php'; ?>
    <div class="container" id="createTask">
        
        <div class="inlogPage">


            <form action="backend/Controllers/loginController.php" method="POST">

                <div class="form-group">
                    <label for="username">Gebruikersnaam:</label>
                    <div>
                        <input type="text" name="username" id="username" class="form-input">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Wachtwoord:</label>
                    <div>
                        <input type="password" name="password" id="password" class="form-input">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Login" class="form-input">
                </div>
            </form>
            <?php
            if (isset($_GET['msg'])) {
                echo "<div class='msg' id='msg'>" . htmlspecialchars($_GET['msg']) . "</div>";
            }
            ?>

        </div>
    </div>
</body>

</html>

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