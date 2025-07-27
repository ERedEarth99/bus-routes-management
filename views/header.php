
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>BusRoute App</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
  <nav>
    <ul class="nav-list">
      <!-- always-visible -->
      <li><a href="index.php">All Routes</a></li>

      <?php if (empty($_SESSION['user_id'])): ?>
        <!-- not logged in -->
        <li><a href="login.php">Login</a></li>
        <li><a href="register.php">Register</a></li>

      <?php else: ?>
        <!-- logged in -->
        <?php if ($_SESSION['role'] === 'admin'): ?>
          <!-- admin-only -->
          <li><a href="admin_routes.php">Routes Admin</a></li>
          <li><a href="admin_attendance.php">Attendance Admin</a></li>
        <?php else: ?>
          <!-- normal users -->
          <li><a href="my_routes.php">My Routes</a></li>
        <?php endif; ?>

        <!-- common to all logged‑in -->
        <li>Welcome, <?= htmlspecialchars($_SESSION['user_email']) ?></li>
        <li><a href="logout.php">Log out</a></li>
      <?php endif; ?>
    </ul>
  </nav>
  <h1>BusRoute App</h1>
</header>
