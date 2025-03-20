<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php?msg=Je moet eerst inloggen!");
    exit;
}

require_once '../backend/conn.php';

$afdelingFilter = isset($_GET['afdeling']) ? $_GET['afdeling'] : '';
$userFilter = $_SESSION['user_id'];


$query = "SELECT * FROM taken";
if ($afdelingFilter && $afdelingFilter !== 'Alle') {
    $query .= " WHERE afdeling = :afdeling";
}


$query .= " ORDER BY deadline DESC";

$statement = $conn->prepare($query);
if ($afdelingFilter && $afdelingFilter !== 'Alle') {
    $statement->bindParam(':afdeling', $afdelingFilter);
}
$statement->execute();
$tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once '../components/head.php'; ?>
</head>

<body>
    <?php require_once '../components/header.php'; ?>

    <div class="container">
        <div class="barIndex">
            <div class="home">
                <form method="GET" action="">
                    <select name="afdeling" id="afdeling" class="home" onchange="this.form.submit()">
                        <option value="Alle" <?php echo ($afdelingFilter == 'Alle' || $afdelingFilter == '') ? 'selected' : ''; ?>>Alle afdelingen</option>
                        <option value="Personeel" <?php echo ($afdelingFilter == 'Personeel') ? 'selected' : ''; ?>>Personeel</option>
                        <option value="Horeca" <?php echo ($afdelingFilter == 'Horeca') ? 'selected' : ''; ?>>Horeca</option>
                        <option value="Techniek" <?php echo ($afdelingFilter == 'Techniek') ? 'selected' : ''; ?>>Techniek</option>
                        <option value="Inkoop" <?php echo ($afdelingFilter == 'Inkoop') ? 'selected' : ''; ?>>Inkoop</option>
                        <option value="Klantenservice" <?php echo ($afdelingFilter == 'Klantenservice') ? 'selected' : ''; ?>>Klantenservice</option>
                        <option value="Groen" <?php echo ($afdelingFilter == 'Groen') ? 'selected' : ''; ?>>Groen</option>
                    </select>
                </form>
            </div>
            <div class="task-create">
                <a href="create.php"><i class="fa-solid fa-plus"></i> Taak aanmaken</a>
            </div>
        </div>
        
        <div class="msg-block">
            <?php
            if (isset($_GET['msg'])) {
                echo "<div class='msg' id='msg'>" . htmlspecialchars($_GET['msg']) . "</div>";
            }
            ?>
        </div>


        <div class="task-menu">
            <div class="task-block" id="Todo">
                <h2>Todo</h2>

                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['status'] === 'Todo'): ?>
                        <div class="task">
                            <div class="task-top">
                                <h1><?php echo $task['titel']; ?></h1>
                                <a href="edit.php?id=<?php echo $task['id']; ?>"><i class="fa-solid fa-gear fa-lg"></i></a>
                            </div>

                            <p>Afdeling: <?php echo $task['afdeling']; ?></p>
                            <p>Beschrijving: <?php echo $task['beschrijving']; ?></p>
                            <p>deadline: <?php echo $task['deadline']; ?></p>

                            <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST"
                                onsubmit="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="task-block" id="Doing">
                <h2>Doing</h2>
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['status'] === 'Doing'): ?>
                        <div class="task">
                            <div class="task-top">
                                <h1><?php echo $task['titel']; ?></h1>
                                <a href="edit.php?id=<?php echo $task['id']; ?>"><i class="fa-solid fa-gear fa-lg"></i></a>
                            </div>

                            <p>afdeling: <?php echo $task['afdeling']; ?></p>
                            <p>beschrijving: <?php echo $task['beschrijving']; ?></p>
                            <p>deadline: <?php echo $task['deadline']; ?></p>

                            <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST"
                                onsubmit="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="task-block" id="Done">
                <h2>Done</h2>
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['status'] === 'Done'): ?>
                        <div class="task">
                            <div class="task-top">
                                <h1><?php echo $task['titel']; ?></h1>
                                <a href="edit.php?id=<?php echo $task['id']; ?>"><i class="fa-solid fa-gear fa-lg"></i></a>
                            </div>

                            <p>Afdeling: <?php echo $task['afdeling']; ?></p>
                            <p>Beschrijving: <?php echo $task['beschrijving']; ?></p>
                            <p>deadline: <?php echo $task['deadline']; ?></p>

                            <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST"
                                onsubmit="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="footer">

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