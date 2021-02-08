<?php
include "../model/db_conn.php";

$sql = "SELECT * FROM users ORDER BY ID DESC";
$result = mysqli_query($conn, $sql);
