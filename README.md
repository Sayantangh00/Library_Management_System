# Full-stack PHP + MySQL Sample Website
## What's included
- `config.php` - database configuration
- `db.sql` - SQL to create the database and sample data
- `index.php` - public landing / login redirect
- `register.php` - user registration
- `login.php` - user login
- `logout.php` - logout script
- `dashboard.php` - protected admin/dashboard listing books
- `add_book.php` - add a book (protected)
- `edit_book.php` - edit a book (protected)
- `delete_book.php` - delete a book (protected)
- `assets/style.css` - minimal styles
- `.gitignore` - ignore vendor and local files


## Requirements
- PHP 7.4+ with mysqli and session support
- MySQL / MariaDB
- A local server (XAMPP, MAMP, LAMP, or PHP built-in server)


## Setup steps
1. Create a MySQL database (example: `library_db`).

2. Import `db.sql` into your MySQL server. Example (from terminal):

   ```bash

   mysql -u root -p < db.sql

   ```

3. Open `config.php` and update DB credentials.

4. Copy the project into your web server's document root (e.g., `htdocs` or `www`) or run the built-in PHP server:


   ```bash

   php -S localhost:8000

   ```


5. Visit `http://localhost:8000` (or the appropriate URL). Register a new user, then login to access the dashboard.


## Security notes

- This is a simple educational example. For production, use strong password hashing, input validation, CSRF protection, and parameterized queries throughout.

