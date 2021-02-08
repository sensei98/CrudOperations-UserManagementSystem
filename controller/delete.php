<?php

include 'validate-Data.php';

if (isset($_GET['id'])) {
    include '../model/db_conn.php';

    $id = validate($_GET['id']);

    $sql = "DELETE FROM users WHERE ID='$id' ";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: ../view/home.php?success=successfully deleted!");
        exit();
    } else {
        header("Location: ../view/home.php?error=unknown error occured");
        exit();
    }
} else {
    header("Location: ../view/home.php");
    exit();
}
