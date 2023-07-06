<?php
// Mulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect pengguna ke halaman login atau halaman lain yang sesuai setelah logout
header("Location: loginapotek.php");
exit();
?>
