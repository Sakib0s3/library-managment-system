<?php
require "auth.php";
require "config.php";

$id = (int)($_GET["id"] ?? 0);
if ($id > 0) {
    $stmt = $conn->prepare("DELETE FROM books WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
header("Location: dashboard.php");
exit;
?>