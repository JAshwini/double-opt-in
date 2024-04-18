# Project Name

This project contains the basic code for single opt in and double opt in which follows GDPR compliance and allow the
vendor to provide timestamped proof of single and double opt-in consent when requested for
GDPR inquiries.

## Database Setup

Follow these steps to set up the database:

### Step 1: Install MySQL

Ensure MySQL is installed and running on your machine.

### Step 2: Create Database

Create a new database for the project:

```sql
CREATE DATABASE project_database;
USE project_database;
```


### Step 3: Create Table

Create a new table:

```sql
CREATE TABLE user_consents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    single_opt_in BOOLEAN DEFAULT FALSE,
    single_opt_in_timestamp DATETIME,
    double_opt_in BOOLEAN DEFAULT FALSE,
    double_opt_in_timestamp DATETIME,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    phone_number VARCHAR(15),
    country VARCHAR(100) NOT NULL,
    zip_code VARCHAR(10),
    is_compliant BOOLEAN DEFAULT FALSE
);
```

### Step 4: Configure Connection

Edit the db.php or relevant database connection file to match your database name, user, and password: