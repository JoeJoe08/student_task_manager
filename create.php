<?php
require_once "db.php";
require_once "functions.php";

$errors = [];
$title = "";
$description = "";
$category = "Assignment";
$priority = "Medium";
$due_date = "";
$completed = 0;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");
    $category = $_POST["category"] ?? "";
    $priority = $_POST["priority"] ?? "";
    $due_date = $_POST["due_date"] ?? "";
    $completed = isset($_POST["completed"]) ? 1 : 0;

    if ($title === "") {
        $errors[] = "Title is required.";
    } elseif (strlen($title) > 150) {
        $errors[] = "Title must be 150 characters or less.";
    }

    if ($description === "") {
        $errors[] = "Description is required.";
    }

    if (!in_array($category, getCategories(), true)) {
        $errors[] = "Please select a valid category.";
    }

    if (!in_array($priority, getPriorities(), true)) {
        $errors[] = "Please select a valid priority.";
    }

    if (!validDate($due_date)) {
        $errors[] = "Please enter a valid due date.";
    }

    if (!$errors) {
        $stmt = $pdo->prepare(
            "INSERT INTO tasks (title, description, category, priority, due_date, completed)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $title, $description, $category, $priority, $due_date, $completed
        ]);

        setFlash("success", "Task created successfully.");
        header("Location: index.php");
        exit;
    }
}

require "header.php";
?>

<div class="form-card">
    <h2>Add New Task</h2>

    <?php if ($errors): ?>
        <div class="error-box">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" maxlength="150"
               value="<?= e($title) ?>" required>

        <label for="description">Description</label>
        <textarea id="description" name="description" rows="5" required><?= e($description) ?></textarea>

        <label for="category">Category</label>
        <select id="category" name="category" required>
            <?php foreach (getCategories() as $item): ?>
                <option value="<?= e($item) ?>" <?= $category === $item ? "selected" : "" ?>>
                    <?= e($item) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="priority">Priority</label>
        <select id="priority" name="priority" required>
            <?php foreach (getPriorities() as $item): ?>
                <option value="<?= e($item) ?>" <?= $priority === $item ? "selected" : "" ?>>
                    <?= e($item) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="due_date">Due Date</label>
        <input id="due_date" type="date" name="due_date"
               value="<?= e($due_date) ?>" required>

        <label class="checkbox">
            <input type="checkbox" name="completed" value="1" <?= $completed ? "checked" : "" ?>>
            Mark as completed
        </label>

        <div class="form-actions">
            <button type="submit">Save Task</button>
            <a class="button secondary" href="index.php">Cancel</a>
        </div>
    </form>
</div>

<?php require "footer.php"; ?>
