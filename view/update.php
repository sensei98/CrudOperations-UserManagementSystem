<?php include "../controller/userUpdate.php";
include "header.php";

?>
<html>

<body>
    <H2>UPDATE USER</H2>

    <section class="container">

       
        <form action="../controller/userUpdate.php" method="post">
            <?php include 'alerts.php' ?>
            <!-- FOR NAME -->
            <section class="form-group">
                <label for="name">Name</label>
                <input type="name" class="form-control" id="name" name="name" value="<?= $row['name'] ?>">
                <!-- FOR USERNAME -->
                <label for="name">Username</label>
                <input type="text" class="form-control" id="uname" name="uname" value="<?= $row['username'] ?>">
                <!-- FOR EMAIL -->
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $row['email'] ?>">
            </section>


            <input type="text" name="id" value="<?= $row['ID'] ?>" hidden>

            <button type="submit" class="btn btn-primary" name="update">Update</button>
        </form>
        <a href="./home.php">Back</a>

</html>