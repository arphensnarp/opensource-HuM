<?php
require_once __DIR__ . '/../app/layout.php';

$pageTitle = 'Members - Student Task Manager';

$members = [
    [
        'name' => 'Bryan',
        'student_id' => '413854760',
        'role' => 'Initial task CRUD implementation',
        'description' => 'Prepared the first version of the task create, edit, and delete functions used in the task management workflow.',
    ],
    [
        'name' => 'Edward',
        'student_id' => '413855247',
        'role' => 'Application support files',
        'description' => 'Helped prepare supporting application files such as shared configuration, database connection structure, and reusable layout support.',
    ],
    [
        'name' => 'M',
        'student_id' => '413855536',
        'role' => 'PHP page refinement',
        'description' => 'Refined the display pages and helped improve how task and member information is presented through PHP pages.',
    ],
    [
        'name' => 'Ming',
        'student_id' => '413854802',
        'role' => 'Design review and quality checking',
        'description' => 'Reviewed the project design, checked the application flow, and helped verify that the final structure matched the project requirements.',
    ],
    [
        'name' => 'Thanks',
        'student_id' => '413855809',
        'role' => 'Initial database schema and seed data',
        'description' => 'Created the first version of the SQL schema and seed data used to build and test the MariaDB database.',
    ],
    [
        'name' => 'Vit',
        'student_id' => '413854745',
        'role' => 'CRUD integration',
        'description' => 'Integrated the task CRUD operations into the application and connected the PHP pages with the database-backed workflow.',
    ],
    [
        'name' => 'Myo',
        'student_id' => '413855907',
        'role' => 'Project documentation',
        'description' => 'Prepared and reviewed documentation for installation, usage, administration, and final project submission.',
    ],
];

render_header($pageTitle, 'members');
?>

<section class="card">
    <h2>Group HuM Members</h2>

    <p>
        This page introduces the members of Group HuM and summarizes each member's
        main contribution to the Student Task Manager project.
    </p>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Student ID</th>
                <th>Main Responsibility</th>
                <th>Contribution Summary</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($members as $member): ?>
                <tr>
                    <td><?= e($member['name']) ?></td>
                    <td><?= e($member['student_id']) ?></td>
                    <td><?= e($member['role']) ?></td>
                    <td><?= e($member['description']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php
render_footer();
