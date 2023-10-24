<?php
// Koneksi ke database (gunakan koneksi.php atau sesuaikan dengan konfigurasi Anda)
include 'database.php';

// Ambil data dari formulir registrasi
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$nama = $_POST['nama'];

// Lakukan validasi data jika diperlukan

// Query untuk memasukkan data ke tabel user
$query = "INSERT INTO userregister (Username, Email, Password, Nama)
          VALUES ('$username', '$email', '$password', '$nama')";

if (mysqli_query($conn, $query)) {
    // Registrasi berhasil, arahkan pengguna ke halaman loginuser.php
    header('location: login.php');
    exit; // Pastikan untuk menghentikan eksekusi kode setelah mengarahkan pengguna
} else {
    echo "Registrasi gagal. Silakan coba lagi.";
}
?>
