<?php
session_start();

include 'validate-Data.php';
include 'reCaptcha.php';

if (isset($_POST['name']) && isset($_POST['uname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['r_password'])) {
    include "../model/db_conn.php";

    //validating all post 
    $name = validate($_POST['name']);
    $uname = validate($_POST['uname']);
    $email = validate($_POST['email']);
    $pass = validate($_POST['password']);
    $r_pass = validate($_POST['r_password']);

    $userData = 'uname=' . $uname . '&name=' . $name;

    // GOOGLE RECAPTCHA


    if ($grecaptcha == Recaptcha()) { //checking if recaptcha has been checked
        if (empty($uname)) {
            header("Location: ../view/signup.php?error=Username is required&$userData");
            exit();
        } else if (empty($pass)) {
            header("Location: ../view/signup.php?error=Password is required&$userData");
            exit();
        } else if (empty($r_pass)) {
            header("Location: ../view/signup.php?error=Repeat Password field is required&$userData");
            exit();
        } else if (empty($name)) {
            header("Location: ../view/signup.php?error=Name is required&$userData");
            exit();
        } else if (empty($email)) {
            header("Location: ../view/signup.php?error=Email is required&$userData");
            exit();
        } else if ($pass != $r_pass) {
            header("Location: ../view/signup.php?error=Passwords do not match&$userData");
            exit();
        } else {

            #hashing the password
            $password = md5($pass);

            $sql = "SELECT * FROM users WHERE username= '$uname'";
            $result = mysqli_query($conn, $sql);


            if (mysqli_num_rows($result) > 0) {
                header("Location: ../view/signup.php?error=Username is taken&$userData"); //checking for redundant username
                exit();
            } else {
                $sql2 = "INSERT INTO users (username,password,name,email) VALUES ('$uname' , '$password' , '$name', '$email') ";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2) {
                    header("Location: ../view/index.php?success=Account has been created successfully!");
                    exit();
                } else {
                    header("Location: ../view/signup.php?error=Error occured&$userData");
                    exit();
                }
            }
        }
    } else {
        header("Location: ../view/signup.php?error=You are a robot&$userData");
        exit();
    }
} else {
    header("Location: ../view/signup.php?error");
    exit();
}
