<?php
include 'auth.php';
include 'config/koneksi.php';

$total_jamaah = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as j FROM jamaah WHERE status='aktif'"))['j'];
$total_jadwal = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as j FROM jadwal"))['j'];
$kas_masuk    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COALESCE(SUM(jumlah),0) as t FROM kas WHERE jenis='masuk'"))['t'];
$kas_keluar   = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COALESCE(SUM(jumlah),0) as t FROM kas WHERE jenis='keluar'"))['t'];
$saldo        = $kas_masuk - $kas_keluar;

include 'includes/header.php';
include 'includes/sidebar.php';
?>
<h2>Dashboard</h2>
<p>Selamat datang, <b><?= $_SESSION['nama'] ?></b></p>

<div class="row mt-4">
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h6>Jamaah Aktif</h6>
                <h2><?= $total_jamaah ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h6>Total Jadwal</h6>
                <h2><?= $total_jadwal ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h6>Kas Masuk</h6>
                <h2>Rp <?= number_format($kas_masuk,0,',','.') ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h6>Saldo Kas</h6>
                <h2>Rp <?= number_format($saldo,0,',','.') ?></h2>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>