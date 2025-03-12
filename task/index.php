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
        <form action="../backend/Controllers/taskController.php" method="POST" onsubmit="return confirm('Weet je zeker dat je deze melding wilt verwijderen?');">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Verwijderen">
        </form>
        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <div class="task-menu">
            <div class="task-block" id="todo">
                <h2>Todo</h2>
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['status'] === 'todo'): ?>
                        <div class="task">
                            <p><?php echo $task['titel']; ?></p>
                            <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST" onsubmit="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                <input type="submit" value="Verwijderen" class="delete-button">
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="task-block" id="doing">
                <h2>Doing</h2>
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['status'] === 'doing'): ?>
                        <div class="task">
                            <p><?php echo $task['titel']; ?></p>
                            <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST" onsubmit="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                <input type="submit" value="Verwijderen" class="delete-button">
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="task-block" id="done">
                <h2>Done</h2>
                <?php foreach ($tasks as $task): ?>
                    <?php if ($task['status'] === 'done'): ?>
                        <div class="task">
                            <p><?php echo $task['titel']; ?></p>
                            <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php" method="POST" onsubmit="return confirm('Weet je zeker dat je deze taak wilt verwijderen?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                <input type="submit" value="Verwijderen" class="delete-button">
                            </form>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</body>

</html>