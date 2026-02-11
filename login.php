<?php
include "config/db.php";
include "includes/header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];

            if ($user['role'] == 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        }
    }

    $error = "Invalid credentials!";
}
?>

<div class="flex justify-center items-center h-screen">
<form method="POST" class="bg-white text-black p-8 rounded-xl w-96 shadow-2xl animate-fadeIn">

    <h2 class="text-2xl mb-4 text-[#d43d26]">Login</h2>

    <?php if(isset($error)) echo "<p class='text-red-500 mb-3'>$error</p>"; ?>

    <input type="email" name="email" required placeholder="Email"
           class="w-full p-2 mb-3 border rounded">

    <input type="password" name="password" required placeholder="Password"
           class="w-full p-2 mb-4 border rounded">

    <button class="btn-primary w-full py-2 rounded text-white">
        <i class="fa-solid fa-right-to-bracket"></i> Login
    </button>
</form>
</div>

<?php include "includes/footer.php"; ?>
