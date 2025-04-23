CREATE DATABASE contact_form;

USE contact_form;

CREATE TABLE submissions (
                             id INT AUTO_INCREMENT PRIMARY KEY,
                             name VARCHAR(255) NOT NULL,
                             email VARCHAR(255) NOT NULL,
                             comment TEXT NOT NULL,
                             submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)