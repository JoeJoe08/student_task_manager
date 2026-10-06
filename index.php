<?php
require_once "db.php";
require_once "functions.php";

$status = $_GET["status"] ?? "all";
$priority = $_GET["priority"] ?? "all";
$search = trim($_GET["search"] ?? "");

$sql = "SELECT * FROM tasks WHERE 1=1";
$params = [];

if ($status === "incomplete") {
    $sql .= " AND completed = 0";
} elseif ($status === "completed") {
    $sql .= " AND completed = 1";
}

if (in_array($priority, getPriorities(), true)) {
    $sql .= " AND priority = ?";
    $params[] = $priority;
}

if ($search !== "") {
    $sql .= " AND title LIKE ?";
    $params[] = "%" . $search . "%";
}

$sql .= " ORDER BY due_date ASC, id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$tasks = $stmt->fetchAll();

$countStmt = $pdo->query(
    "SELECT
        COUNT(*) AS total,
        SUM(CASE WHEN completed = 1 THEN 1 ELSE 0 END) AS completed_count,
        SUM(CASE WHEN completed = 0 THEN 1 ELSE 0 END) AS incomplete_count
     FROM tasks"
);
$counts = $countStmt->fetch();

require "header.php";
?>

<div class="page-title">
    <div>
        <h2>Academic Tasks</h2>
        <p>Manage assignments, exams, projects, and other academic work.</p>
    </div>
    <a class="button" href="create.php">+ Add Task</a>
</div>

<div class="stats">
    <div class="stat"><strong><?= (int)$counts["total"] ?></strong><span>Total</span></div>
    <div class="stat"><strong><?= (int)$counts["incomplete_count"] ?></strong><span>Incomplete</span></div>
    <div class="stat"><strong><?= (int)$counts["completed_count"] ?></strong><span>Completed</span></div>
</div>

<div class="card">
    <h3>Filter and Search</h3>
    <form method="get" class="filter-form">
        <input type="text" name="search" placeholder="Search title" value="<?= e($search) ?>">

        <select name="status">
            <option value="all" <?= $status === "all" ? "selected" : "" ?>>All tasks</option>
            <option value="incomplete" <?= $status === "incomplete" ? "selected" : "" ?>>Incomplete only</option>
            <option value="completed" <?= $status === "completed" ? "selected" : "" ?>>Completed only</option>
        </select>

        <select name="priority">
            <option value="all">All priorities</option>
            <?php foreach (getPriorities() as $p): ?>
                <option value="<?= e($p) ?>" <?= $priority === $p ? "selected" : "" ?>>
                    <?= e($p) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Filter</button>
        <a class="button secondary" href="index.php">Reset</a>
    </form>
</div>

<?php if (!$tasks): ?>
    <div class="empty">No tasks found.</div>
<?php else: ?>
    <div class="task-list">
        <?php foreach ($tasks as $task): ?>
            <?php
            $overdue = !$task["completed"] && $task["due_date"] < date("Y-m-d");
            ?>
            <article class="task-card <?= $overdue ? "overdue" : "" ?> <?= $task["completed"] ? "done" : "" ?>">
                <div class="task-main">
                    <div class="task-top">
                        <h3><?= e($task["title"]) ?></h3>
                        <span class="badge <?= strtolower(e($task["priority"])) ?>">
                            <?= e($task["priority"]) ?>
                        </span>
                    </div>

                    <p><?= nl2br(e($task["description"])) ?></p>

                    <div class="task-info">
                        <span>Category: <?= e($task["category"]) ?></span>
                        <span>Due: <?= e($task["due_date"]) ?></span>
                        <span>Status: <?= $task["completed"] ? "Completed" : "Incomplete" ?></span>
                        <?php if ($overdue): ?>
                            <strong class="overdue-text">Overdue</strong>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="actions">
                    <a class="button small" href="edit.php?id=<?= (int)$task["id"] ?>">Edit</a>
                    <a class="button small danger"
                       href="delete.php?id=<?= (int)$task["id"] ?>"
                       onclick="return confirm('Delete this task?');">Delete</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require "footer.php"; ?>
