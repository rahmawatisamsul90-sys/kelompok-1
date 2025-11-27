<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Beranda - Aplikasi Data Hijab</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    body{
        margin:0;
        font-family:Arial;
        background:#eef1f7;
    }

    /* SIDEBAR */
    .sidebar{
        width:230px;
        height:100vh;
        background:#1e2a38;
        position:fixed;
        left:0;
        top:0;
        padding-top:20px;
        color:white;
    }

    .sidebar h2{
        text-align:center;
        margin-bottom:20px;
        font-size:24px;
    }

    .sidebar a{
        display:block;
        padding:12px 20px;
        text-decoration:none;
        color:#cfd8dc;
        font-size:16px;
    }

    .sidebar a:hover{
        background:#263445;
        color:white;
    }

    .submenu{
        padding-left:35px;
        background:#2a3b4d;
    }

    /* NAVBAR */
    .navbar{
        margin-left:230px;
        height:60px;
        background:#2196F3;
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:0 20px;
        color:white;
    }

    /* CONTENT */
    .content{
        margin-left:250px;
        padding:20px;
    }

    .card{
        width:230px;
        height:130px;
        border-radius:8px;
        padding:15px;
        color:white;
        display:inline-block;
        margin:10px;
        position:relative;
    }

    .card i{
        position:absolute;
        right:10px;
        top:10px;
        font-size:45px;
        opacity:0.3;
    }

    .card .angka{
        font-size:30px;
        font-weight:bold;
    }

    .card .judul{
        font-size:17px;
        margin-top:5px;
        font-weight:bold;
    }

    .card a{
        position:absolute;
        bottom:10px;
        right:10px;
        color:white;
        font-size:20px;
    }

    /* CARD COLORS */
    .blue{ background:#03A9F4; }
    .green{ background:#4CAF50; }
    .pink{ background:#E91E63; }
    .orange{ background:#FF9800; }
    .red{ background:#F44336; }
    .yellow{ background:#FBC02D; }

</style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>FEBRILANI HIJAB</h2>

    <a href="beranda.php"><i class="fa fa-home"></i> Beranda</a>

    <a href="data_barang.php"><i class="fa fa-box"></i> Data Barang</a>
    <a href="kategori.php"><i class="fa fa-tags"></i> Kategori Barang</a>
    <a href="barang_masuk.php"><i class="fa fa-download"></i> Data Barang Masuk</a>
    <a href="barang_keluar.php"><i class="fa fa-upload"></i> Data Barang Keluar</a>

    <a href="#"><i class="fa fa-file"></i> Laporan</a>
    <div class="submenu">
        <a href="laporan_stok.php">Laporan Stok</a>
    </div>

    <a href="profil.php"><i class="fa fa-user"></i> Profil</a>
    <a href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
</div>

<!-- NAVBAR -->
<div class="navbar">
    <div style="font-size:20px;">
        <i class="fa fa-home"></i> Beranda
    </div>
    <div>
        <i class="fa fa-user-circle"></i> Admin
    </div>
</div>

<!-- CONTENT -->
<div class="content">

    <div style="padding:15px; background:white; border-radius:5px; margin-bottom:20px;">
        Selamat Datang di Aplikasi Penginputan Data Hijab
    </div>

    <!-- CARD MENU -->
    <div class="card blue">
        <i class="fa fa-box"></i>
        <div class="angka">4</div>
        <div class="judul">Data Barang</div>
        <a href="data_barang.php">+</a>
    </div>

    <div class="card green">
        <i class="fa fa-download"></i>
        <div class="angka">4</div>
        <div class="judul">Data Barang Masuk</div>
        <a href="barang_masuk.php">+</a>
    </div>

    <div class="card pink">
        <i class="fa fa-upload"></i>
        <div class="angka">3</div>
        <div class="judul">Data Barang Keluar</div>
        <a href="barang_keluar.php">+</a>
    </div>

    <div class="card orange">
        <i class="fa fa-file"></i>
        <div class="angka">4</div>
        <div class="judul">Laporan Stok</div>
        <a href="laporan_stok.php"><i class="fa fa-print"></i></a>
    </div>

</div>

</body>
</html>