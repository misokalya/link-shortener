<?php
include "config/db.php";
include "includes/header.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = trim($_POST['phone']);

    // Check passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {

        // Check if email already exists
        $check = $conn->prepare("SELECT id FROM users WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Email already registered.";
        } else {

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (email,password,phone) VALUES (?,?,?)");
            $stmt->bind_param("sss",$email,$hashed,$phone);
            $stmt->execute();

            header("Location: login.php");
            exit();
        }
    }
}
?>

<div class="flex justify-center items-center h-screen">
<form method="POST"
      class="bg-white text-black p-8 rounded-xl w-96 shadow-2xl animate-fadeIn">

    <h2 class="text-2xl mb-4 text-[#d43d26]">
        <i class="fa-solid fa-user-plus"></i> Create Account
    </h2>

    <?php if($error): ?>
        <p class="text-red-500 mb-3"><?php echo $error; ?></p>
    <?php endif; ?>

    <input type="email" name="email" required placeholder="Email"
           class="w-full p-2 mb-3 border rounded">

    <input type="text" name="phone" required placeholder="Phone Number"
           class="w-full p-2 mb-3 border rounded">

    <input type="password" name="password" id="password"
           required placeholder="Password"
           class="w-full p-2 mb-3 border rounded">

    <input type="password" name="confirm_password" id="confirm_password"
           required placeholder="Repeat Password"
           class="w-full p-2 mb-2 border rounded">

    <p id="matchMessage" class="text-sm mb-3"></p>

    <button class="btn-primary w-full py-2 rounded text-white">
        Register
    </button>

</form>
</div>

<script>
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirm_password');
const message = document.getElementById('matchMessage');

function checkPasswordMatch() {
    if (confirmPassword.value === "") {
        message.textContent = "";
        return;
    }

    if (password.value === confirmPassword.value) {
        message.textContent = "Passwords match ✔";
        message.classList.remove("text-red-500");
        message.classList.add("text-green-600");
    } else {
        message.textContent = "Passwords do not match ✖";
        message.classList.remove("text-green-600");
        message.classList.add("text-red-500");
    }
}

password.addEventListener('keyup', checkPasswordMatch);
confirmPassword.addEventListener('keyup', checkPasswordMatch);
</script>

<?php include "includes/footer.php"; ?>
