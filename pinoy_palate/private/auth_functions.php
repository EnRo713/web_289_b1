<?php
require_once 'db_credentials.php';

// Register a new user
function register_user($first_name, $last_name, $email, $password) {
    $conn = db_connect();
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO user (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);

    return $stmt->execute();
}

// Login user
function login_user($email, $password) {
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT user_id, first_name, last_name, password, role FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['role'] = $row['role'];
            return true;
        }
    }
    return false;
}

// Logout user
function logout_user() {
    session_start();
    session_destroy();
}
?>
