<?php
require_once __DIR__ . '/../app/layout.php';

$pageTitle = 'Delete Task - Student Task Manager';

$taskId = $_GET['id'] ?? '';

render_header($pageTitle, 'tasks');
?>

<section class="card">
    <h2>Delete Task</h2>

    <?php if ($taskId !== ''): ?>
        <p>Selected task ID: <?= e($taskId) ?></p>
    <?php else: ?>
        <p>No task ID was provided.</p>
    <?php endif; ?>

    <p>
        <a href="tasks.php">Back to Tasks</a>
    </p>
</section>

<?php
render_footer();
