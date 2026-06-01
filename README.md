# Student Task Manager - Group HuM

Student Task Manager - Group HuM is a simple PHP and MariaDB web application for managing student study tasks.

This project was built as a class demonstration project for Raspberry Pi Zero 2 W. The goal is to show basic web application development using PHP, HTML, CSS, CRUD operations, and a relational database.

## Features

The target application is a **student task management system**.

The system allows students to manage simple academic tasks such as assignments, reports, exercises, preparation work, and project tasks. Each task belongs to a student, has a category, and has a status that shows the current progress of the task.

## Runtime Environment

| Item | Value |
|---|---|
| Hardware | Raspberry Pi Zero 2 W |
| Operating System | DietPi |
| Web Server | Lighttpd |
| Server-side Language | PHP |
| Database | MariaDB |
| Demo Network | Link-local networking only |

## File Summary

| File | Purpose |
|---|---|
| `public/index.php` | Home page |
| `public/tasks.php` | Displays task records |
| `public/task_create.php` | Creates a new task |
| `public/task_edit.php` | Edits an existing task |
| `public/task_delete.php` | Deletes a task |
| `public/members.php` | Displays group members |
| `public/assets/style.css` | Basic page styling |
| `app/config.php` | Database configuration |
| `app/db.php` | PDO database connection |
| `app/functions.php` | Helper functions and CRUD functions |
| `app/layout.php` | Shared page layout |
| `sql/schema.sql` | Database schema |
| `sql/seed.sql` | Initial sample data |

## Database Design

The database has four main tables, which are also the entities:

| Table | Purpose |
|---|---|
| `students` | Stores student/member records |
| `categories` | Stores task category values |
| `statuses` | Stores task status values |
| `tasks` | Stores task records |

The `tasks` table references the other tables:

```text
tasks.student_id  -> students.student_id
tasks.category_id -> categories.category_id
tasks.status_id   -> statuses.status_id
```

### Relationships

- One category can be used by many tasks.
- One status can be used by many tasks.
- Each task belongs to one student.
- Each task belongs to one category.
- Each task has one status.
