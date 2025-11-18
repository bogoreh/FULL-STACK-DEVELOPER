CREATE DATABASE item_catalog;
USE item_catalog;

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2),
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO items (name, description, price, category) VALUES
('Laptop', 'High-performance laptop for work and gaming', 999.99, 'Electronics'),
('Coffee Mug', 'Beautiful ceramic coffee mug', 12.50, 'Kitchen'),
('Book', 'Programming guide for beginners', 29.99, 'Education');