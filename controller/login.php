<?php
session_start();

include 'validate-Data.php';

if (isset($_POST['uname']) && isset($_POST['password'])) {
    include "../model/db_conn.php";

    //validating user data
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: ../view/index.php?error=Username is required");
        exit();
    } else if (empty($pass)) {
        header("Location: ../view/index.php?error=Password is required");
        exit();
    } else {
        #hashing the password
        $password = md5($pass);

        $sql = "SELECT * FROM users WHERE username= '$uname' AND password= '$password'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['username'] == $uname && $row['password'] == $password) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['ID'] = $row['ID'];
                header("Location: ../view/home.php");
                exit();
            } else {
                header("Location: ../view/index.php?error=Incorrect username or password");
                exit();
            }
        } else {
            header("Location: ../view/index.php?error=Incorrect username or password");
            exit();
        }
    }
} else {
    header("Location: ../view/index.php?error");
    exit();
}
