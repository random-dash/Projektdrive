<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "test";

    $connect = mysqli_connect($host, $user, $password, $database);
    
    if(!$connect){
        die("Verbindungsfehler: " . mysqli_connect_error());
    }    
