<h2>User Registration</h2>
<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php elseif (!empty($success)): ?>
    <p style="color:green;"><?= $success ?></p>
<?php endif; ?>
<form action="register.php" method="post">
    <label>Email:</label><br>
    <input type="email" name="email" required><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br>
    <label>Confirm Password:</label><br>
    <input type="password" name="confirm_password" required><br>
    <input type="submit" value="Register">
</form>
<p><a href="login.php">Already have an account? Log in here</a></p>
