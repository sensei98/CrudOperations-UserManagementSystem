<?php

include 'validate-data.php';

if (isset($_POST['reset-password-submit'])) {

    $selector = validate($_POST['selector']);
    $validator = validate($_POST['validator']);
    $password = validate($_POST['password']);
    $r_password = validate($_POST['r_password']);

    if (empty($password) || empty($r_password)) {
        header("Location:../view/forgotNewPassword?error=empty");
        exit();
    } else if ($password != $r_password) {
        header("Location: ../view/createNewPassword?error=Passwords do not match");
        exit();
    }

    $currentDate = date("U");

    include "../model/db_conn.php";

    //QUERY SELECT ALL
    $sql = "SELECT * FROM PasswordReset WHERE Selector=? and Expires>=?  "; //using prepared statements to prevent injection
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../view/createNewPasword.php?error=unknown error occured!");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_results($stmt); 
        if (!$row == mysqli_fetch_assoc($result)) {
            header("Location: ../view/createNewPasword.php?error=Re-submit reset request");
            exit();
        } else {
            $tokenBinary = hex2bin($validator);
            $tokenCheck = password_verify($tokenBinary, $row["Token"]);

            if ($tokenCheck == false) {
                header("Location: ../view/createNewPasword.php?error=Re-submit reset request");
                exit();
            } else {
                $tokenEmail = $row['Email'];

                //QUERY
                $sql = "SELECT * FROM users WHERE Email=? ";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../view/createNewPassword.php?error=unknown error occured!");
                    exit();
                } else {

                    //QUERY UPDATE
                    $sql = "UPDATE users SET password=? WHERE Email=?;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../view/createNewPasword.php?error=unknown error occured!");
                        exit();
                    } else {

                        $hashedPassword = md5($password); //HASHING

                        mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $tokenEmail);
                        mysqli_stmt_execute($stmt);


                        //DELETING THE TOKEN
                        $sql = "DELETE FROM PasswordReset WHERE Email=?";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            header("Location: ../view/createNewPassword.php?error=unknown error occured!");
                            exit();
                        } else {
                            mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                            mysqli_stmt_execute($stmt);
                            header("Location: ../view/index.php?success=Password is changed successfully!");
                            exit();
                        }
                    }
                }
            }
        }
    }
} else {
    header("Location: ../view/index.php");
    exit();
}
