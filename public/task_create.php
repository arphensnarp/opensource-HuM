<?php
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/layout.php';

$pageTitle = 'Add Task - Student Task Manager';

$pdo = get_db_connection();

$students = get_all_students($pdo);
$categories = get_all_categories($pdo);
$statuses = get_all_statuses($pdo);

$errors = [];

$formData = [
    'student_id' => '',
    'category_id' => '',
    'status_id' => '',
    'task_name' => '',
    'task_description' => '',
];

if (is_post_request()) {
    $formData = [
        'student_id' => $_POST['student_id'] ?? '',
        'category_id' => $_POST['category_id'] ?? '',
        'status_id' => $_POST['status_id'] ?? '',
        'task_name' => $_POST['task_name'] ?? '',
        'task_description' => $_POST['task_description'] ?? '',
    ];

    $errors = validate_task_input($formData);

    if (empty($errors)) {
        create_task($pdo, $formData);
        redirect_to('tasks.php?created=1');
    }
}

render_header($pageTitle, 'create');
?>

<section class="card">
    <h2>Add New Task</h2>

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

    <form method="post" action="task_create.php">
        <div class="form-group">
            <label for="student_id">Student</label>
            <select id="student_id" name="student_id" required>
                <option value="">-- Select student --</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?= e($student['student_id']) ?>"
                        <?= $formData['student_id'] === $student['student_id'] ? 'selected' : '' ?>>
                        <?= e($student['student_id'] . ' - ' . $student['student_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
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
            <button type="submit">Create Task</button>
            <a href="tasks.php">Cancel</a>
        </div>
    </form>
</section>

<?php
render_footer();
