<?php
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/layout.php';

$pageTitle = 'Edit Task - Student Task Manager';

$pdo = get_db_connection();

$taskId = get_int_param('id');

if ($taskId === null) {
    render_header($pageTitle, 'tasks');
    ?>
    <section class="card">
        <h2>Edit Task</h2>
        <p class="notice">Invalid or missing task ID.</p>
        <p><a href="tasks.php">Back to Tasks</a></p>
    </section>
    <?php
    render_footer();
    exit;
}

$task = get_task_by_id($pdo, $taskId);

if (!$task) {
    render_header($pageTitle, 'tasks');
    ?>
    <section class="card">
        <h2>Edit Task</h2>
        <p class="notice">Task not found.</p>
        <p><a href="tasks.php">Back to Tasks</a></p>
    </section>
    <?php
    render_footer();
    exit;
}

$categories = get_all_categories($pdo);
$statuses = get_all_statuses($pdo);

$errors = [];

$formData = [
    'student_id' => $task['student_id'],
    'student_name' => $task['student_name'],
    'category_id' => $task['category_id'],
    'status_id' => $task['status_id'],
    'task_name' => $task['task_name'],
    'task_description' => $task['task_description'],
];

if (is_post_request()) {
    $formData = [
        'student_id' => $_POST['student_id'] ?? '',
        'student_name' => $_POST['student_name'] ?? '',
        'category_id' => $_POST['category_id'] ?? '',
        'status_id' => $_POST['status_id'] ?? '',
        'task_name' => $_POST['task_name'] ?? '',
        'task_description' => $_POST['task_description'] ?? '',
    ];

    $errors = validate_task_input($formData);

    if (empty($errors)) {
        update_task($pdo, $taskId, $formData);
        redirect_to('tasks.php?updated=1');
    }
}

render_header($pageTitle, 'tasks');
?>

<section class="card">
    <h2>Edit Task</h2>

    <?php if (!empty($errors)): ?>
        <div class="error-box">
            <p>Please fix the following errors:</p>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= e($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="task_edit.php?id=<?= e($taskId) ?>">
        <div class="form-group">
            <label for="student_id">Student ID</label>
            <input
                type="text"
                id="student_id"
                name="student_id"
                maxlength="20"
                value="<?= e($formData['student_id']) ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="student_name">Student Name</label>
            <input
                type="text"
                id="student_name"
                name="student_name"
                maxlength="100"
                value="<?= e($formData['student_name']) ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id" required>
                <option value="">-- Select category --</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= e($category['category_id']) ?>"
                        <?= (string) $formData['category_id'] === (string) $category['category_id'] ? 'selected' : '' ?>>
                        <?= e($category['category_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="status_id">Status</label>
            <select id="status_id" name="status_id" required>
                <option value="">-- Select status --</option>
                <?php foreach ($statuses as $status): ?>
                    <option value="<?= e($status['status_id']) ?>"
                        <?= (string) $formData['status_id'] === (string) $status['status_id'] ? 'selected' : '' ?>>
                        <?= e($status['status_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="task_name">Task Name</label>
            <input
                type="text"
                id="task_name"
                name="task_name"
                maxlength="150"
                value="<?= e($formData['task_name']) ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="task_description">Task Description</label>
            <textarea
                id="task_description"
                name="task_description"
                rows="5"
            ><?= e($formData['task_description']) ?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit">Update Task</button>
            <a href="tasks.php">Cancel</a>
        </div>
    </form>
</section>

<?php
render_footer();
