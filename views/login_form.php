<h2>Login</h2>
<?php if (!empty($error)): ?>
  <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>
<form action="../login.php" method="post">
  <label>Email:</label><br>
  <input type="email" name="email" required><br>
  <label>Password:</label><br>
  <input type="password" name="password" required><br>
  <input type="submit" value="Login">
</form>
