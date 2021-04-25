<?php
include 'common.php';
include 'db_controller.php';
// $foodnames = file_get_contents("food_names.txt");
//     $animalnames = file_get_contents("animal_names.txt");
//     $transportnames = file_get_contents("transport_names.txt");
$conn = new mysqli($db_server, $db_username, $db_password, $db_name);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name FROM pass_images WHERE type='food'";
if ($result = $conn->query($sql)) {
    while($row = mysqli_fetch_assoc($result)){
        echo $row['name'];
    }
}else{
    echo "no";
}
$sql = "SELECT name FROM pass_images WHERE type='animal'";
if ($result = $conn->query($sql)) {
    while($row = mysqli_fetch_assoc($result)){
        echo $row['name'];
    }
}else{
    echo "no";
}
$sql = "SELECT name FROM pass_images WHERE type='transport'";
if ($result = $conn->query($sql)) {
    while($row = mysqli_fetch_assoc($result)){
        echo $row['name'];
    }
}else{
    echo "no";
}
?>