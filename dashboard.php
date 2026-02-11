<?php
include "config/db.php";
include "includes/header.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM links WHERE user_id=$user_id ORDER BY id DESC");
?>

<div class="container mx-auto p-8">

<h2 class="text-3xl text-[#02021f] mb-6">
    <i class="fa-solid fa-chart-line"></i> My Links
</h2>

<form action="create.php" method="POST" class="mb-6 flex gap-3">
    <input type="url" name="url" placeholder="Enter URL..." required class="flex-1 p-2 rounded text-black">
    <button class="btn-primary px-6 rounded text-white">
        <i class="fa-solid fa-plus"></i>
    </button>
</form>

<div class="bg-white text-black rounded-lg shadow-lg p-6">
<table class="w-full">
<tr class="border-b font-bold">
    <th>Original URL</th>
    <th>Short Link</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr class="border-b hover:bg-gray-100 transition">
    <td class="p-2"><?php echo $row['original_url']; ?></td>
    <td>
        <a href="redirect.php?code=<?php echo $row['short_code']; ?>" class="text-[#d43d26]">
            <?php echo $row['short_code']; ?>
        </a>
    </td>
    <td>
        <a href="edit.php?id=<?php echo $row['id']; ?>" class="text-blue-600 mr-3">
            <i class="fa-solid fa-pen"></i>
        </a>
        <a href="delete.php?id=<?php echo $row['id']; ?>" class="text-red-600">
            <i class="fa-solid fa-trash"></i>
        </a>
    </td>
</tr>
<?php } ?>

</table>
</div>

</div>

<?php include "includes/footer.php"; ?>
