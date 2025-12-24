<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
$isAdmin = isset($_SESSION["admin_username"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "Library Management"; ?></title>
  <link rel="stylesheet" href="style.css"/>
</head>
<body>
<header class="topbar">
  <div class="wrap topbar__inner">
    <div class="brand">
      <div class="brand__logo" aria-hidden="true">📚</div>
      <div class="brand__text">
        <div class="brand__name">Library</div>
        <div class="brand__tag">Management System</div>
      </div>
    </div>

    <nav class="nav">
      <a class="nav__link" href="index.php">Home</a>
      <?php if ($isAdmin): ?>
        <a class="nav__link" href="dashboard.php">Dashboard</a>
        <a class="nav__link" href="logout.php">Logout</a>
      <?php else: ?>
        <a class="nav__link" href="login.php">Admin Login</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
<main class="wrap">
