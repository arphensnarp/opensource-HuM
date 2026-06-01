# User Guide

This guide explains how to use Student Task Manager - Group HuM.

## Open the Application

Open the application in a browser:

```text
http://<raspberry-pi-link-local-ip>/
```

Example:

```text
http://169.254.1.1/
```

## Main Pages

| Page | Purpose |
|---|---|
| Home | Shows project purpose and runtime target |
| Tasks | Shows all task records |
| Add Task | Creates a new task |
| Members | Shows group members |

## View Tasks

Open the Tasks page.

The task table shows:

- Task ID
- Student ID
- Student name
- Task name
- Description
- Category
- Status
- Created time
- Action links

## Add a Task

Open the Add Task page.

Fill in:
- Student ID
- Student
- Category
- Status
- Task Name
- Task Description

Click:

```text
Create Task
```

If the form is valid, the task is saved and the application returns to the task list.

## Edit a Task

On the Tasks page, click:

```text
Edit
```

Change the task information.

Click:

```text
Update Task
```

If the form is valid, the task is updated and the application returns to the task list.

## Delete a Task

On the Tasks page, click:

```text
Delete
```

The application opens a confirmation page.

Click:

```text
Confirm Delete
```

The task is removed from the database.

Click:

```text
Cancel
```

to return without deleting.

## View Members

Open the Members page.

This page shows student/member data from the database.

## Form Rules

Required fields:
- Student ID
- Student
- Category
- Status
- Task Name

The task name must not be empty and must be 150 characters or fewer.

