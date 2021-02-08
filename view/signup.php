<?php include 'header.php' ?>

<head>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<html>

<body>
    <form action="../controller/signup-check.php" method="post">
        <h1>SIGN UP</h1>

        <?php include 'alerts.php' ?>
        <!-- 
        FOR NAME -->
        <label>Name</label>
        <?php if (isset($_GET['name'])) { ?>
            <input type="text" name="name" placeholder="Name" value="<?php echo $_GET['name']; ?>"><br>
        <?php } else { ?>
            <input type="text" name="name" placeholder="Name"><br>
        <?php } ?>

        <!-- 
            FOR USERNAME -->
        <label>Username</label>
        <?php if (isset($_GET['uname'])) { ?>
            <input type="text" name="uname" placeholder="Username" value="<?php echo $_GET['uname']; ?>"><br>
        <?php } else { ?>
            <input type="text" name="uname" placeholder="Username"><br>
        <?php } ?>

        <!-- 
        FOR EMAIL -->
        <label>E-mail</label>
        <?php if (isset($_GET['email'])) { ?>
            <input type="email" name="email" placeholder="Email" value="<?php echo $_GET['email']; ?>"><br>
        <?php } else { ?>
            <input type="email" name="email" placeholder="Email"><br>
        <?php } ?>




        <!-- FOR PASSWORD -->
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>

        <label>Repeat Password</label>
        <input type="password" name="r_password" placeholder="Repeat Password"><br>
        <!--                 
                google recaptcha -->

        <section class="g-recaptcha" data-sitekey="6LeUkUEaAAAAAOD3-_QqC9i2WuknECDEguE7hHKm"></section>

        <button type="submit">Sign Up</button>
        <a href="./index.php" class="su">Already have an account? Log in</a>

    </form>

</body>

</html>