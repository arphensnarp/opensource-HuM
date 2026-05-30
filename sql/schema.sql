-- Creates the database and all required tables

DROP DATABASE IF EXISTS student_task_manager;
CREATE DATABASE student_task_manager
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE student_task_manager;

-- Table: students
-- Stores student/group member information

CREATE TABLE students (
    student_id VARCHAR(20) PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL
) ENGINE=InnoDB;

-- Table: categories
-- Stores fixed task categories.

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Table: statuses
-- Stores fixed task status values.

CREATE TABLE statuses (
    status_id INT AUTO_INCREMENT PRIMARY KEY,
    status_name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB;

-- Table: tasks
-- Stores student task records.
-- Each task belongs to one student, one category, and one status.

CREATE TABLE tasks (
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(20) NOT NULL,
    category_id INT NOT NULL,
    status_id INT NOT NULL,
    task_name VARCHAR(150) NOT NULL,
    task_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_tasks_student
        FOREIGN KEY (student_id)
        REFERENCES students(student_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_tasks_category
        FOREIGN KEY (category_id)
        REFERENCES categories(category_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    CONSTRAINT fk_tasks_status
        FOREIGN KEY (status_id)
        REFERENCES statuses(status_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

    INDEX idx_tasks_student_id (student_id),
    INDEX idx_tasks_category_id (category_id),
    INDEX idx_tasks_status_id (status_id)
) ENGINE=InnoDB;
