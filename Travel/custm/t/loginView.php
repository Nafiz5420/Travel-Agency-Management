<!-- loginView.php -->
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form method="post" action="index.php" novalidate>
        <fieldset style="width:350px">
            <legend>Login</legend>
            <?php if (!empty($error)): ?>
                <p><?php echo $error; ?></p>
            <?php endif; ?>

            <label for="uname">Username:</label>
            <input type="text" name="uname" id="uname" value="<?php echo htmlspecialchars($username ?? ''); ?>" required><br>

            <label for="pass">Password:</label>
            <input type="password" name="pass" id="pass" required><br>

            <input type="checkbox" name="remember"> Remember Me<br>

            <input type="submit" value="Login">
            <p><a href="forgotpassword.php">Forgotten Password?</a></p>
        </fieldset>
    </form>
</body>
</html>
