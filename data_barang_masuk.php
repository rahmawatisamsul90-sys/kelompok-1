<?php
$koneksi = mysqli_connect("localhost", "root", "", "dbhijab");
if(!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}

/* =======================
   SIMPAN DATA
======================= */
if(isset($_POST['simpan'])){

    if(empty($_POST['id_masuk'])){
        $q = mysqli_query($koneksi,"SELECT MAX(id_masuk) AS maxid FROM tbl_pemasukan");
        $d = mysqli_fetch_assoc($q);
        $urut = ($d['maxid']) ? (int)substr($d['maxid'],1)+1 : 1;
        $id_masuk = "M".sprintf("%03d",$urut);
    } else {
        $id_masuk = $_POST['id_masuk'];
    }

    $id_barang = $_POST['id_barang'];
    $jumlah = $_POST['jumlah'];
    $tanggal = $_POST['tanggal_masuk'];
    $keterangan = $_POST['keterangan'];

    mysqli_query($koneksi,"INSERT INTO tbl_pemasukan
        VALUES ('$id_masuk','$id_barang','$tanggal','$jumlah','$keterangan')
    ");

    header("Location: data_barang_masuk.php");
    exit;
}

/* =======================
   HAPUS DATA
======================= */
if(isset($_GET['hapus'])){
    mysqli_query($koneksi,"DELETE FROM tbl_pemasukan WHERE id_masuk='$_GET[hapus]'");
    header("Location: data_barang_masuk.php");
    exit;
}

$dataMasuk = mysqli_query($koneksi,"SELECT * FROM tbl_pemasukan ORDER BY id_masuk ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Barang Masuk</title>

<style>
body {font-family: Arial; background:#eef1f7; margin:0; padding:20px;}
.container {background:#fff; padding:20px; border-radius:10px; max-width:1100px; margin:auto; box-shadow:0 3px 10px rgba(0,0,0,0.1);}
table {width:100%; border-collapse:collapse; margin-top:20px;}
th, td {border:1px solid #999; padding:10px;}
th {background:#f0f0f0;}
.btn {
    padding:10px 20px;
    background:#28a745;
    color:#fff;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-weight:bold;
}
.btn:hover {background:#218838;}
.action a {margin-right:10px; font-weight:bold;}
.hapus {color:#e74c3c;}
.navbar {
    display:flex;
    justify-content:center;
    background:#2c3e50;
    padding:12px 0;
    margin:20px 0;
    border-radius:6px;
    gap:10px;
}
.navbar a {
    color:#ecf0f1;
    padding:10px 20px;
    text-decoration:none;
    font-weight:bold;
    border-radius:4px;
}
.navbar a.active {background:#fff; color:#2c3e50;}

.modal {
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.4);
    justify-content:center;
    align-items:center;
}
.modal-content {
    background:#fff;
    padding:25px;
    width:420px;
    border-radius:12px;
}

.form-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px 15px;
}
.form-grid .full{grid-column:1/3;}
.form-grid label{font-weight:bold;}
.form-grid input{width:100%; padding:8px;}
</style>
</head>

<body>

<div class="container">
<h2>Data Barang Masuk</h2>

<div class="navbar">
    <a href="beranda.php">Beranda</a>
    <a href="data_barang.php">Data Barang</a>
    <a href="kategori.php">Kategori Barang</a>
    <a href="data_barang_masuk.php" class="active">Data Barang Masuk</a>
    <a href="data_barang_keluar.php">Data Barang Keluar</a>
    <a href="laporan.php">Laporan</a>
</div>

<button class="btn" id="btnTambah">+ Tambah Barang Masuk</button>

<table>
<thead>
<tr>
<th>No</th>
<th>Id Masuk</th>
<th>Id Barang</th>
<th>Jumlah</th>
<th>Tanggal</th>
<th>Keterangan</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php $no=1; while($r=mysqli_fetch_assoc($dataMasuk)): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $r['id_masuk'] ?></td>
<td><?= $r['id_barang'] ?></td>
<td><?= $r['jumlah'] ?></td>
<td><?= $r['tanggal_masuk'] ?></td>
<td><?= $r['keterangan'] ?></td>
<td class="action">
<a href="?hapus=<?= $r['id_masuk'] ?>" class="hapus"
onclick="return confirm('Hapus data?')">Hapus</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<div class="modal" id="modal">
<form method="POST" class="modal-content">
<h3>Tambah Barang Masuk</h3>

<div class="form-grid">
<div>
<label>Id Masuk</label>
<input type="text" name="id_masuk" placeholder="Otomatis">
</div>

<div>
<label>Id Barang</label>
<input type="text" name="id_barang" required>
</div>

<div>
<label>Jumlah</label>
<input type="number" name="jumlah" required>
</div>

<div>
<label>Tanggal Masuk</label>
<input type="date" name="tanggal_masuk" required>
</div>

<div class="full">
<label>Keterangan</label>
<input type="text" name="keterangan">
</div>

<div class="full" style="text-align:right;">
<button type="submit" name="simpan" class="btn">Simpan</button>
</div>
</div>
</form>
</div>

<script>
const modal = document.getElementById("modal");
document.getElementById("btnTambah").onclick=()=>modal.style.display="flex";
window.onclick=e=>{if(e.target==modal)modal.style.display="none";}
</script>

</body>
</html>
