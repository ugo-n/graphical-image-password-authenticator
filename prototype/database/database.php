<?php

/* This code is based off the assumption that 
    the database and table (from phpmyadmin users)already exists
*/
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proj_db";
   
    // Set DSN 
    $dsn = 'mysql:host=' . $host . ';dbname'. $dbname;

    try {
        // Create a PDO connection 
        $conn = new PDO($dsn, $username, $password);
        
        //set default fetch mode to associate array
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        echo "Connection successful";
    } catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
        //die("Connection failed: " . $e->getMessage());
    }
?>