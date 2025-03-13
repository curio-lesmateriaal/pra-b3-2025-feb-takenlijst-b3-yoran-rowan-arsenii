<!doctype html>
<html lang="nl">

<head>
    <title></title>
    <?php require_once '../components/head.php'; ?>
</head>

<body>
    <?php require_once '../components/header.php'; ?>

    <?php 
         require_once '../backend/conn.php';
         $query = "SELECT * FROM taken";
         $statement = $conn->prepare($query);
         $statement->execute();
         $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <a href="create.php" id="create">Taak aanmaken</a>

        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <div class="task-menu">
            <div class="task-block" id="Todo">
                <h2>Todo</h2>
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['status'] === 'Todo'): ?>
                        <div class="task">
                            <p><?php echo $task['titel']; ?></p>
                            <p><?php echo $task['user']; ?></p>
                            <p><?php echo $task['afdeling']; ?></p>
                            <p><?php echo $task['beschrijving']; ?></p>
                            <p><?php echo $task['deadline']; ?></p>
                            <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST" onsubmit="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                <a href="edit.php?id=<?php echo $user['id']; ?>">aanpassen</a>
                                <input type="submit" value="Verwijderen" class="delete-button">
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
                            <p><?php echo $task['titel']; ?></p>
                            <p><?php echo $task['user']; ?></p>
                            <p><?php echo $task['afdeling']; ?></p>
                            <p><?php echo $task['beschrijving']; ?></p>
                            <p><?php echo $task['deadline']; ?></p>
                            <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST" onsubmit="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                <a href="edit.php?id=<?php echo $task['id']; ?>">aanpassen</a>
                                <input type="submit" value="Verwijderen" class="delete-button">
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="task-block" id="Done">
                <h2>Done</h2>
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['status'] === 'done'): ?>
                        <div class="task">
                            <p><?php echo $task['titel']; ?></p>
                            <p><?php echo $task['user']; ?></p>
                            <p><?php echo $task['afdeling']; ?></p>
                            <p><?php echo $task['beschrijving']; ?></p>
                            <p><?php echo $task['deadline']; ?></p>
                            <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST" onsubmit="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                <a href="edit.php?id=<?php echo $user['id']; ?>">aanpassen</a>
                                <input type="submit" value="Verwijderen" class="delete-button">
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