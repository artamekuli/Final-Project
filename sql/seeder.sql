CREATE DATABASE IF NOT EXISTS contacts_db;
USE contacts_db;

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

INSERT INTO messages (name, email, message) VALUES
('Mason Maeka', 'masonmaeka2004@gmail.com', 'Hi there! I love your portfolio and would love to connect.'),
('Chistina Ioannides', 'akiigf@yahoo.com', 'I have a freelance opportunity I’d like to discuss with you.')