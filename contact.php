<?php
$pageTitle = "Contact";
require "auth.php";
require "config.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "" || $email === "" || $message === "") {
        $error = "Please fill all fields.";
    } elseif (strlen($message) > 120) {
        $error = "Message must be within 120 characters.";
    } else {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        $stmt->execute();
        $stmt->close();
        $success = "Message submitted successfully.";
    }
}

require "header.php";
?>

<section class="card card--narrow">
  <h1 class="h1">Contact</h1>

  <?php if ($success !== ""): ?>
    <div class="alert alert--success"><?php echo htmlspecialchars($success); ?></div>
  <?php endif; ?>

  <?php if ($error !== ""): ?>
    <div class="alert alert--danger"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="POST" class="form" onsubmit="return validateContactForm();">
    <label class="label">Name <span class="req">*</span></label>
    <input class="input" type="text" name="name" id="cname" required />

    <label class="label">Email <span class="req">*</span></label>
    <input class="input" type="email" name="email" id="cemail" required />

    <label class="label">Message <span class="req">*</span> <span class="muted small">(max 120)</span></label>
    <textarea class="input textarea" name="message" id="cmessage" maxlength="120" rows="4" required></textarea>
    <div class="muted small right"><span id="msgCount">0</span>/120</div>

    <button class="btn" type="submit">Send</button>
    <a class="btn btn--ghost" href="dashboard.php">Back</a>
  </form>
</section>

<?php require "footer.php"; ?>
