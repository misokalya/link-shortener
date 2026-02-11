<?php
include "../config/db.php";
include "../includes/header.php";
include "../includes/auth.php";

requireAdmin();

$result = $conn->query("
SELECT users.id as user_id, users.email, links.id as link_id,
links.original_url, links.short_code
FROM users
LEFT JOIN links ON users.id = links.user_id
ORDER BY users.id DESC
");
?>

<div class="container mx-auto p-8">

<h2 class="text-3xl text-[#d43d26] mb-6">
    <i class="fa-solid fa-user-shield"></i> Admin Panel
</h2>

<div class="bg-white text-black rounded-xl p-6 shadow-lg">
<table class="w-full text-sm">

<tr class="border-b font-bold">
    <th>User</th>
    <th>Original URL</th>
    <th>Short Code</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>
<tr class="border-b hover:bg-gray-100 transition">

<td><?php echo $row['email']; ?></td>
<td><?php echo $row['original_url']; ?></td>
<td><?php echo $row['short_code']; ?></td>

<td>
<?php if($row['link_id']) { ?>
<a href="delete_link.php?id=<?php echo $row['link_id']; ?>"
   class="text-red-600">
   <i class="fa-solid fa-trash"></i>
</a>
<?php } ?>
</td>

</tr>
<?php } ?>

</table>
</div>
</div>

<?php include "../includes/footer.php"; ?>
