<?php

require "db_controller.php";
require "image_names.php";

//retrieve name of all of the images

$foodarray = explode("\n", $food);
$animalarray = explode("\n", $animal);
$transportarray = explode("\n", $transport);

$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE pass_images (
id INT  NOT NULL AUTO_INCREMENT,
name VARCHAR(30) NOT NULL,
type VARCHAR(10) NOT NULL,
PRIMARY KEY (id)
)";
    
if ($conn->query($sql) === TRUE) {
    echo "Table pass_images created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
    

//$sql = "INSERT INTO `passimages`(`name`, `type`) 
//VALUES ('start','test');";
$sql = "";
foreach ($foodarray as $name){
    $sql .= "INSERT INTO `pass_images`(`name`, `type`) 
    VALUES ('$name','food');";
}
foreach ($animalarray as $name){
    $sql .= "INSERT INTO `pass_images`(`name`, `type`) 
    VALUES ('$name','animal');";
}
foreach ($transportarray as $name){
    $sql .= "INSERT INTO `pass_images`(`name`, `type`) 
    VALUES ('$name','transport');";
}
//$sql .= "INSERT INTO `passimages`(`name`, `type`) 
//VALUES ('end','test')";

//print($sql);

if ($conn->multi_query($sql) === TRUE) {
echo "New records created successfully";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}

/*$sql = "DELETE FROM passImages WHERE name='start';";
$sql .= "DELETE FROM passImages WHERE name='end'";

if ($conn->multi_query($sql) === TRUE) {
  echo "Records deleted successfully";
} else {
  echo "Error deleting records: " . $conn->error;
}
*/
$conn->close();

?>