CREATE DATABASE rachaellys_cataloguedb;

USE rachaellys_cataloguedb;


CREATE TABLE users (
    -- 'id' column, auto-incremented integer, primary key of the table
    id INT AUTO_INCREMENT PRIMARY KEY,
    -- 'username' column, variable character string with a maximum length of 50, cannot be null
    username VARCHAR(50) NOT NULL,
    -- 'password' column, variable character string with a maximum length of 255, cannot be null
    password VARCHAR(255) NOT NULL,
     -- 'created_at' column, timestamp with a default value of the current timestamp
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    -- 'id' column, auto-incremented integer, primary key of the table
    id INT AUTO_INCREMENT PRIMARY KEY,
     -- 'name' column, variable character string with a maximum length of 255, cannot be null
    name VARCHAR(255) NOT NULL,
    -- 'description' column, text data type to hold the product description
    description TEXT,
    -- 'price' column, decimal data type with a precision of 10 and scale of 2, cannot be null
    price DECIMAL(10,2) NOT NULL,
    -- 'image' column, variable character string with a maximum length of 255, to store the image file path
    image VARCHAR(255),
    -- 'created_at' column, timestamp with a default value of the current timestamp
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    -- 'updated_at' column, timestamp with a default value of the current timestamp,
    -- automatically updates to the current timestamp whenever the row is updated
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
