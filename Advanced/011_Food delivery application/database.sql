CREATE DATABASE food_delivery;
USE food_delivery;

CREATE TABLE menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_url VARCHAR(255),
    category VARCHAR(50)
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    customer_address TEXT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'confirmed', 'delivered') DEFAULT 'pending'
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    menu_item_id INT,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id)
);

-- Insert sample data
INSERT INTO menu_items (name, description, price, image_url, category) VALUES
('Margherita Pizza', 'Classic pizza with tomato sauce and mozzarella', 12.99, 'pizza.jpg', 'Pizza'),
('Pepperoni Pizza', 'Pizza with pepperoni and cheese', 14.99, 'pepperoni.jpg', 'Pizza'),
('Chicken Burger', 'Grilled chicken burger with veggies', 9.99, 'burger.jpg', 'Burgers'),
('Caesar Salad', 'Fresh salad with caesar dressing', 8.99, 'salad.jpg', 'Salads'),
('French Fries', 'Crispy golden fries', 3.99, 'fries.jpg', 'Sides'),
('Coca Cola', 'Refreshing soft drink', 1.99, 'cola.jpg', 'Drinks');