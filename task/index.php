<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php?msg=Je moet eerst inloggen!");
    exit;
}

require_once '../backend/conn.php';


// Filters ophalen uit de URL (GET parameters)
$afdelingFilter = isset($_GET['afdeling']) ? $_GET['afdeling'] : '';
$userFilter = isset($_GET['user']) ? $_GET['user'] : '';

// Query en voorwaarden voorbereiden
$query = "SELECT * FROM taken";
$conditions = [];
$params = [];

//Filter op afdeling
if (!empty($afdelingFilter) && $afdelingFilter !== 'Alle') {
    $conditions[] = "afdeling = :afdeling";
    $params[':afdeling'] = $afdelingFilter;
}

//Filter op gebruiker (wie heeft de taak gemaakt of voor wie is de taak bedoeld?
if (!empty($userFilter) && $userFilter == "byMe") {
    $conditions[] = "user = :user";
    $params[':user'] = $_SESSION['user_id'];
}

if (!empty($userFilter) && $userFilter == "forMe") {
    $conditions[] = "forID = :user";
    $params[':user'] = $_SESSION['user_id'];
}

//Voeg WHERE-voorwaarden toe aan de query
if (!empty($conditions)) {
    $query .= " WHERE " . implode(" AND ", $conditions);
}

//Sorteer de resultaten
$query .= " ORDER BY deadline ASC";

//Voer de query veilig uit 
$statement = $conn->prepare($query);

foreach ($params as $key => $value) {
    $statement->bindValue($key, $value);
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
                        <option value="byMe" <?php echo ($userFilter == 'byMe') ? 'selected' : ''; ?>>Zelf gemaakt
                        </option>
                        <option value="forMe" <?php echo ($userFilter == 'forMe') ? 'selected' : ''; ?>>Taken voor mij
                        </option>
                        <option value="Personeel" <?php echo ($afdelingFilter == 'Personeel') ? 'selected' : ''; ?>>
                            Personeel
                        </option>
                        <option value="Horeca" <?php echo ($afdelingFilter == 'Horeca') ? 'selected' : ''; ?>>Horeca
                        </option>
                        <option value="Techniek" <?php echo ($afdelingFilter == 'Techniek') ? 'selected' : ''; ?>>Techniek
                        </option>
                        <option value="Inkoop" <?php echo ($afdelingFilter == 'Inkoop') ? 'selected' : ''; ?>>Inkoop
                        </option>
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
                <div class="scrol">
                    <?php foreach ($tasks as $task): ?>

                        <?php if ($task['status'] === 'Todo'): ?>
                            <div class="task">

                                <div class="task-top"
                                    style=" border-bottom: <?php echo $task['category']; ?> solid  4px !important;">
                                    <h1><?php echo $task['titel']; ?></h1>
                                    <a href="edit.php?id=<?php echo $task['id']; ?>"><i class="fa-solid fa-gear fa-lg"></i></a>
                                </div>

                                <p>Afdeling: <?php echo $task['afdeling']; ?></p>
                                <p>Beschrijving: <?php echo $task['beschrijving']; ?></p>
                                <p>Deadline: <?php echo $task['deadline']; ?></p>
                                <div class="task-bottom">
                                    <p>Mark done:</p>

                                    <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php"
                                        method="POST">
                                        <input type="hidden" name="action" value="update_status">
                                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                        <input type="hidden" name="status" value="Done">

                                        <button type="submit" class="iconButton">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </button>
                                    </form>
                                </div>

                                </form>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="task-block" id="Doing">
                <h2>Doing</h2>
                <div class="scrol">
                    <?php foreach ($tasks as $task): ?>
                        <?php if ($task['status'] === 'Doing'): ?>
                            <div class="task">
                                <div class="task-top"
                                    style=" border-bottom: <?php echo $task['category']; ?> solid  4px !important;">
                                    <h1><?php echo $task['titel']; ?></h1>
                                    <a href="edit.php?id=<?php echo $task['id']; ?>"><i class="fa-solid fa-gear fa-lg"></i></a>
                                </div>

                                <p>Afdeling: <?php echo $task['afdeling']; ?></p>
                                <p>Beschrijving: <?php echo $task['beschrijving']; ?></p>
                                <p>Deadline: <?php echo $task['deadline']; ?></p>

                                <div class="task-bottom">
                                    <p>Mark done:</p>

                                    <form action="<?php echo $base_url; ?>/backend/controllers/taskController.php"
                                        method="POST">
                                        <input type="hidden" name="action" value="update_status">
                                        <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                        <input type="hidden" name="status" value="Done">

                                        <button type="submit" class="iconButton">
                                            <i class="fa-solid fa-circle-check"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="task-block" id="Done">
                <h2>Done</h2>
                <div class="scrol">
                    <?php foreach ($tasks as $task): ?>
                        <?php if ($task['status'] === 'Done'): ?>
                            <div class="task">
                                <div class="task-top"
                                    style=" border-bottom: <?php echo $task['category']; ?> solid  4px !important;">
                                    <h1><?php echo $task['titel']; ?></h1>
                                    <a href="edit.php?id=<?php echo $task['id']; ?>"><i class="fa-solid fa-gear fa-lg"></i></a>
                                </div>

                                <p>Afdeling: <?php echo $task['afdeling']; ?></p>
                                <p>Beschrijving: <?php echo $task['beschrijving']; ?></p>
                                <p>Deadline: <?php echo $task['deadline']; ?></p>


                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
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

    document.getElementById("afdeling").addEventListener("change", function () {
        let selectedValue = this.value;
        let url = new URL(window.location);

        if (selectedValue === "byMe") {
            url.searchParams.set('user', 'byMe');
            url.searchParams.delete('afdeling');
        } else if (selectedValue === "forMe") {
            url.searchParams.set('user', 'forMe');
            url.searchParams.delete('afdeling');
        } else {
            url.searchParams.set('afdeling', selectedValue);
            url.searchParams.delete('user');
        }

        window.location.href = url;
    });
</script>