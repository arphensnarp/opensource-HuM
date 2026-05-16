# Student Task Manager - Group HuM

## Project Overview

**Student Task Manager - Group HuM** is a simple web application designed for students to record, view, update, and manage their study-related tasks. The project is developed as a lightweight server-side web application for the Raspberry Pi Zero 2 W.

## Target Application

The target application is a **student task management system**.

The system allows students to manage simple academic tasks such as assignments, reports, exercises, preparation work, and project tasks. Each task belongs to a student, has a category, and has a status that shows the current progress of the task.

The application is designed for a small group project environment and is not intended to be a large production system.

## Runtime Environment

The planned runtime environment is:

- HTTP Server: Lighttpd
- Server-side Scripting: PHP
- Database: MariaDB
- Operating System: DietPi
- Network Mode for Demo: Link-local networking only

## Concept

The first version of the application will manage the following information:

- Student name
- Student ID
- Task name
- Task description
- Task category
- Task status

## Database Entities

### Student

Stores information about students or group members.

Example attributes:

- student_id
- student_name

### Task

Stores task records.

Example attributes:

- task_id
- student_id
- category_id
- status_id
- task_name
- task_description

### Category

Stores task categories.

Example attributes:

- category_id
- category_name

Example categories:

- Assignment
- Report
- Project
- Exam Preparation
- Other

### Status

Stores task status values.

Example attributes:

- status_id
- status_name

Example statuses:

- Not Started
- In Progress
- Completed
- Cancelled

## Planned Pages

The planned web pages include:

| Page | Purpose |
|---|---|
| `index.php` | Home page and task overview |
| `tasks.php` | Display all tasks |
| `task_create.php` | Add a new task |
| `task_edit.php` | Edit an existing task |
| `task_delete.php` | Delete a task |
| `members.php` | Show group member introductions |
| `about.php` | Describe the project purpose |
| `db_test.php` | Temporary database connection test page during development |

The final page list may be adjusted during implementation.
