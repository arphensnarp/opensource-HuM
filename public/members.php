<?php
require_once __DIR__ . '/../app/db.php';
require_once __DIR__ . '/../app/layout.php';

$pageTitle = 'Members - Student Task Manager';

$pdo = get_db_connection();
$members = get_all_students($pdo);

render_header($pageTitle, 'members');
?>

<section class="card">
    <h2>Group HuM Members</h2>

    <p>
        This page introduces the members stored in the student table.
    </p>

    <?php if (empty($members)): ?>
        <p class="notice">No members found.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $member): ?>
                    <tr>
                        <td><?= e($member['student_id']) ?></td>
                        <td><?= e($member['student_name']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>

<?php
render_footer();
