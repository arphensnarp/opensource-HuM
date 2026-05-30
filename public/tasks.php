<?php
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/layout.php';

$pageTitle = 'Tasks - Student Task Manager';

$pdo = get_db_connection();
$tasks = get_all_tasks($pdo);

$message = '';

if (isset($_GET['created'])) {
    $message = 'Task created successfully.';
} elseif (isset($_GET['updated'])) {
    $message = 'Task updated successfully.';
} elseif (isset($_GET['deleted'])) {
    $message = 'Task deleted successfully.';
}

render_header($pageTitle, 'tasks');
?>

<section class="card">
    <h2>Current Tasks</h2>

    <p>
        This page displays task records stored in the MariaDB database.
    </p>

    <?php if ($message !== ''): ?>
        <p class="success"><?= e($message) ?></p>
    <?php endif; ?>

    <p>
        <a class="button-link" href="task_create.php">Add New Task</a>
    </p>

    <?php if (empty($tasks)): ?>
        <p class="notice">No tasks found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Task Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= e($task['task_id']) ?></td>
                        <td><?= e($task['student_id']) ?></td>
                        <td><?= e($task['student_name']) ?></td>
                        <td><?= e($task['task_name']) ?></td>
                        <td><?= e($task['task_description']) ?></td>
                        <td><?= e($task['category_name']) ?></td>
                        <td><?= e($task['status_name']) ?></td>
                        <td><?= e($task['created_at']) ?></td>
                        <td class="actions">
                            <a href="task_edit.php?id=<?= e($task['task_id']) ?>">Edit</a>
                            <a href="task_delete.php?id=<?= e($task['task_id']) ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<?php
render_footer();
