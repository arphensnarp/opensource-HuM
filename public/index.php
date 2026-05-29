<?php
require_once __DIR__ . '/../app/layout.php';

$pageTitle = 'Student Task Manager - Group HuM';

render_header($pageTitle, 'home');
?>

<section class="card">
    <h2>Project Purpose</h2>
    <p>
        Student Task Manager - Group HuM is a simple web application for students
        to record, view, update, and manage study-related tasks.
    </p>
    <p>
        The project is designed to practice PHP server-side scripting, relational
        database design, CRUD operations, and basic HTML/CSS web development.
    </p>
</section>

<section class="card">
    <h2>Runtime Target</h2>
    <ul>
        <li>Hardware: Raspberry Pi Zero 2 W</li>
        <li>Operating System: DietPi</li>
        <li>HTTP Server: Lighttpd</li>
        <li>Server-side scripting: PHP</li>
        <li>Database: MariaDB</li>
        <li>Demo network: Link-local networking only</li>
    </ul>
</section>

<section class="card">
    <h2>Main Features</h2>
    <ul>
        <li>View student tasks</li>
        <li>Create new tasks</li>
        <li>Edit existing tasks</li>
        <li>Delete tasks</li>
        <li>Show group member introductions</li>
    </ul>
</section>

<?php
render_footer();
