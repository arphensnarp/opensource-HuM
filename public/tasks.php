<?php
require_once __DIR__ . '/../app/layout.php';

$pageTitle = 'Tasks - Student Task Manager';

// test data
$tasks = [
    [
        'task_id' => 1,
        'student_id' => 'S001',
        'student_name' => 'Student One',
        'task_name' => 'Database design draft',
        'task_description' => 'Prepare the first draft of the ERD and relational model.',
        'category' => 'Project',
        'status' => 'In Progress',
    ],
    [
        'task_id' => 2,
        'student_id' => 'S002',
        'student_name' => 'Student Two',
        'task_name' => 'Installation guide',
        'task_description' => 'Write setup instructions for DietPi, Lighttpd, PHP, and MariaDB.',
        'category' => 'Report',
        'status' => 'Not Started',
    ],
];

render_header($pageTitle, 'tasks');
?>

<section class="card">
    <h2>Current Tasks</h2>

    <p>
        This page displays student study tasks. The current data is temporary and
        will later be loaded from the MariaDB database.
    </p>

    <p>
        <a class="button-link" href="task_create.php">Add New Task</a>
    </p>

    <?php if (empty($tasks)): ?>
        <p class="notice">No tasks found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Task Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= e($task['student_id']) ?></td>
                        <td><?= e($task['student_name']) ?></td>
                        <td><?= e($task['task_name']) ?></td>
                        <td><?= e($task['task_description']) ?></td>
                        <td><?= e($task['category']) ?></td>
                        <td><?= e($task['status']) ?></td>
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
