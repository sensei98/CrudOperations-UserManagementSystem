<?php include 'header.php' ?>

<html>

<body>
    <section class="container">

        <?php  //checking if the tokens are in the URL 
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];

        if (empty($selector) || empty($validator)) {
            header("Location: forgotPassword.php?error=Could not validate your request");
            exit();
        } else {
            if (ctype_xdigit($selector) != false && ctype_xdigit($validator) != false) { //returns true or false
        ?>
                <!-- FOR ALERTS -->
                <form action="../controller/newPasswordRequest.php" method="post">
                    <?php include 'alerts.php' ?>

                    <!-- PASSWORD RESET FORM -->
                    <h1>RESET PASSWORD</h1>
                    <input type="hidden" name="selector" value="<?php echo $selector ?>">
                    <input type="hidden" name="validator" value="<?php echo $validator ?>">
                    <label>Enter new password</label>
                    <input type="password" name="password" placeholder="New password">
                    <label>Repeat new password</label>
                    <input type="password" name="r_password" placeholder="Repeat n">
                    <button type="submit" name="reset-password-submit">Reset Password</button>
                </form>

        <?php

            }
        }

        ?>

    </section>

</body>

</html>