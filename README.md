# Student Task Manager

## Student Information

Student Name: Daniel Dal Sian Thang, Phyoe Kyaw Zin

Student ID: 202200126, 202300307

## Project Description

This is a Student Task Manager made with plain PHP, MySQL/MariaDB, HTML and CSS.

The application supports:
- Create a task
- Read/view tasks
- Update a task
- Delete a task
- Server-side validation
- PDO database connection
- Prepared SQL statements
- GET and POST requests
- PHP sessions for flash messages
- Safe output with htmlspecialchars()
- Task filtering and title searching
- Completed/incomplete task counters
- Overdue task highlighting

## Assigned Challenge

For this project, the assigned challenge is implemented as:

**Filter incomplete tasks**

On the main page, the Status filter can show:
- All tasks
- Incomplete only
- Completed only

The page also includes priority filtering and title searching as extra useful features.

## Requirements

- PHP 8 or newer recommended
- MySQL or MariaDB
- Apache/XAMPP/WAMP/Laragon or another PHP server

No PHP framework or external library is required.

## Setup

1. Start Apache and MySQL.
2. Open phpMyAdmin or MySQL.
3. Run `database.sql`.
4. This creates the `student_tasks` database and `tasks` table.
5. Open `db.php`.
6. Change the database username/password if the local MySQL setup is different.
7. Put the project folder inside the web server folder, for example:
   `htdocs/student_task_manager`
8. Open:
   `http://localhost/student_task_manager/index.php`

## Main Files

- `index.php` - displays and filters tasks
- `create.php` - creates a task
- `edit.php` - updates a task
- `delete.php` - deletes a task
- `db.php` - PDO database connection
- `functions.php` - reusable functions and session flash messages
- `header.php` - common page header
- `footer.php` - common page footer
- `style.css` - custom styling
- `database.sql` - database and table setup

## AI-Use Reflection

Student Name:  Daniel Dal Sian Thang, Phyoe Kyaw Zin

Student ID: 202200126, 202300307

AI tool(s) used:
- ChatGPT

Three examples of how AI helped me:
1. AI helped me plan the PHP CRUD file structure.
2. AI helped me write and explain PDO prepared statements.
3. AI helped me identify validation and safe output techniques.

One AI-generated suggestion or piece of code that I changed or rejected:

What was it?
- I reviewed the generated code and simplified parts of it so I could understand the project more easily.

Why did I change/reject it?
- I changed parts when necessary to keep the code simple and suitable for my exam environment.

The part of this application I understand least:
- coding...

## Important

I must test the application myself and be able to explain the code during the code defense and live modification.
