<?php
include "config/db.php";
include "includes/header.php";
include "includes/auth.php";

requireLogin();

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM links WHERE id=? AND user_id=?");
$stmt->bind_param("ii",$id,$user_id);
$stmt->execute();
$result = $stmt->get_result();
$link = $result->fetch_assoc();

if (!$link) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_url = $_POST['url'];

    $stmt = $conn->prepare("UPDATE links SET original_url=? WHERE id=?");
    $stmt->bind_param("si",$new_url,$id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<div class="flex justify-center items-center h-screen">
<form method="POST" class="bg-white text-black p-8 rounded-xl w-96 shadow-xl">

    <h2 class="text-2xl text-[#d43d26] mb-4">
        <i class="fa-solid fa-pen"></i> Edit Link
    </h2>

    <input type="url" name="url"
           value="<?php echo $link['original_url']; ?>"
           required class="w-full p-2 mb-4 border rounded">

    <button class="btn-primary w-full py-2 rounded text-white">
        Update
    </button>
</form>
</div>

<?php include "includes/footer.php"; ?>
