<h2>Route Management <small>(Admin)</small></h2>

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
    <?php foreach ($routes as $route): ?>
    <tr>
      <td><?= htmlspecialchars($route['route_name'] ?? '') ?></td>
      <td><?= nl2br(htmlspecialchars($route['stops'] ?? '')) ?></td>
      <td><?= htmlspecialchars($route['start_time'] ?? '') ?></td>
      <td><?= htmlspecialchars($route['end_time'] ?? '') ?></td>
      <td>
        <a href="controllers/edit_route.php?id=<?= urlencode($route['route_id']) ?>">Edit</a>
        <form action="admin_routes.php" method="post" style="display:inline;">
          <input type="hidden" name="route_id" value="<?= htmlspecialchars($route['route_id']) ?>">
          <button type="submit" onclick="return confirm('Are you sure?');">Delete</button>
        </form>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
