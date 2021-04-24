<?php

require "db_controller.php";

$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS userinfo (
username VARCHAR(16)  NOT NULL,
pass_id1 VARCHAR(30) NOT NULL,
pass_id2 VARCHAR(30) NOT NULL,
pass_id3 VARCHAR(30) NOT NULL,
pass_id4 VARCHAR(30) NOT NULL,
pass_id5 VARCHAR(30) NOT NULL,
PRIMARY KEY (username)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table userinfo created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

?>
