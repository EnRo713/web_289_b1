-- Database: pinoy_palate

-- User Table
CREATE TABLE user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Category Table
CREATE TABLE category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(50) NOT NULL UNIQUE
);

-- Recipe Table
CREATE TABLE recipe (
    recipe_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    category_id INT,
    user_id INT,
    FOREIGN KEY (category_id)
        REFERENCES category(category_id)
        ON DELETE SET NULL,
    FOREIGN KEY (user_id)
        REFERENCES user(user_id)
        ON DELETE CASCADE
);

-- Unit Table (added unit symbol)
CREATE TABLE unit (
    unit_id INT AUTO_INCREMENT PRIMARY KEY,
    unit_name VARCHAR(50) NOT NULL UNIQUE,
    unit_symbol VARCHAR(10) NOT NULL UNIQUE
);

-- Ingredient Table
CREATE TABLE ingredient (
    ingredient_id INT AUTO_INCREMENT PRIMARY KEY,
    ingredient_name VARCHAR(100) NOT NULL UNIQUE,
    unit_id INT,
    FOREIGN KEY (unit_id) REFERENCES unit(unit_id) ON DELETE SET NULL
);

-- Recipe_Ingredient Table (moved unit_quantity here)
CREATE TABLE recipe_ingredient (
    recipe_id INT,
    ingredient_id INT,
    quantity DECIMAL(10, 2) NOT NULL,
    unit_id INT NOT NULL,
    PRIMARY KEY (recipe_id, ingredient_id),
    FOREIGN KEY (recipe_id)
        REFERENCES recipe(recipe_id)
        ON DELETE CASCADE,
    FOREIGN KEY (ingredient_id)
        REFERENCES ingredient(ingredient_id)
        ON DELETE CASCADE,
    FOREIGN KEY (unit_id)
        REFERENCES unit(unit_id)
        ON DELETE CASCADE
);
