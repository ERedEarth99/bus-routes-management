<?php
// index.php

session_start();

require_once 'models/database.php';
require_once 'models/route_db.php';

$routes = get_routes();

include 'views/header.php';
?>

<main>
  <h1>BusRoute App</h1>

  <?php foreach ($routes as $route): ?>
    <section>
      <h3><?= htmlspecialchars($route['route_name']) ?></h3>
      <p><?= nl2br(htmlspecialchars($route['stops'])) ?></p>
      <p><?= htmlspecialchars($route['start_time']) ?> - <?= htmlspecialchars($route['end_time']) ?></p>

      <?php if (!empty($_SESSION['user_id']) && $_SESSION['role'] === 'user'): ?>
        <form action="attend.php" method="post" style="display:inline;">
          <input type="hidden" name="route_id" value="<?= $route['route_id'] ?>">
          <button type="submit">Attend</button>
        </form>
      <?php endif; ?>
    </section>
  <?php endforeach; ?>
</main>

<?php include 'views/footer.php'; ?>
