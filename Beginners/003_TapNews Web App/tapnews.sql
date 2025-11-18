CREATE DATABASE tapnews;
USE tapnews;

CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    category VARCHAR(100),
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO news (title, content, category, image_url) VALUES
('Welcome to TapNews', 'This is the first news article on our platform. Stay tuned for more updates!', 'General', 'https://picsum.photos/600/400'),
('Technology Trends 2024', 'Discover the latest technology trends shaping our future in 2024.', 'Technology', 'https://picsum.photos/600/400?1'),
('Health and Wellness Tips', 'Learn about simple daily habits that can improve your overall health and wellbeing.', 'Health', 'https://picsum.photos/600/400?2');