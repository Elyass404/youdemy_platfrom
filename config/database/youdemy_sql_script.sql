DROP DATABASE IF EXISTS youdemy;

-- Create the database
CREATE DATABASE youdemy

-- Connect to the database
USE youdemy;

-- Creating the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') DEFAULT 'Other',
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('Student', 'Teacher', 'Admin') NOT NULL, 
    photo VARCHAR(255),
    bio TEXT,
    birthdate DATE,
    status ENUM('Activated', 'Pending', 'Banned') DEFAULT 'Pending'
);

-- Creating the categories table
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(255) NOT NULL
);

-- Creating the tags table
CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tag_name VARCHAR(255) NOT NULL
);

-- Creating the courses table
CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,        
    category_id INT NOT NULL,
    content TEXT,
    featured_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    teacher_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (teacher_id) REFERENCES users(id)
);

-- Creating the enrolled_courses table (many to many relatinship between students and courses)
CREATE TABLE enrolled_courses (
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    status ENUM('In Progress', 'Completed') DEFAULT 'In Progress',
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (user_id, course_id), 
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Creating the course_tags table (many to many relationship between courses and tags)
CREATE TABLE course_tags (
    course_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (course_id, tag_id),
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

