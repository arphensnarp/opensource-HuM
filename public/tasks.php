<?php
$pageTitle = "Tasks - Student Task Manager";

$tasks = [
    [
        "student_id" => "0",
        "student_name" => "stu0",
        "title" => "test0",
        "category" => "cat0",
        "status" => "In Progress"
    ],
    [
        "student_id" => "1",
        "student_name" => "stu1",
        "title" => "test1",
        "category" => "cat1",
        "status" => "Not Started"
    ]
];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <h1>Task List</h1>
        <p>temporary placeholder</p>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <a href="tasks.php">Tasks</a>
        <a href="members.php">Members</a>
    </nav>

    <main>
        <section class="card">
            <h2>Current Tasks</h2>

            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Task</th>
                        <th>Category</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= htmlspecialchars($task["student_id"]) ?></td>
                            <td><?= htmlspecialchars($task["student_name"]) ?></td>
                            <td><?= htmlspecialchars($task["title"]) ?></td>
                            <td><?= htmlspecialchars($task["category"]) ?></td>
                            <td><?= htmlspecialchars($task["status"]) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>&copy; Group HuM</p>
    </footer>
</body>
</html>
