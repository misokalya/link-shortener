<?php
include "config/db.php";

$code = $_GET['code'];

$stmt = $conn->prepare("SELECT original_url FROM links WHERE short_code=?");
$stmt->bind_param("s",$code);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    header("Location: ".$row['original_url']);
} else {
    echo "Invalid link.";
}
