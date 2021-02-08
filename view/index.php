<?php include 'header.php' ?>
<title>LOGIN</title>

<section class="phpHeading">
    <h1>PHP END ASSIGNMENT</h1>
    <p>Name: Tsagli Samuel. <br> Student Number: 641496</p>
</section>

</head>
<html>

<body>

    <form action="../controller/login.php" method="post">

        <?php include 'alerts.php' ?>

        <h1>LOGIN</h1>
        <label>Username</label>
        <input type="text" name="uname" placeholder="Username"><br>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit">Login</button>
        <a href="forgotPassword.php" class=fp>Forgot password?</a>
        <a href="signup.php" class="ca">Create an account</a>

    </form>

</body>

</html>