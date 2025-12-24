<?php
$pageTitle = "Dashboard";
require "auth.php";
require "config.php";
require "header.php";

// fetch all books
$stmt = $conn->prepare("SELECT id, title, author, category, status, created_at FROM books ORDER BY id DESC");
$stmt->execute();
$res = $stmt->get_result();
$books = $res->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<section class="card">
  <div class="card__head">
    <div>
      <h1 class="h1">Dashboard</h1>
      <p class="muted small">Logged in as <b><?php echo htmlspecialchars($_SESSION["admin_username"]); ?></b></p>
    </div>
    <div class="actions">
      <a class="btn" href="add_book.php">+ Add Book</a>
      <a class="btn btn--ghost" href="contact.php">Contact</a>
    </div>
  </div>

  <div class="tableWrap">
    <table class="table" id="adminBooksTable">
      <thead>
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Category</th>
          <th>Status</th>
          <th class="right">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($books) === 0): ?>
          <tr><td colspan="5" class="muted">No books found.</td></tr>
        <?php else: ?>
          <?php foreach ($books as $b): ?>
            <tr>
              <td class="cellTitle"><?php echo htmlspecialchars($b["title"]); ?></td>
              <td><?php echo htmlspecialchars($b["author"]); ?></td>
              <td><?php echo htmlspecialchars($b["category"]); ?></td>
              <td>
                <?php if ($b["status"] === "Available"): ?>
                  <span class="pill pill--ok">Available</span>
                <?php else: ?>
                  <span class="pill pill--warn">Issued</span>
                <?php endif; ?>
              </td>
              <td class="right">
                <a class="btn btn--ghost" href="edit_book.php?id=<?php echo (int)$b["id"]; ?>">Edit</a>
                <a class="btn btn--danger" href="delete_book.php?id=<?php echo (int)$b["id"]; ?>" onclick="return confirmDelete();">Delete</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</section>

<?php require "footer.php"; ?>
