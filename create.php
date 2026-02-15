<?php
include "config/db.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

function generateCode($length = 5) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, $length);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $original = $_POST['url'];
    $short = generateCode();
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO links (user_id,original_url,short_code) VALUES (?,?,?)");
    $stmt->bind_param("iss",$user_id,$original,$short);
    $stmt->execute();
}

header("Location: dashboard.php");
