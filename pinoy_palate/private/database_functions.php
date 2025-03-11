<?php
require_once 'db_credentials.php';

// Connect to database
function db_connect() {
    return db_connect();
}

// Query the database
function db_query($sql) {
    $conn = db_connect();
    $result = $conn->query($sql);
    if (!$result) {
        die("Database query failed: " . $conn->error);
    }
    return $result;
}

// Fetch all recipes
function get_all_recipes() {
    $sql = "SELECT recipe_id, name, description, user_id FROM recipe ORDER BY recipe_id DESC";
    return db_query($sql);
}

// Fetch a single recipe by ID
function get_recipe_by_id($recipe_id) {
    $sql = "SELECT * FROM recipe WHERE recipe_id = " . intval($recipe_id);
    return db_query($sql)->fetch_assoc();
}

// Fetch all categories
function get_all_categories() {
    $sql = "SELECT * FROM category ORDER BY category_name ASC";
    return db_query($sql);
}
?>
