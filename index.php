<?php
$pageTitle = "Home - Library";
require "config.php";
require "header.php";

// Public view: only Available books
$stmt = $conn->prepare("SELECT id, title, author, category, status, created_at FROM books WHERE status='Available' ORDER BY id DESC");
$stmt->execute();
$result = $stmt->get_result();
$books = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<section class="card">
  <div class="card__head">
    <h1 class="h1">Available Books</h1>
    <div class="search">
      <input id="searchBox" class="input" type="text" placeholder="Search by title / author / category" />
    </div>
  </div>

  <div class="tableWrap">
    <table class="table" id="booksTable">
      <thead>
        <tr>
          <th>Title</th>
          <th>Author</th>
          <th>Category</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($books) === 0): ?>
          <tr><td colspan="4" class="muted">No available books found.</td></tr>
        <?php else: ?>
          <?php foreach ($books as $b): ?>
            <tr>
              <td class="cellTitle"><?php echo htmlspecialchars($b["title"]); ?></td>
              <td><?php echo htmlspecialchars($b["author"]); ?></td>
              <td><?php echo htmlspecialchars($b["category"]); ?></td>
              <td><span class="pill pill--ok"><?php echo htmlspecialchars($b["status"]); ?></span></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</section>

<?php require "footer.php"; ?>
