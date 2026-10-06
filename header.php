<?php
require_once "functions.php";
$flash = getFlash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
    <div class="container header-row">
        <h1>Student Task Manager</h1>
    </div>
</header>

<main class="container">
<?php if ($flash): ?>
    <div class="flash <?= e($flash["type"]) ?>">
        <?= e($flash["message"]) ?>
    </div>
<?php endif; ?>
