<?php
require "db_controller.php";

$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS lock_out (
id INT NOT NULL AUTO_INCREMENT,
username VARCHAR(16) NOT NULL,
time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table lock_out created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>