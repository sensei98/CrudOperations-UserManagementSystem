<?php include "../controller/userRecords.php";
include 'header.php';
?>
<html>
<nav>
    <input class="logout-btn " type="button" onClick="location.href = '../controller/logout.php';" value="Logout">
</nav>

<body>

    <!-- MAIN PAGE -->
    <section class="container">
        <section class="box">
            <h4 class="records-heading">Records</h4><br>

            <?php include 'alerts.php' ?>

            <?php if (mysqli_num_rows($result)) { ?>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($rows = mysqli_fetch_assoc($result)) {
                            $i++;
                        ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $rows['name'] ?></td>
                                <td><?php echo $rows['username']; ?></td>
                                <td><?php echo $rows['email']; ?></td>


                                <td><a href="../view/update.php?id=<?= $rows['ID'] ?>" class="btn btn-success">Update</a>
                                    <a href="../controller/delete.php?id=<?= $rows['ID'] ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
            <a href="./forgotPassword.php">Change password</a>

        </section>
    </section>

</body>

</html>