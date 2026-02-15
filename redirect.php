<?php
include "config/db.php";

if (!isset($_GET['code'])) {
    header("Location: index.php");
    exit();
}

$code = $_GET['code'];

$stmt = $conn->prepare("SELECT original_url FROM links WHERE short_code=? LIMIT 1");
$stmt->bind_param("s",$code);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {

    // Ensure proper protocol
    $url = $row['original_url'];
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "https://" . $url;
    }

    header("Location: " . $url);
    exit();

} else {
    echo "Invalid short link.";
}

