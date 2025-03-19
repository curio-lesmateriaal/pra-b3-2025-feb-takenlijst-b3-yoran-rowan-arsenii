<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once 'components/head.php'; ?>
</head>

<body>
    <?php require_once 'components/header.php'; ?>
    <div class="container" id="createTask">
        <h1>Register</h1>
        <?php if (isset($_GET['msg'])) {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>
        <form action="<?php echo $base_url; ?>/backend/controllers/loginController.php" method="POST" class="loginForm">
            <input type="hidden" name="action" value="create">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
                <label for="name">Naam:</label>
                <input type="text" name="name">
            </div>

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password">
            </div>
            <div class="form-group">
                <label for="passwordConfirm">Password Confirm:</label>
                <input type="password" name="passwordConfirm">
            </div>
            <div>
                <input type="submit" value="Create" class="buttonOP">
            </div>
            
        </form>
    </div>
</body>