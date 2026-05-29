<?php
require_once __DIR__ . '/../app/layout.php';

$pageTitle = 'Members - Student Task Manager';

// test data
$members = [
    [
        'student_id' => 'S001',
        'name' => 'a',
        'role' => 'Database design and SQL scripts',
    ],
    [
        'student_id' => 'S002',
        'name' => 'b',
        'role' => 'PHP task pages and CRUD logic',
    ],
    [
        'student_id' => 'S003',
        'name' => 'c',
        'role' => 'Interface styling and documentation',
    ],
];

render_header($pageTitle, 'members');
?>

<section class="card">
    <h2>Group HuM Members</h2>

    <p>
        This page introduces the members of Group HuM and their responsibilities
        in the Student Task Manager project.
    </p>

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
                    <td><?= e($member['student_id']) ?></td>
                    <td><?= e($member['name']) ?></td>
                    <td><?= e($member['role']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php
render_footer();
