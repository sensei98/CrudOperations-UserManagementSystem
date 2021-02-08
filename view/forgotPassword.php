<?php include 'header.php' ?>
<html <title>Forgot password</title>

</head>

<body>
    <section class="container">

        <form action="../controller/reset-password.php" method="post">
            <?php include 'alerts.php' ?>

            <h1>Reset your Password</h1>
            <p>An email will be sent to you on how you reset your password</p>
            <input type="text" name="email" placeholder="Enter your email address">
            <button type="submit" name="reset-request-submit">Reset</button>
        </form>
    </section>

</body>

</html>