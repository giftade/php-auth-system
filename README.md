# PHP Authentication System with Email Verification

This project is a simple, secure user authentication system built in PHP using object-oriented programming (OOP) and PDO for database interactions.

It supports essential user features like registration, login, logout, and email verification. The system hashes passwords securely and sends verification emails to users after they register to confirm their email addresses.

## What this project does

- Allows users to **register** with a username, email, and password
- Sends a **verification email** with a unique token to confirm the user's email address
- Allows users to **log in** only after verifying their email
- Manages user sessions securely
- Provides a simple **dashboard/profile** page for logged-in users
- Allows users to **log out** and end their session
- Implements database interactions using **PDO** with prepared statements to prevent SQL injection

## Why this project?

This project is ideal for anyone learning how to build a basic authentication system from scratch in PHP. It focuses on good practices such as:

- Using OOP to organize code  
- Secure password hashing with `password_hash()` and `password_verify()`  
- Sending email verification links  
- Using sessions securely for login state  
- Prepared statements to avoid SQL injection vulnerabilities

## How to use

1. Clone or download the repo  
2. Set up the MySQL database and update `includes/dbh.php` with your database credentials  
3. Run Mailhog or another SMTP server locally to capture outgoing emails  
4. Register a user, verify via email, then log in  
5. Explore the dashboard and logout features  

---

Feel free to customize this system to fit your own projects or expand it with features like password reset, user roles, or OAuth login!

---

## License

This project is open source and available for modification and reuse.
