
<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once '../components/head.php'; ?>
</head>

<body>
    <?php require_once '../components/header.php'; ?>
    <div class="container">
        <h1>Nieuwe melding</h1>

        <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST">
            <input type="hidden" name="action" value="create">
            
        </form>
    </div>
</body>