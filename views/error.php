<?php include 'views/header.php'; ?>
<main>
  <h2>Error</h2>
  <p><?= htmlspecialchars($error ?? 'Unknown error.') ?></p>
  <p><a href="index.php">Return to Home</a></p>
</main>
<?php include 'views/footer.php'; ?>
