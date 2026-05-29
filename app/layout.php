<?php
require_once __DIR__ . '/functions.php';

// Render the common page header and navigation
function render_header($pageTitle, $activePage = '')
{
    ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= e($pageTitle) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header class="site-header">
        <h1>Student Task Manager - Group HuM</h1>
        <p>A lightweight PHP and MariaDB web application for managing student study tasks.</p>
    </header>

    <nav class="site-nav">
        <a class="<?= e(active_nav($activePage, 'home')) ?>" href="index.php">Home</a>
        <a class="<?= e(active_nav($activePage, 'tasks')) ?>" href="tasks.php">Tasks</a>
        <a class="<?= e(active_nav($activePage, 'create')) ?>" href="task_create.php">Add Task</a>
        <a class="<?= e(active_nav($activePage, 'members')) ?>" href="members.php">Members</a>
    </nav>

    <main class="container">
    <?php
}

// Render the common page footer
function render_footer()
{
    ?>
    </main>

    <footer class="site-footer">
        <p>&copy; Group HuM - Student Task Manager</p>
    </footer>
</body>
</html>
    <?php
}
