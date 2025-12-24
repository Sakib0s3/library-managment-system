<?php
$pageTitle = "Add Book";
require "auth.php";
require "config.php";

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST["title"] ?? "");
    $author = trim($_POST["author"] ?? "");
    $category = trim($_POST["category"] ?? "");
    $status = $_POST["status"] ?? "Available";
    $notes = trim($_POST["notes"] ?? "");

    if ($title === "" || $author === "" || $category === "") {
        $error = "Please fill all required fields.";
    } elseif (strlen($notes) > 200) {
        $error = "Notes must be within 200 characters.";
    } else {
        $stmt = $conn->prepare("INSERT INTO books (title, author, category, status, notes) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $author, $category, $status, $notes);
        $stmt->execute();
        $stmt->close();
        header("Location: dashboard.php");
        exit;
    }
}

require "header.php";
?>

<section class="card card--narrow">
  <h1 class="h1">Add Book</h1>

  <?php if ($error !== ""): ?>
    <div class="alert alert--danger"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="POST" class="form" onsubmit="return validateBookForm();">
    <label class="label">Title <span class="req">*</span></label>
    <input class="input" id="title" name="title" type="text" required />

    <label class="label">Author <span class="req">*</span></label>
    <input class="input" id="author" name="author" type="text" required />

    <label class="label">Category <span class="req">*</span></label>
    <input class="input" id="category" name="category" type="text" required />

    <label class="label">Status</label>
    <select class="input" name="status">
      <option value="Available">Available</option>
      <option value="Issued">Issued</option>
    </select>

    <label class="label">Notes <span class="muted small">(max 200)</span></label>
    <textarea class="input textarea" id="notes" name="notes" rows="4" maxlength="200"></textarea>
    <div class="muted small right"><span id="notesCount">0</span>/200</div>

    <button class="btn" type="submit">Save</button>
    <a class="btn btn--ghost" href="dashboard.php">Cancel</a>
  </form>
</section>

<?php require "footer.php"; ?>
