<?php
include "config/db.php";
include "includes/header.php";
include "includes/auth.php";

requireLogin();

$user_id = $_SESSION['user_id'];

// 🔴 IMPORTANT: change to your real domain
$BASE_URL = "https://miso.ct.ws";

$stmt = $conn->prepare("SELECT * FROM links WHERE user_id=? ORDER BY id DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container mx-auto px-4 py-10 animate-fadeIn">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <h2 class="text-3xl font-bold text-[#02021f]">
            <i class="fa-solid fa-chart-line"></i> My Links
        </h2>

        <a href="logout.php"
           class="border border-[#02021f] px-4 py-2 rounded-lg hover:bg-[#02021f] hover:text-white transition">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>

    <!-- Create Form -->
    <form action="create.php" method="POST"
          class="mb-8 flex flex-col md:flex-row gap-3">

        <input type="url" name="url"
               placeholder="Enter URL to shorten..."
               required
               class="flex-1 p-3 rounded-lg text-black focus:outline-none">

        <button class="btn-primary px-6 py-3 rounded-lg text-white whitespace-nowrap">
            <i class="fa-solid fa-plus"></i> Shorten
        </button>
    </form>

    <!-- Links Table -->
    <div class="bg-white text-black rounded-2xl shadow-xl overflow-hidden">

        <?php if ($result->num_rows > 0): ?>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-100">
                    <tr class="text-left">
                        <th class="p-4">Original URL</th>
                        <th class="p-4">Short Link</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php while($row = $result->fetch_assoc()): 
                    $shortUrl = $BASE_URL . "/" . htmlspecialchars($row['short_code']);
                ?>
                    <tr class="border-t hover:bg-gray-50 transition">

                        <!-- Original URL -->
                        <td class="p-4 max-w-xs truncate">
                            <?php echo htmlspecialchars($row['original_url']); ?>
                        </td>

                        <!-- Short URL -->
                        <td class="p-4">
                            <div class="flex items-center gap-2 flex-wrap">

                                <a href="<?php echo $shortUrl; ?>"
                                   target="_blank"
                                   class="text-[#d43d26] font-semibold hover:underline break-all">
                                    <?php echo $shortUrl; ?>
                                </a>

                                <!-- Copy Button -->
                                <button onclick="copyLink('<?php echo $shortUrl; ?>')"
                                        class="text-gray-600 hover:text-black transition"
                                        title="Copy link">
                                    <i class="fa-solid fa-copy"></i>
                                </button>

                            </div>
                        </td>

                        <!-- Actions -->
                        <td class="p-4 text-center whitespace-nowrap">

                            <a href="edit.php?id=<?php echo $row['id']; ?>"
                               class="text-blue-600 hover:text-blue-800 mr-3 transition"
                               title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <a href="delete.php?id=<?php echo $row['id']; ?>"
                               onclick="return confirm('Delete this link?')"
                               class="text-red-600 hover:text-red-800 transition"
                               title="Delete">
                                <i class="fa-solid fa-trash"></i>
                            </a>

                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>

            </table>
        </div>

        <?php else: ?>

        <!-- Empty State -->
        <div class="text-center py-16">
            <i class="fa-solid fa-link text-4xl text-gray-400 mb-4"></i>
            <p class="text-gray-500">No links yet. Create your first short link!</p>
        </div>

        <?php endif; ?>

    </div>
</div>

<!-- Copy Script -->
<script>
function copyLink(link) {
    navigator.clipboard.writeText(link).then(() => {
        alert("Link copied!");
    });
}
</script>

<?php include "includes/footer.php"; ?>
