<?php

/**
 * Escape output before displaying it in HTML.
 */
function e($value)
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/**
 * Check whether the current request is a POST request.
 */
function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

/**
 * Redirect to another page and stop script execution.
 */
function redirect_to($path)
{
    header('Location: ' . $path);
    exit;
}

/**
 * Return the active class for navigation links.
 */
function active_nav($currentPage, $pageName)
{
    return $currentPage === $pageName ? 'active' : '';
}

/**
 * Read an integer ID from $_GET.
 */
function get_int_param($name)
{
    if (!isset($_GET[$name])) {
        return null;
    }

    $value = filter_input(INPUT_GET, $name, FILTER_VALIDATE_INT);

    return $value === false ? null : $value;
}

/**
 * Fetch all students.
 */
function get_all_students($pdo)
{
    $sql = "
        SELECT student_id, student_name
        FROM students
        ORDER BY student_id
    ";

    $statement = $pdo->query($sql);
    return $statement->fetchAll();
}

/**
 * Fetch all categories.
 */
function get_all_categories($pdo)
{
    $sql = "
        SELECT category_id, category_name
        FROM categories
        ORDER BY category_id
    ";

    $statement = $pdo->query($sql);
    return $statement->fetchAll();
}

/**
 * Fetch all statuses.
 */
function get_all_statuses($pdo)
{
    $sql = "
        SELECT status_id, status_name
        FROM statuses
        ORDER BY status_id
    ";

    $statement = $pdo->query($sql);
    return $statement->fetchAll();
}

/**
 * Fetch all tasks with related student, category, and status names.
 */
function get_all_tasks($pdo)
{
    $sql = "
        SELECT
            tasks.task_id,
            tasks.student_id,
            students.student_name,
            tasks.task_name,
            tasks.task_description,
            categories.category_name,
            statuses.status_name,
            tasks.created_at,
            tasks.updated_at
        FROM tasks
        JOIN students
            ON tasks.student_id = students.student_id
        JOIN categories
            ON tasks.category_id = categories.category_id
        JOIN statuses
            ON tasks.status_id = statuses.status_id
        ORDER BY tasks.task_id DESC
    ";

    $statement = $pdo->query($sql);
    return $statement->fetchAll();
}

/**
 * Fetch one task by ID.
 */
function get_task_by_id($pdo, $taskId)
{
    $sql = "
        SELECT
            task_id,
            student_id,
            category_id,
            status_id,
            task_name,
            task_description
        FROM tasks
        WHERE task_id = :task_id
    ";

    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':task_id' => $taskId,
    ]);

    return $statement->fetch();
}

/**
 * Fetch one task with readable related names.
 */
function get_task_details_by_id($pdo, $taskId)
{
    $sql = "
        SELECT
            tasks.task_id,
            tasks.student_id,
            students.student_name,
            tasks.task_name,
            tasks.task_description,
            categories.category_name,
            statuses.status_name
        FROM tasks
        JOIN students
            ON tasks.student_id = students.student_id
        JOIN categories
            ON tasks.category_id = categories.category_id
        JOIN statuses
            ON tasks.status_id = statuses.status_id
        WHERE tasks.task_id = :task_id
    ";

    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':task_id' => $taskId,
    ]);

    return $statement->fetch();
}

/**
 * Validate task form input.
 */
function validate_task_input($data)
{
    $errors = [];

    if (empty($data['student_id'])) {
        $errors[] = 'Student is required.';
    }

    if (empty($data['category_id'])) {
        $errors[] = 'Category is required.';
    }

    if (empty($data['status_id'])) {
        $errors[] = 'Status is required.';
    }

    if (trim($data['task_name']) === '') {
        $errors[] = 'Task name is required.';
    } elseif (strlen(trim($data['task_name'])) > 150) {
        $errors[] = 'Task name must be 150 characters or fewer.';
    }

    return $errors;
}

/**
 * Insert a new task.
 */
function create_task($pdo, $data)
{
    $sql = "
        INSERT INTO tasks (
            student_id,
            category_id,
            status_id,
            task_name,
            task_description
        ) VALUES (
            :student_id,
            :category_id,
            :status_id,
            :task_name,
            :task_description
        )
    ";

    $statement = $pdo->prepare($sql);

    return $statement->execute([
        ':student_id' => $data['student_id'],
        ':category_id' => $data['category_id'],
        ':status_id' => $data['status_id'],
        ':task_name' => trim($data['task_name']),
        ':task_description' => trim($data['task_description']),
    ]);
}

/**
 * Update an existing task.
 */
function update_task($pdo, $taskId, $data)
{
    $sql = "
        UPDATE tasks
        SET
            student_id = :student_id,
            category_id = :category_id,
            status_id = :status_id,
            task_name = :task_name,
            task_description = :task_description
        WHERE task_id = :task_id
    ";

    $statement = $pdo->prepare($sql);

    return $statement->execute([
        ':student_id' => $data['student_id'],
        ':category_id' => $data['category_id'],
        ':status_id' => $data['status_id'],
        ':task_name' => trim($data['task_name']),
        ':task_description' => trim($data['task_description']),
        ':task_id' => $taskId,
    ]);
}

/**
 * Delete a task.
 */
function delete_task($pdo, $taskId)
{
    $sql = "
        DELETE FROM tasks
        WHERE task_id = :task_id
    ";

    $statement = $pdo->prepare($sql);

    return $statement->execute([
        ':task_id' => $taskId,
    ]);
}
