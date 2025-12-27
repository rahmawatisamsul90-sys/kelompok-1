<?php
// ================== KONEKSI ==================
$conn = mysqli_connect("localhost","root","","dbhijab");
if(!$conn){ die("Koneksi gagal"); }

// ================== SIMPAN DATA ==================
if(isset($_POST['simpan'])){
    $nama = mysqli_real_escape_string($conn,$_POST['nama_kategori']);
    mysqli_query($conn,"INSERT INTO tbl_kategori VALUES(NULL,'$nama')");
    header("Location: kategori.php");
    exit;
}

// ================== UPDATE DATA ==================
if(isset($_POST['update'])){
    $id   = $_POST['id_kategori'];
    $nama = mysqli_real_escape_string($conn,$_POST['nama_kategori']);
    mysqli_query($conn,"UPDATE tbl_kategori SET nama_kategori='$nama' WHERE id_kategori='$id'");
    header("Location: kategori.php");
    exit;
}

// ================== HAPUS DATA ==================
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn,"DELETE FROM tbl_kategori WHERE id_kategori='$id'");
    header("Location: kategori.php");
    exit;
}

// ================== AMBIL DATA ==================
$data = mysqli_query($conn,"SELECT * FROM tbl_kategori ORDER BY id_kategori ASC");
;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kategori Barang - FEBRILANI HIJAB</title>

<style>
/* === CSS ASLI KAMU, TIDAK DIUBAH === */
body {font-family: Arial, sans-serif; background:#f0f2f5; margin:40px;}
.container {background:#fff; border:1px solid #ccc; border-radius:8px; padding:20px; box-shadow:0 4px 15px rgba(0,0,0,0.1); max-width:1100px; margin:0 auto;}
.header {font-weight:bold; font-size:20px; padding:12px 20px; border-bottom:2px solid #000;}

.navbar {display:flex; justify-content:center; background:#2c3e50; padding:12px 0; margin:20px 0; border-radius:6px; gap:10px; flex-wrap:wrap;}
.navbar a {color:#ecf0f1; padding:10px 20px; text-decoration:none; font-weight:bold; border-radius:4px;}
.navbar a:hover {background:#34495e;}
.navbar a.active {background:#fff; color:#2c3e50;}

table {width:100%; border-collapse:collapse; margin:20px 0;}
th, td {border:1px solid #999; padding:12px 10px; text-align:left;}
th {background:#f0f0f0; font-weight:bold;}
tr:nth-child(even) {background:#f9f9f9;}
tr:hover {background:#fffbe6;}

.action-buttons a {margin:0 8px; text-decoration:none; font-weight:bold;}
.edit-btn {color:#e67e22;}
.delete-btn {color:#e74c3c;}

.footer-actions {margin-top:20px; display:flex; justify-content:space-between; align-items:center;}
.btn-tambah {padding:12px 30px; background:#27ae60; color:white; border-radius:6px; font-weight:bold; text-decoration:none;}
.btn-tambah:hover {background:#219653;}

.search-box input {
    padding:10px;
    width:250px;
    border-radius:5px;
    border:1px solid #aaa;
}

.modal {display:none; position:fixed; z-index:1000; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;}
.modal-content {background:white; padding:30px; border-radius:10px; width:450px; max-width:90%; box-shadow:0 10px 30px rgba(0,0,0,0.3);}
.close {float:right; font-size:28px; cursor:pointer; color:#aaa;}
.close:hover {color:#000;}
input, button {width:100%; padding:10px; margin:10px 0; border:1px solid #ccc; border-radius:4px;}
button[type="submit"] {background:#27ae60; color:white; font-weight:bold; cursor:pointer;}
</style>
</head>

<body>

<div class="container">
<div class="header">Kategori Barang</div>

<div class="navbar">
<a href="beranda.php">Beranda</a>
<a href="data_barang.php">Data Barang</a>
<a href="kategori.php" class="active">Kategori Barang</a>
<a href="data_barang_masuk.php">Data Barang Masuk</a>
<a href="data_barang_keluar.php">Data Barang Keluar</a>
<a href="#">Laporan</a>
</div>

<div class="footer-actions">
<div class="search-box">
<input type="text" id="search" placeholder="Cari kategori...">
</div>
<a href="#" id="btnTambah" class="btn-tambah">+ Baru</a>
</div>

<table id="tabelKategori">
<thead>
<tr>
<th>No</th>
<th>ID Kategori</th>
<th>Nama Kategori</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
<?php $no=1; foreach($data as $row): ?>
<tr>
<td><?= $no++ ?></td>
<td><?= $row['id_kategori'] ?></td>
<td><?= $row['nama_kategori'] ?></td>
<td class="action-buttons">
<a href="#" class="edit-btn"
   onclick="editKategori('<?= $row['id_kategori'] ?>','<?= $row['nama_kategori'] ?>')">Edit</a>
<a href="?hapus=<?= $row['id_kategori'] ?>" class="delete-btn"
   onclick="return confirm('Hapus kategori ini?')">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

<!-- MODAL (MASIH MODAL YANG SAMA) -->
<div id="modalForm" class="modal">
<div class="modal-content">
<span class="close">×</span>
<h2 id="judulModal">Tambah Kategori</h2>

<form method="POST">
<input type="hidden" name="id_kategori" id="id_kategori">
<input type="text" name="nama_kategori" id="nama_kategori" placeholder="Nama Kategori" required>

<button type="submit" name="simpan" id="btnSimpan">Simpan</button>
<button type="submit" name="update" id="btnUpdate" style="display:none;">Simpan</button>
</form>
</div>
</div>

<script>
const modal = document.getElementById("modalForm");

document.getElementById("btnTambah").onclick = e => {
    e.preventDefault();
    document.getElementById("judulModal").innerText = "Tambah Kategori";
    document.getElementById("nama_kategori").value = "";
    document.getElementById("btnSimpan").style.display = "block";
    document.getElementById("btnUpdate").style.display = "none";
    modal.style.display = "flex";
};

document.querySelector(".close").onclick = () => modal.style.display = "none";
window.onclick = e => { if(e.target === modal) modal.style.display = "none"; };

function editKategori(id,nama){
    document.getElementById("judulModal").innerText = "Tambah Kategori";
    document.getElementById("id_kategori").value = id;
    document.getElementById("nama_kategori").value = nama;
    document.getElementById("btnSimpan").style.display = "none";
    document.getElementById("btnUpdate").style.display = "block";
    modal.style.display = "flex";
}

// SEARCH (ASLI KAMU)
document.getElementById("search").onkeyup = function(){
    let f = this.value.toLowerCase();
    document.querySelectorAll("#tabelKategori tbody tr").forEach(tr=>{
        tr.style.display = tr.cells[2].textContent.toLowerCase().includes(f) ? "" : "none";
    });
};
</script>

</body>
</html>
