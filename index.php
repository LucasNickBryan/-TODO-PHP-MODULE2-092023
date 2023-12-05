<?php
require_once 'Task.php';

$taskObj = new Task();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task'])) {
    $task = $_POST['task'];
    $taskObj->addTask($task);
    header("Location: index.php");
}

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_GET['action'] == 'complete') {
        $taskObj->markTaskAsCompleted($id);
    } elseif ($_GET['action'] == 'delete') {
        $taskObj->deleteTask($id);
    }
    header("Location: index.php");
}

$tasks = $taskObj->getAllTasks();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ma To-Do List</title>
</head>
<body>
    <h1>Ma To-Do List</h1>
    <form action="index.php" method="post">
        <input type="text" name="task" placeholder="Ajouter une tâche">
        <button type="submit">Ajouter</button>
    </form>

    <h2>Tâches à faire :</h2>
    <ul>
        <?php foreach ($tasks as $task) : ?>
            <?php if ($task['completed'] == 0) : ?>
                <li><?= $task['task'] ?>
                    <a href="index.php?action=complete&id=<?= $task['id'] ?>">Terminé</a>
                    <a href="index.php?action=delete&id=<?= $task['id'] ?>">Supprimer</a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

    <h2>Tâches accomplies :</h2>
    <ul>
        <?php foreach ($tasks as $task) : ?>
            <?php if ($task['completed'] == 1) : ?>
                <li><?= $task['task'] ?>
                    <a href="index.php?action=delete&id=<?= $task['id'] ?>">Supprimer</a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
</body>
</html>
