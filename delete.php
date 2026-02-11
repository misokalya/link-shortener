<?php
include "config/db.php";
include "includes/auth.php";

requireLogin();

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("DELETE FROM links WHERE id=? AND user_id=?");
$stmt->bind_param("ii",$id,$user_id);
$stmt->execute();

header("Location: dashboard.php");
exit();
