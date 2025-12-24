<?php
// Protect admin-only pages
session_start();
if (!isset($_SESSION["admin_username"])) {
    header("Location: login.php");
    exit;
}
?>