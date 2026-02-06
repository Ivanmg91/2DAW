-- Database: bdprueba

-- Users Table (Clients and Sellers)
-- Store credentials and login
CREATE TABLE IF NOT EXISTS usuarios_proyecto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(50) NOT NULL,
    role VARCHAR(20) NOT NULL
);

-- Products table (Catalog)
-- Store items
CREATE TABLE IF NOT EXISTS productos_proyecto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    price FLOAT NOT NULL,
    image_url TEXT
);

-- Purchases table (Records)
-- Store orders and tracking numbers
CREATE TABLE IF NOT EXISTS compras_proyecto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tracking_number INT NOT NULL,
    customer_name VARCHAR(100) NOT NULL,
    items_list TEXT,
    total_price FLOAT NOT NULL
);

-- DATA EXAMPLES

-- Insert admin user (seller) by default
-- User: admin / Contraseña: admin123
INSERT INTO usuarios_proyecto (username, password, role) 
SELECT 'admin', 'admin123', 'seller' 
WHERE NOT EXISTS (SELECT * FROM usuarios_proyecto WHERE username = 'admin');

-- Insert products by default
INSERT INTO productos_proyecto (name, price, image_url) 
SELECT 'Java T-Shirt', 15.50, 'https://upload.wikimedia.org/wikipedia/en/3/30/Java_programming_language_logo.svg'
WHERE NOT EXISTS (SELECT * FROM productos_proyecto WHERE name = 'Java T-Shirt');

INSERT INTO productos_proyecto (name, price, image_url) 
SELECT 'Coffee Mug', 8.00, 'https://m.media-amazon.com/images/I/51rJjX+M+iL.jpg'
WHERE NOT EXISTS (SELECT * FROM productos_proyecto WHERE name = 'Coffee Mug');

INSERT INTO productos_proyecto (name, price, image_url) 
SELECT 'Keyboard', 45.00, 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/Computer_keyboard_Danish_layout.svg/1200px-Computer_keyboard_Danish_layout.svg.png'
WHERE NOT EXISTS (SELECT * FROM productos_proyecto WHERE name = 'Keyboard');