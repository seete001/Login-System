#  Login System


The project provides user registration, login, password hashing, a personal dashboard(sample), SQLite database storage.

> ⚠️ **Educational Project:** This application is intended for learning and development purposes. It is **not** a real login system.


<img width="2528" height="1178" alt="Screenshot 2026-10-11 at 13 19 45" src="https://github.com/user-attachments/assets/6b27e49e-2676-4034-818d-53ada9c00303" />
<img width="2527" height="1178" alt="Screenshot 2026-10-11 at 13 20 01" src="https://github.com/user-attachments/assets/f19450a5-fe15-4c6e-8830-b06ca35db48c" />
<img width="2550" height="1180" alt="Screenshot 2026-10-11 at 13 20 39" src="https://github.com/user-attachments/assets/e081c6f0-687b-4758-a92c-c7c80a75a1cf" />


---

## ✨ Features

* 🔐 User registration and login
* 👤 User account information
* 🔒 Secure password hashing
* 🗄️ SQLite database
* 🎨 HTML/CSS web interface

---
## Authentication and Sessions: 

Passwords are hashed using PHP's password_hash() and verified with password_verify(). PHP sessions ($_SESSION) maintain the authenticated user's state across requests. After successful login, the user's ID and basic information are stored in the session. The dashboard checks the session before granting access, and logout destroys the session.

---

# 🗄️ Database

The application uses **SQLite** for local data storage.

The database file is:

```text
platform.db
```

The `users` table contains information such as:

```text
id
fullName
email
password
registeration Date
```

The email field is unique.

Passwords are stored as hashes rather than plain-text passwords.

The database is intended for **local development and testing**.

---


# 🔄 Application Flow

Routing: index.php maps URLs to HTML pages and PHP API endpoints.

Frontend: HTML provides the page structure, CSS handles styling, and JavaScript manages form submissions and UI interactions.

Backend: PHP processes registration and login requests and returns JSON responses.

Database: SQLite stores user information. PHP accesses it through PDO and prepared statements.

Authentication: Passwords are hashed before storage and verified during login. PHP sessions maintain the authenticated user's state and protect the dashboard.

Dashboard: The dashboard displays account summaries, transactions, and a Chart.js visualization.

# Requirements

PHP 8+

PDO SQLite extension enabled

A web browser Running Locally

From the project root, start the PHP development server:

    php -S localhost:8000 index.php

 # Open the application at:

http://localhost:8000

Register an account, log in, and access the dashboard.

---

# 🔮 Future Improvements

* [ ] Improved password recovery functionality
* [ ] Email verification
* [ ] Improved dashboard
* [ ] Better input validation
* [ ] Automated tests
* [ ] Improved error handling
* [ ] Improved UI/UX
* [ ] Database migrations
* [ ] More advanced security controls

---

# Project Structure

```text
transaction-bank/
├── index.php                 # Main router
├── backend/
│   ├── api/
│   │   ├── login.php         # User authentication
│   │   ├── signup.php        # Account registration
│   │   ├── dashboard.php     # Protected dashboard endpoint
│   │   └── logout.php        # Session termination
│   └── config/
│       └── database.php      # Database connection and user queries
├── database/
│   └── platform.db           # SQLite database
├── frontend/
│   ├── static/
│   │   ├── style.css         # Application styles
│   │   └── js/               # Frontend JavaScript modules
│   └── templates/
│       ├── login.html
│       ├── signup.html
│       └── dashboard.html
└── README.md
```


# Notes
This is a learning project. Dashboard balances and transactions may be sample data, and the Send Money feature may not yet perform actual transfers. It is not intended for real banking operations.
