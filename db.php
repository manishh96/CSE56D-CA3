<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'healthcare_system';


$conn = new mysqli($host, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql_create_db = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql_create_db) === TRUE) {
    
} else {
    echo "Error creating database: " . $conn->error;
}


$conn->select_db($database);


$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  
    role VARCHAR(20) NOT NULL        
)";
if ($conn->query($sql_users) === TRUE) {
   
} else {
    echo "Error creating users table: " . $conn->error;
}


$sql_insert_user = "INSERT IGNORE INTO users (username, password, role) 
VALUES 
('testuser', '" . password_hash('password123', PASSWORD_DEFAULT) . 
"', 'doctor')";
if ($conn->query($sql_insert_user) === TRUE) {
} else {
    echo "Error inserting test user: " . $conn->error;
}
$sql_vitals = "CREATE TABLE IF NOT EXISTS vitals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    temperature FLOAT,
    heart_rate INT,
    blood_pressure VARCHAR(20),
    recorded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT vitals_ibfk_1 FOREIGN KEY (user_id) REFERENCES 
    users(id) ON DELETE CASCADE
)";
if ($conn->query($sql_vitals) === TRUE) {
  
} else {
    echo "Error creating vitals table: " . $conn->error;
}

?>
