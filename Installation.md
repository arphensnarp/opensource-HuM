# Installation Guide

This guide explains how to install Student Task Manager - Group HuM on DietPi.

## Target Stack

- Raspberry Pi Zero 2 W
- DietPi
- Lighttpd
- PHP
- MariaDB

## 1. Update DietPi

```bash
sudo apt update
sudo apt upgrade
```

## 2. Install Required Software

```bash
sudo apt install lighttpd mariadb-server php php-cli php-fpm php-mysql
```

Restart services:

```bash
sudo systemctl restart lighttpd
sudo systemctl restart mariadb
```

If PHP-FPM is used, note that you need to know the version, as of now its php8.4-fpm:

```bash
sudo systemctl restart php8.4-fpm
```

## 3. Check Installed Components

```bash
lighttpd -v
php -v
mariadb --version
```

Check PHP modules:

```bash
php -m | grep -i pdo
php -m | grep -i mysql
```

Expected modules include:

```text
PDO
pdo_mysql
mysqli
mbstring
```

## 4. Clone the Repository

Go to the web folder:

```bash
cd /var/www
```

Clone the repository:

```bash
sudo git clone https://github.com/arphensnarp/opensource-HuM.git student-task-manager
```

Enter the project folder:

```bash
cd /var/www/student-task-manager
```

If the repository already exists:

```bash
git checkout main
git pull origin main
```

## 5. Check Database Configuration

Open:

```bash
nano app/config.php
```

Default settings:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'student_task_manager');
define('DB_USER', 'stm_user');
define('DB_PASS', 'stm_password');
define('DB_CHARSET', 'utf8mb4');
```

The MariaDB user and password must match these values.

## 6. Import Database

From the project root:

```bash
sudo mariadb < sql/schema.sql
sudo mariadb < sql/seed.sql
```

This creates the database and inserts sample data.

## 7. Create Database User

Open MariaDB:

```bash
sudo mariadb
```

Run:

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

## 8. Test Database User

```bash
mysql -u stm_user -p -D student_task_manager
```

Password:

```text
stm_password
```

Run:

```sql
SELECT COUNT(*) FROM tasks;
EXIT;
```

## 9. Test PHP Database Connection

From the project root:

```bash
php -r "require 'app/db.php'; \$pdo = get_db_connection(); echo 'Database connection OK' . PHP_EOL;"
```

Check task count:

```bash
php -r "require 'app/db.php'; \$pdo = get_db_connection(); echo 'Tasks: ' . \$pdo->query('SELECT COUNT(*) FROM tasks')->fetchColumn() . PHP_EOL;"
```

## 10. Configure Lighttpd Document Root

Lighttpd should serve the `public/` folder:

```bash
sudo nano /etc/lighttpd/lighttpd.conf

```
Find the `server.document-root` line and set it to:

```text
server.document-root = "/var/www/student-task-manager/public"
```

Do not serve the full project folder:

```text
/var/www/student-task-manager
```

Restart Lighttpd after changing the configuration:

```bash
sudo systemctl restart lighttpd
```

## 11. Open the Application

Open in browser:

```text
http://<raspberry-pi-link-local-ip>/
```

Example:

```text
http://169.254.1.1/
```

The exact IP depends on the Raspberry Pi link-local network setup.
