<?php

    $host = "server.infhaarlem.nl";     
    $user = "s641496";
    $password = "j6mouYyw";
    $dbName = "s641496_phpEndAssignment";

    $conn = mysqli_connect($host, $user, $password, $dbName);

    if(!$conn){
        die("Connection failed : " .mysqli_connect_error());
    }

