<?php
$servername = "localhost";
$username = "root";
$password = "root";

    try{
        $connect = new PDO("mysql:host = $servername; dbname = alagapp_db", $username, $password);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Connected to Database";
    } catch(PDOException $e){
        echo "Connection Failed: ".$e->getMessage();        
    }
?>