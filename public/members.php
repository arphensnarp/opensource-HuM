<?php
$pageTitle = "Members - Student Task Manager";

$members = [
    [
        "student_id" => "0",
        "name" => "stu0",
        "role" => "role0"
    ],
    [
        "student_id" => "1",
        "name" => "stu1",
        "role" => "role1"
    ],
    [
        "student_id" => "2",
        "name" => "stu2",
        "role" => "role2"
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
        <h1>Group HuM Members</h1>
        <p>membrs introduction.</p>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <a href="tasks.php">Tasks</a>
        <a href="members.php">Members</a>
    </nav>

    <main>
        <section class="card">
            <h2>Member List</h2>

            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Responsibility</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($members as $member): ?>
                        <tr>
                            <td><?= htmlspecialchars($member["student_id"]) ?></td>
                            <td><?= htmlspecialchars($member["name"]) ?></td>
                            <td><?= htmlspecialchars($member["role"]) ?></td>
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
