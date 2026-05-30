-- Inserts initial sample records.

USE student_task_manager;


-- Students
-- Replace these placeholder names/IDs with real group member data later.

INSERT INTO students (student_id, student_name) VALUES
('S001', 'Ming'),
('S002', 'Bryan'),
('S003', 'M'),
('S004', 'Vit'),
('S005', 'Thanks'),
('S006', 'Edward'),
('S007', 'Myo');


-- Categories

INSERT INTO categories (category_name) VALUES
('Assignment'),
('Report'),
('Project'),
('Exam Preparation'),
('Other');


-- Statuses

INSERT INTO statuses (status_name) VALUES
('Not Started'),
('In Progress'),
('Completed'),
('Cancelled');


-- Sample Tasks
-- category_id:
-- 1 = Assignment
-- 2 = Report
-- 3 = Project
-- 4 = Exam Preparation
-- 5 = Other
--
-- status_id:
-- 1 = Not Started
-- 2 = In Progress
-- 3 = Completed
-- 4 = Cancelled

INSERT INTO tasks (
    student_id,
    category_id,
    status_id,
    task_name,
    task_description
) VALUES
('S001', 3, 2, 'mopping homework', 'mop 2nd floor'),
('S002', 2, 1, 'eating report', 'eat the hottest food for the team'),
('S003', 3, 2, 'Research', 'find cool things about strawberry'),
('S004', 1, 3, 'studying 4 schul', 'infiltrate NASA with ping and curl'),
('S005', 4, 1, 'cooking', 'make yummy pancakes :)');
