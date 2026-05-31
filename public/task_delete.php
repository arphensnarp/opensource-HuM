<?php
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/layout.php';

$pageTitle = 'Delete Task - Student Task Manager';

$pdo = get_db_connection();

$taskId = get_int_param('id');

if ($taskId === null) {
    render_header($pageTitle, 'tasks');
    ?>
    <section class="card">
        <h2>Delete Task</h2>
        <p class="notice">Invalid or missing task ID.</p>
        <p><a href="tasks.php">Back to Tasks</a></p>
    </section>
    <?php
    render_footer();
    exit;
}

$task = get_task_details_by_id($pdo, $taskId);

if (!$task) {
    render_header($pageTitle, 'tasks');
    ?>
    <section class="card">
        <h2>Delete Task</h2>
        <p class="notice">Task not found.</p>
        <p><a href="tasks.php">Back to Tasks</a></p>
    </section>
    <?php
    render_footer();
    exit;
}

if (is_post_request()) {
    delete_task($pdo, $taskId);
    redirect_to('tasks.php?deleted=1');
}

render_header($pageTitle, 'tasks');
?>

<section class="card">
    <h2>Delete Task</h2>

    <p class="notice">
        Are you sure you want to delete this task? This action cannot be undone.
    </p>

    <table>
        <tr>
            <th>Task ID</th>
            <td><?= e($task['task_id']) ?></td>
        </tr>
        <tr>
            <th>Student</th>
            <td><?= e($task['student_id'] . ' - ' . $task['student_name']) ?></td>
        </tr>
        <tr>
            <th>Task Name</th>
            <td><?= e($task['task_name']) ?></td>
        </tr>
        <tr>
            <th>Description</th>
            <td><?= e($task['task_description']) ?></td>
        </tr>
        <tr>
            <th>Category</th>
            <td><?= e($task['category_name']) ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?= e($task['status_name']) ?></td>
        </tr>
    </table>

    <form method="post" action="task_delete.php?id=<?= e($taskId) ?>" class="delete-form">
        <button type="submit">Confirm Delete</button>
        <a href="tasks.php">Cancel</a>
    </form>
</section>

<?php
render_footer();
