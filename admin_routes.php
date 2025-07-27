<?php
// admin_routes.php
session_start();

// Only admins allowed
if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Load model
require_once 'models/database.php';
require_once 'models/route_db.php';

// Handle delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['route_id'])) {
    delete_route((int)$_POST['route_id']);
    header('Location: admin_routes.php');
    exit();
}

$routes = get_routes();

include 'views/header.php';
?>
<main>
  <h1>Route Management <small>(Admin)</small></h1>

  <p><a href="add_route.php">+ Add New Route</a></p>

  <table class="route-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Stops</th>
        <th>Start</th>
        <th>End</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($routes)): ?>
        <tr>
          <td colspan="5">No routes found.</td>
        </tr>
      <?php else: ?>
        <?php foreach ($routes as $route): ?>
          <tr>
            <td><?= htmlspecialchars($route['route_name']) ?></td>
            <td><?= nl2br(htmlspecialchars($route['stops'])) ?></td>
            <td><?= htmlspecialchars($route['start_time']) ?></td>
            <td><?= htmlspecialchars($route['end_time']) ?></td>
            <td>
              <?php if (!empty($route['route_id'])): ?>
                <a href="edit_route_form.php?id=<?= $route['route_id'] ?>">Edit</a>
                |
                <form action="admin_routes.php" method="post" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this route?')">
                  <input type="hidden" name="route_id" value="<?= htmlspecialchars($route['route_id']) ?>">
                  <button type="submit">Delete</button>
                </form>
              <?php else: ?>
                <em>No ID available</em>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</main>
<?php include 'views/footer.php'; ?>