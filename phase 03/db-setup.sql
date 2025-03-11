-- Drop existing database if it exists
DROP DATABASE IF EXISTS pinoy_palate;
CREATE DATABASE pinoy_palate;
USE pinoy_palate;

-- User Table (with separate name fields)
CREATE TABLE user (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100) NULL,
    last_name VARCHAR(100) NOT NULL,
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

-- Recipe Table (NO category_id column)
CREATE TABLE recipe (
    recipe_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE
);

-- Recipe-Category Many-to-Many Table
CREATE TABLE recipe_category (
    recipe_id INT,
    category_id INT,
    PRIMARY KEY (recipe_id, category_id),
    FOREIGN KEY (recipe_id) REFERENCES recipe(recipe_id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES category(category_id) ON DELETE CASCADE
);

-- Unit Table
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

-- Recipe-Ingredient Many-to-Many Table
CREATE TABLE recipe_ingredient (
    recipe_id INT,
    ingredient_id INT,
    quantity DECIMAL(10, 2) NOT NULL,
    unit_id INT NOT NULL,
    PRIMARY KEY (recipe_id, ingredient_id),
    FOREIGN KEY (recipe_id) REFERENCES recipe(recipe_id) ON DELETE CASCADE,
    FOREIGN KEY (ingredient_id) REFERENCES ingredient(ingredient_id) ON DELETE CASCADE,
    FOREIGN KEY (unit_id) REFERENCES unit(unit_id) ON DELETE CASCADE
);

-- Sample Data

-- Insert Users
/*
INSERT INTO user (name, email, password, role) VALUES
('Admin User', 'admin@example.com', 'hashedpassword', 'admin'),
('Regular User', 'user@example.com', 'hashedpassword', 'user');
*/

-- Insert Categories
INSERT INTO category (category_name) VALUES
('Filipino'),
('Dinner'),
('Vegetarian'),
('Dessert');

-- Insert Recipes
INSERT INTO recipe (name, description, user_id) VALUES
('Chicken Adobo', 'A Filipino dish with soy sauce, vinegar, and garlic.', 1),
('Pancit Canton', 'A stir-fried noodle dish with vegetables and meat.', 2);

-- Assign Categories to Recipes
INSERT INTO recipe_category (recipe_id, category_id) VALUES
(1, 1),  -- Chicken Adobo → Filipino
(1, 2),  -- Chicken Adobo → Dinner
(2, 1),  -- Pancit Canton → Filipino
(2, 2);  -- Pancit Canton → Dinner

-- Insert Units
INSERT INTO unit (unit_name, unit_symbol) VALUES
('Teaspoon', 'tsp'),
('Cup', 'cup'),
('Gram', 'g'),
('Piece', 'pc');

-- Insert Ingredients
INSERT INTO ingredient (ingredient_name, unit_id) VALUES
('Sugar', 1),
('Soy Sauce', 2),
('Chicken', 3);

-- Assign Ingredients to Recipes
INSERT INTO recipe_ingredient (recipe_id, ingredient_id, quantity, unit_id) VALUES
(1, 1, 1, 1),  -- Chicken Adobo: 1 tsp Sugar
(1, 2, 3, 2),  -- Chicken Adobo: 3 cups Soy Sauce
(1, 3, 500, 3); -- Chicken Adobo: 500g Chicken

-- Query Examples:

-- Find all categories for a recipe
SELECT r.name AS recipe_name, GROUP_CONCAT(c.category_name SEPARATOR ', ') AS categories
FROM recipe_category rc
JOIN recipe r ON rc.recipe_id = r.recipe_id
JOIN category c ON rc.category_id = c.category_id
GROUP BY r.name;

-- Find all recipes in a specific category (e.g., 'Filipino')
SELECT r.name, r.description
FROM recipe_category rc
JOIN recipe r ON rc.recipe_id = r.recipe_id
JOIN category c ON rc.category_id = c.category_id
WHERE c.category_name = 'Filipino';
