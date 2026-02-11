<?php
include "../config/db.php";
include "../includes/auth.php";

requireAdmin();

$id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM links WHERE id=?");
$stmt->bind_param("i",$id);
$stmt->execute();

header("Location: dashboard.php");
exit();
