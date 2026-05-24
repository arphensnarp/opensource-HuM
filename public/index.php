<?php
$pageTitle = "Student Task Manager - Group HuM";
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
        <h1>Student Task Manager - Group HuM</h1>
        <p>A lightweight PHP task management application for students.</p>
    </header>

    <nav>
        <a href="index.php">Home</a>
        <a href="tasks.php">Tasks</a>
        <a href="members.php">Members</a>
    </nav>

    <main>
        <section class="card">
            <h2>Project Purpose</h2>
            <p>
                This application is designed to practice PHP server-side scripting,
                relational database design, CRUD operations, and basic 3-tier web architecture.
            </p>
        </section>

        <section class="card">
            <h2>Runtime Target</h2>
            <ul>
                <li>Hardware: Raspberry Pi Zero 2 W</li>
                <li>Operating System: DietPi</li>
                <li>Server-side scripting: PHP</li>
                <li>Database: MariaDB</li>
                <li>Demo network: Link-local networking only</li>
            </ul>
        </section>
    </main>

    <footer>
        <p>&copy; Group HuM</p>
    </footer>
</body>
</html>
