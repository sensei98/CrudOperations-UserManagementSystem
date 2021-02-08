<?php

if (isset($_POST['reset-request-submit'])) {

    $selector = bin2hex(random_bytes(8));
    $token  = random_bytes(32); //authenticates the user

    $url = "www.myurl.com/createNewPassword.php?selector=$selector&validator=" . bin2hex($token); //link sent to the user //website goes here

    $expires = date("U") + 1800; //     one hour

    include "../model/db_conn.php";

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM PasswordReset WHERE Email=?";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../view/forgotPassword.php?error=unknown error occured!");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    //SQL QUERY
    $sql = "INSERT INTO PasswordReset (Email,Selector,Token,Expires) VALUES (?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../view/forgotPassword.php?error=unknown error occured!");
        exit();
    } else {
        $hashedToken = md5($token);

        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hashedToken, $expires);
        mysqli_stmt_execute($stmt);
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);


    //sending email
    $to = $userEmail;
    $subject = "Reset your password";
    $message = '<p>The link to reset your password is below. If you did not make this request, simply ignore this email</p>';
    $message .= '<p>Here is your password reset link<br>';
    $message .= '<a href = " ' . $url . ' ">' . $url . ' </a></p>';


    mail($to, $subject, $message);
    header("Location: ../view/index.php?success=Password reset is successful. Check your email");
    exit();
} else {
    header("Location: ../view/index.php");
    exit();
}
