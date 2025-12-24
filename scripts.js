// ===== Helper: Delete Confirm =====
function confirmDelete() {
  return confirm("Are you sure you want to delete this book?");
}

// ===== Book Form Validation =====
function validateBookForm() {
  const title = document.getElementById("title")?.value.trim();
  const author = document.getElementById("author")?.value.trim();
  const category = document.getElementById("category")?.value.trim();
  const notes = document.getElementById("notes")?.value ?? "";

  if (!title || !author || !category) {
    alert("Please fill all required fields (Title, Author, Category).");
    return false;
  }
  if (notes.length > 200) {
    alert("Notes must be within 200 characters.");
    return false;
  }
  return true;
}

// ===== Contact Form Validation =====
function validateContactForm() {
  const msg = document.getElementById("cmessage")?.value ?? "";
  if (msg.trim().length === 0) {
    alert("Message is required.");
    return false;
  }
  if (msg.length > 120) {
    alert("Message must be within 120 characters.");
    return false;
  }
  return true;
}

// ===== DOM Counters =====
document.addEventListener("DOMContentLoaded", () => {
  const notes = document.getElementById("notes");
  const notesCount = document.getElementById("notesCount");
  if (notes && notesCount) {
    const updateNotesCount = () => (notesCount.textContent = String(notes.value.length));
    notes.addEventListener("input", updateNotesCount);
    updateNotesCount();
  }

  const msg = document.getElementById("cmessage");
  const msgCount = document.getElementById("msgCount");
  if (msg && msgCount) {
    const updateMsgCount = () => (msgCount.textContent = String(msg.value.length));
    msg.addEventListener("input", updateMsgCount);
    updateMsgCount();
  }

  // ===== Instant Search Filter (Public Home) =====
  const searchBox = document.getElementById("searchBox");
  const table = document.getElementById("booksTable");
  if (searchBox && table) {
    searchBox.addEventListener("input", () => {
      const q = searchBox.value.toLowerCase();
      const rows = table.querySelectorAll("tbody tr");
      rows.forEach((row) => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(q) ? "" : "none";
      });
    });
  }
});
