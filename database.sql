CREATE DATABASE IF NOT EXISTS student_tasks
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE student_tasks;

CREATE TABLE IF NOT EXISTS tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(50) NOT NULL,
    priority VARCHAR(20) NOT NULL,
    due_date DATE NOT NULL,
    completed TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO tasks
(title, description, category, priority, due_date, completed)
VALUES
('PHP Assignment', 'Finish the PHP CRUD practical project.', 'Assignment', 'High', '2026-10-15', 0),
('Database Study', 'Review MySQL SELECT, INSERT, UPDATE and DELETE.', 'Reading', 'Medium', '2026-10-18', 0),
('Web Programming Exam', 'Prepare for the practical exam.', 'Exam', 'High', '2026-10-25', 0);
