<?php
require_once 'db_credentials.php';

// Add a new recipe
function add_recipe($name, $description, $user_id) {
    $conn = db_connect();
    $stmt = $conn->prepare("INSERT INTO recipe (name, description, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $description, $user_id);
    
    if ($stmt->execute()) {
        return $stmt->insert_id; // Return the new recipe ID
    } else {
        return false;
    }
}

// Get recipes with optional filters
function get_filtered_recipes($category = null, $sort = "newest") {
    $conn = db_connect();
    $sql = "SELECT r.recipe_id, r.name, r.description, u.first_name, u.last_name 
            FROM recipe r 
            JOIN user u ON r.user_id = u.user_id";

    if ($category) {
        $sql .= " JOIN recipe_category rc ON r.recipe_id = rc.recipe_id
                  JOIN category c ON rc.category_id = c.category_id
                  WHERE c.category_name = ?";
    }

    if ($sort === "highest_rated") {
        $sql .= " ORDER BY r.recipe_id DESC"; // Placeholder: Change to rating column when available
    } else {
        $sql .= " ORDER BY r.recipe_id DESC"; // Default: newest first
    }

    $stmt = $conn->prepare($sql);
    if ($category) {
        $stmt->bind_param("s", $category);
    }
    
    $stmt->execute();
    return $stmt->get_result();
}
?>
