
CREATE DATABASE IF NOT EXISTS eventshop;
USE eventshop;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('user','vendor','admin') DEFAULT 'user'
);

CREATE TABLE vendors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100),
    bio TEXT,
    image VARCHAR(255)
);

CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vendor_id INT,
    category VARCHAR(100),
    title VARCHAR(100),
    description TEXT,
    price DECIMAL(10,2),
    image VARCHAR(255)
);

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    service_id INT
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10,2),
    event_date DATE,
    location TEXT,
    status VARCHAR(50) DEFAULT 'pending'
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    service_id INT,
    price DECIMAL(10,2)
);
