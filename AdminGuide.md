# Admin Guide

This guide explains how to configure, verify, and maintain Student Task Manager - Group HuM.

## Application Structure

```text
public/  browser-accessible PHP pages
app/     private PHP configuration and helper files
sql/     database setup scripts
```

The web server should point to:

```text
public/
```

The web server should not expose:

```text
app/
```

## Runtime Stack

| Component | Technology |
|---|---|
| Hardware | Raspberry Pi Zero 2 W |
| OS | DietPi |
| Web Server | Lighttpd |
| Language | PHP |
| Database | MariaDB |

## Database Configuration

Database settings are stored in:

```text
app/config.php
```

Default values:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'student_task_manager');
define('DB_USER', 'stm_user');
define('DB_PASS', 'stm_password');
define('DB_CHARSET', 'utf8mb4');
```

If the MariaDB username, password, or database name changes, update this file.

## Database Tables

| Table | Purpose |
|---|---|
| `students` | Stores student/member records |
| `categories` | Stores task categories |
| `statuses` | Stores task status values |
| `tasks` | Stores task records |

## Foreign Key Relationships

```text
tasks.student_id  -> students.student_id
tasks.category_id -> categories.category_id
tasks.status_id   -> statuses.status_id
```

This keeps task records connected to valid students, categories, and statuses.

## Reset Database

Warning: this deletes and recreates the database.

From the project root:

```bash
sudo mariadb < sql/schema.sql
sudo mariadb < sql/seed.sql
```

## Create or Reset PHP Database User

```bash
sudo mariadb
```

```sql
DROP USER IF EXISTS 'stm_user'@'localhost';

CREATE USER 'stm_user'@'localhost'
IDENTIFIED BY 'stm_password';

GRANT SELECT, INSERT, UPDATE, DELETE
ON student_task_manager.*
TO 'stm_user'@'localhost';

FLUSH PRIVILEGES;

EXIT;
```

## Verify Database

```bash
sudo mariadb
```

```sql
USE student_task_manager;
SHOW TABLES;

SELECT COUNT(*) FROM students;
SELECT COUNT(*) FROM categories;
SELECT COUNT(*) FROM statuses;
SELECT COUNT(*) FROM tasks;

EXIT;
```

## Verify Relational Query

```bash
sudo mariadb
```

```sql
USE student_task_manager;

SELECT
    tasks.task_id,
    students.student_id,
    students.student_name,
    tasks.task_name,
    categories.category_name,
    statuses.status_name
FROM tasks
JOIN students
    ON tasks.student_id = students.student_id
JOIN categories
    ON tasks.category_id = categories.category_id
JOIN statuses
    ON tasks.status_id = statuses.status_id
ORDER BY tasks.task_id DESC;

EXIT;
```

## Verify PHP Syntax

From the project root:

```bash
php -l app/config.php
php -l app/db.php
php -l app/functions.php
php -l app/layout.php

php -l public/index.php
php -l public/tasks.php
php -l public/task_create.php
php -l public/task_edit.php
php -l public/task_delete.php
php -l public/members.php
```

Expected result:

```text
No syntax errors detected
```

## Verify PHP Database Connection

```bash
php -r "require 'app/db.php'; \$pdo = get_db_connection(); echo 'Database connection OK' . PHP_EOL;"
```

Check task count:

```bash
php -r "require 'app/db.php'; \$pdo = get_db_connection(); echo 'Tasks: ' . \$pdo->query('SELECT COUNT(*) FROM tasks')->fetchColumn() . PHP_EOL;"
```

## Service Commands

Restart Lighttpd:

```bash
sudo systemctl restart lighttpd
```

Restart MariaDB:

```bash
sudo systemctl restart mariadb
```

Restart PHP-FPM if used:

```bash
sudo systemctl restart php*-fpm
```

Check status:

```bash
sudo systemctl status lighttpd
sudo systemctl status mariadb
```

## Troubleshooting

### Database access denied

Example:

```text
Access denied for user 'stm_user'@'localhost'
```

Fix:

1. Check `app/config.php`.
2. Recreate the MariaDB user.
3. Re-test PHP database connection.

### `mb_strlen()` missing

Example:

```text
Call to undefined function mb_strlen()
```

Fix:

```bash
sudo apt install php-mbstring
sudo systemctl restart lighttpd
```

If PHP-FPM is used:

```bash
sudo systemctl restart php*-fpm
```

### Page returns server error

Check PHP syntax:

```bash
php -l public/tasks.php
php -l app/functions.php
```

Check services:

```bash
sudo systemctl status lighttpd
sudo systemctl status mariadb
```

Check the Lighttpd/PHP error log.


