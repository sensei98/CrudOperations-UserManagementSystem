<?php

include 'validate-Data.php';


if (isset($_GET['id'])) {
    include '../model/db_conn.php';

    $id = validate($_GET['id']);

    $sql = "SELECT * FROM users WHERE ID=$id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        header("Location: ../view/home.php");
    }
} else if (isset($_POST['update'])) {
    include '../model/db_conn.php';

    $id = validate($_POST['id']);
    $name = validate($_POST['name']);
    $uname = validate($_POST['uname']);
    $email = validate($_POST['email']);


    if (empty($name)) {
        header("Location: ../view/update.php?id=$id&error=Name is required"); //error handler for checking if name textbox is empty
        exit();
    } else if (empty($email)) {
        header("Location: ../view/update.php?id=$id&error=Email is required"); //error handler for checking if email textbox is empty
        exit();
    } else if (empty($uname)) {
        header("Location: ../view/update.php?id=$id&error=Username is required"); //error handler for checking if username textbox is empty
        exit();
    } else {
        $pass = md5($password); //hashing

        $sql = "UPDATE users SET name='$name', email='$email', username='$uname' WHERE ID= '$id'";
        $result = mysqli_query($conn, $sql);

        //checking if result is correct 
        if ($result) {
            header("Location: ../view/home.php?success=Successfully updated!");
            exit();
        }
        //error 
        else {
            header("Location: ../view/update.php?id=$id&error=unknown error occured!");
            exit();
        }
    }
} else {
    header("Location: ../view/home.php");
    exit();
}
