<?php
session_start(); // Memulai sesi untuk mengelola login
$message = ''; // Variabel untuk menyimpan pesan kesalahan atau informasi lainnya

// Jika form dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Contoh data pengguna yang sudah terdaftar
    $valid_username = "user123";
    $valid_password = "pass123";

    // Pemeriksaan login
    if ($username == $valid_username && $password == $valid_password) {
        // Set sesi untuk mengidentifikasi pengguna yang login
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;

        // Set cookie jika diperlukan (misalnya untuk mengingat pengguna selama 7 hari)
        setcookie("remember_me", $username, time() + (7 * 24 * 60 * 60), "/");

        // Redirect ke halaman lain jika login sukses (misalnya halaman beranda)
        header("Location: welcome.php");
        exit();
    } else {
        // Jika gagal login, berikan pesan kesalahan
        $message = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link rel="icon" href="assets/icon.png" />
    <link rel="stylesheet" href="css/ln.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
<div class="login-container">
    <h2>Login ke Chuncheon Dakgalbi</h2>
    <form id="login-form" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <div class="form-group">
            <input type="text" id="username" name="username" required />
            <label for="username">Username</label>
        </div>
        <div class="form-group">
            <input type="password" id="password" name="password" required />
            <label for="password">Password</label>
        </div>

        <button type="submit" class="login-button">Login</button>

        <?php
        if (!empty($message)) {
            echo "<p class='error-message'>$message</p>";
        }
        ?>

        <p class="form-footer">
            Tidak punya akun? <a href="register.php">Daftar</a>
        </p>
    </form>
</div>
</body>
</html>
