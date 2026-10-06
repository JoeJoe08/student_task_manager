<?php
require_once "db.php";
require_once "functions.php";

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id) {
    setFlash("error", "Invalid task ID.");
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
$stmt->execute([$id]);

if ($stmt->rowCount() > 0) {
    setFlash("success", "Task deleted successfully.");
} else {
    setFlash("error", "Task was not found.");
}

header("Location: index.php");
exit;
?>
