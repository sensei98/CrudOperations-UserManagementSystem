<?php

    $host = "########";     
    $user = "#######";
    $password = "#######";
    $dbName = "#########";

    $conn = mysqli_connect($host, $user, $password, $dbName);

    if(!$conn){
        die("Connection failed : " .mysqli_connect_error());
    }

