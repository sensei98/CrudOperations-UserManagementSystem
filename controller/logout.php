<?php
session_start();
//destroyin sessions to logout
session_unset();
session_destroy();

header("Location: ../view/index.php"); //returns to the index page
exit();
