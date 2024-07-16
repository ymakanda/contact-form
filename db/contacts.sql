CREATE DATABASE IF NOT EXISTS contact_form_db;

USE contact_form_db;

CREATE TABLE IF NOT EXISTS contacts (
    id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO contacts (name, email, phone, message) VALUES
('John Doe', 'john@example.com', '0821234567', 'This is a test message.'),
('Jane Smith', 'jane@example.com', '0712345678', 'This is another test message.');
