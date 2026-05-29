<?php
require_once __DIR__ . '/../app/layout.php';

$pageTitle = 'Add Task - Student Task Manager';

render_header($pageTitle, 'create');
?>

<section class="card">
    <h2>Add New Task</h2>

    <p>
        <a href="tasks.php">Back to Tasks</a>
    </p>
</section>

<?php
render_footer();
