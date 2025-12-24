<?php
$pageTitle = "Admin Login";
require "config.php";
session_start();

// If already logged in, go dashboard
if (isset($_SESSION["admin_username"])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($username === "" || $password === "") {
        $error = "Please enter username and password.";
    } else {
        $stmt = $conn->prepare("SELECT username, password_hash FROM admins WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();
        $admin = $res->fetch_assoc();
        $stmt->close();

        if ($admin && password_verify($password, $admin["password_hash"])) {
            $_SESSION["admin_username"] = $admin["username"];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid login. Try again.";
        }
    }
}

require "header.php";
?>

<section class="card card--narrow">
  <h1 class="h1">Admin Login</h1>

  <?php if ($error !== ""): ?>
    <div class="alert alert--danger"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="POST" class="form" novalidate>
    <label class="label">Username</label>
    <input class="input" type="text" name="username" required />

    <label class="label">Password</label>
    <input class="input" type="password" name="password" required />

    <button class="btn" type="submit">Login</button>

    <p class="muted small">Only admins can add, update, or delete books.</p>
  </form>
</section>

<?php require "footer.php"; ?>
