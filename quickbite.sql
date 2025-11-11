-- Staffs Table
CREATE TABLE staffs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- Food Menu
CREATE TABLE food_menu (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  price DECIMAL(10,2) NOT NULL,
  stock INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders
CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(100) NOT NULL,
  food_id INT NOT NULL,
  quantity INT NOT NULL,
  total_amount DECIMAL(10,2) NOT NULL,
  status ENUM('pending', 'processing', 'completed', 'cancelled') DEFAULT 'pending',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (food_id) REFERENCES food_menu(id) ON DELETE CASCADE
);

-- Inventory logs
CREATE TABLE inventory_logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  food_id INT NOT NULL,
  action ENUM('add_stock', 'reduce_stock') NOT NULL,
  quantity INT NOT NULL,
  remarks TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (food_id) REFERENCES food_menu(id) ON DELETE CASCADE
);

ALTER TABLE food_menu
ADD COLUMN photo VARCHAR(255) DEFAULT NULL;