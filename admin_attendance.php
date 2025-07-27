<?php
// admin_attendance.php

session_start();

// Only admin allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Load required files
require_once 'models/database.php';
require_once 'models/route_db.php';
require_once 'models/user_db.php';

// Handle POST delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['attendance_id'])) {
    delete_attendance((int)$_POST['attendance_id']); // already defined in route_db.php
    header('Location: admin_attendance.php');
    exit();
}

// Fetch attendance
$records = get_all_attendance();

include 'views/header.php';
?>

<main>
  <h1>Attendance Management <small>(Admin)</small></h1>
  <table class="route-table">
    <thead>
      <tr>
        <th>User</th>
        <th>Route</th>
        <th>When</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($records)) : ?>
        <tr><td colspan="4">No attendance records found.</td></tr>
      <?php else : ?>
        <?php foreach ($records as $record) : ?>
          <tr>
            <td><?= htmlspecialchars($record['user_email']) ?></td>
            <td><?= htmlspecialchars($record['route_name']) ?></td>
            <td><?= htmlspecialchars($record['attended_at']) ?></td>
            <td>
              <form method="post" onsubmit="return confirm('Are you sure you want to delete this attendance record?');">
                <input type="hidden" name="attendance_id" value="<?= (int)$record['attendance_id'] ?>">
                <button type="submit">Remove</button>
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</main>

<?php include 'views/footer.php'; ?>
.