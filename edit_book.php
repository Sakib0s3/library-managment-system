<?php
$pageTitle = "Edit Book";
require "auth.php";
require "config.php";

$id = (int)($_GET["id"] ?? 0);
if ($id <= 0) {
    header("Location: dashboard.php");
    exit;
}

// fetch book
$stmt = $conn->prepare("SELECT id, title, author, category, status, notes FROM books WHERE id=? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$book = $res->fetch_assoc();
$stmt->close();

if (!$book) {
    header("Location: dashboard.php");
    exit;
}

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
        $stmt = $conn->prepare("UPDATE books SET title=?, author=?, category=?, status=?, notes=? WHERE id=?");
        $stmt->bind_param("sssssi", $title, $author, $category, $status, $notes, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: dashboard.php");
        exit;
    }
}

require "header.php";
?>

<section class="card card--narrow">
  <h1 class="h1">Edit Book</h1>

  <?php if ($error !== ""): ?>
    <div class="alert alert--danger"><?php echo htmlspecialchars($error); ?></div>
  <?php endif; ?>

  <form method="POST" class="form" onsubmit="return validateBookForm();">
    <label class="label">Title <span class="req">*</span></label>
    <input class="input" id="title" name="title" type="text" value="<?php echo htmlspecialchars($book["title"]); ?>" required />

    <label class="label">Author <span class="req">*</span></label>
    <input class="input" id="author" name="author" type="text" value="<?php echo htmlspecialchars($book["author"]); ?>" required />

    <label class="label">Category <span class="req">*</span></label>
    <input class="input" id="category" name="category" type="text" value="<?php echo htmlspecialchars($book["category"]); ?>" required />

    <label class="label">Status</label>
    <select class="input" name="status">
      <option value="Available" <?php echo ($book["status"] === "Available") ? "selected" : ""; ?>>Available</option>
      <option value="Issued" <?php echo ($book["status"] === "Issued") ? "selected" : ""; ?>>Issued</option>
    </select>

    <label class="label">Notes <span class="muted small">(max 200)</span></label>
    <textarea class="input textarea" id="notes" name="notes" rows="4" maxlength="200"><?php echo htmlspecialchars($book["notes"] ?? ""); ?></textarea>
    <div class="muted small right"><span id="notesCount"><?php echo strlen($book["notes"] ?? ""); ?></span>/200</div>

    <button class="btn" type="submit">Update</button>
    <a class="btn btn--ghost" href="dashboard.php">Cancel</a>
  </form>
</section>

<?php require "footer.php"; ?>
