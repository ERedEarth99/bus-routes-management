<?php
session_start();
require_once 'models/database.php';
require_once 'models/route_db.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch attendance rows (with attendance_id for deletion)
$attended = get_attended_routes($_SESSION['user_id']);

include 'views/header.php';
?>

<main>
  <h1>My Attended Routes</h1>
  <table class="route-table">
    <thead>
      <tr>
        <th>Route Name</th><th>Stops</th><th>Start</th><th>End</th><th>When</th><th>Remove</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($attended)): ?>
        <tr><td colspan="6">You haven’t attended any routes yet.</td></tr>
      <?php else: ?>
        <?php foreach ($attended as $a): ?>
          <tr>
            <td><?= htmlspecialchars($a['route_name']) ?></td>
            <td><?= htmlspecialchars($a['stops']) ?></td>
            <td><?= htmlspecialchars($a['start_time']) ?></td>
            <td><?= htmlspecialchars($a['end_time']) ?></td>
            <td><?= htmlspecialchars($a['attended_at']) ?></td>
            <td>
              <form action="remove_attendance.php" method="post">
                <input type="hidden" name="attendance_id" value="<?= $a['attendance_id'] ?>">
                <button type="submit">Remove</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</main>


