<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_pengajian";

$koneksi = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) die("Koneksi gagal: " . mysqli_connect_error());

$q = mysqli_query($koneksi, "SELECT * FROM users WHERE username='admin'");
$user = mysqli_fetch_assoc($q);

if (!$user) {
    die("<h2>❌ User 'admin' TIDAK ADA di database!</h2>");
}

echo "<h2>Data admin dari database:</h2>";
echo "Username: <b>" . $user['username'] . "</b><br>";
echo "Hash: <code>" . $user['password'] . "</code><br><br>";

// Test beberapa password
$kandidat = ['admin123', 'admin', 'Admin123', 'password', '123456'];

echo "<h2>Cek password mana yang cocok:</h2>";
foreach ($kandidat as $p) {
    $cocok = password_verify($p, $user['password']);
    $status = $cocok ? "✅ COCOK" : "❌ tidak cocok";
    echo "Password <code>'$p'</code> → <b>$status</b><br>";
}

// Kalau tidak ada yang cocok, tampilkan hash baru untuk 'admin123'
echo "<hr>";
echo "<h2>Solusi: Update hash di database</h2>";
$hash_baru = password_hash('admin123', PASSWORD_DEFAULT);
echo "Copy hash baru ini:<br>";
echo "<textarea rows='3' cols='80'>$hash_baru</textarea><br><br>";
echo "Lalu jalankan di HeidiSQL:<br>";
echo "<code>UPDATE users SET password = '$hash_baru' WHERE username='admin';</code>";
?>