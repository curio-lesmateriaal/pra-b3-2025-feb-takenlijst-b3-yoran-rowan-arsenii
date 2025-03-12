
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
        <div class="knop-aanmaken">
            <a href="create.php" id="create" class="aanmaken-tekst">Taak aanmaken</a>
        </div>
        
        <?php if(isset($_GET['msg']))
        {
            echo "<div class='msg'>" . $_GET['msg'] . "</div>";
        } ?>

        <div class="task-menu">
            <div class="task-block" id="todo">
                <h2>Todo</h2>
                <div class="task">

                </div>
            </div>
            <div class="task-block" id="doing">
                <h2>Doing</h2>
                <div class="task">

                </div>
            </div>
            <div class="task-block" id="done">
                <h2>Done</h2>
            </div>
        </div>
    </div>

</body>

</html>
