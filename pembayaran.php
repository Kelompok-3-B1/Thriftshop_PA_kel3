<?php 
    session_start();

    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level']==""){
        header("location:login.php?pesan=gagal");
    }

    include 'db.php';   
    $kontak = mysqli_query($conn, "SELECT user_telp, user_email, user_address FROM tb_user WHERE id_user = 1");
    $a = mysqli_fetch_object($kontak);

    //mendapatkan id pembelian
    $idpem = $_GET['id'];
    $ambil = $conn->query("SELECT * FROM tb_pembelian WHERE id_pembelian ='$idpem'");
    $detpem = $ambil->fetch_assoc();

    //mendapat id pelanggan yang beli
    $id_pelanggan_beli = $detpem['id_user'];
    //mendapat id pelanggan yang login
    $id_pelanggan_login = $_SESSION['pelanggan']['id_user'];

    if ($id_pelanggan_login !== $id_pelanggan_beli){
        echo "<script>alert('id tidak sesuai');</script>";
        echo "<script>location='riwayat.php';</script>";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thrift Shop</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">    
    <link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="halaman_user.php">THRIFT SHOP</a></h1>
            <ul>
                <li><a href="produk_user.php">Produk</a></li>
                <li><a href="keranjang.php">Cart</a></li>
                <li><a href="checkout.php">Pemesanan</a></li>
                <li><a href="riwayat.php">Riwayat Pembelian</a></li>
                <li><a href="logout.php">Logout</a></li>

            </ul>
        </div>
    </header> 

    <!-- content -->
    <div class="section">
        <div class="container">
            <div class="box">
                <h4>Halo <b><?php echo $_SESSION['user']; ?>.</h4>
            </div>
        </div>  
    </div>

    <!-- riwayat -->
    <div class="section">
        <div class="container">
            <h2>Konfirmasi Pembayaran</h2>
            <div class="box">
                <p>Kirim Bukti Pembayaran Anda Disini</p>
                <div class="alert">Total Tagihan Anda <strong>Rp. <?php echo number_format($detpem['total_pembelian']) ?></strong></div>


                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Penyetor</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Bank</label>
                        <input type="text" class="form-control" name="bank" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="text" class="form-control" name="jumlah" min="1" required>
                    </div>
                    <div class="form-group">
                        <label>Foto Bukti</label>
                        <input type="file" class="form-control" name="bukti" accept="image/jpeg/jgp/png" required>
                        <p class="text-danger">foto bukti pengiriman (jpg, jpeg, png)</p>
                    </div>
                    <button class="btn" name="kirim">Kirim</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    //jika ada tombol kirim
    if (isset($_POST['kirim'])){

        $nama = $_POST["nama"];
        $bank = $_POST["bank"];
        $jumlah = $_POST["jumlah"];
        $tanggal = date("Y-m-d");

        // validasi format file
        $allowed_types = array('jpg', 'jpeg', 'png');
        $file_name = $_FILES['bukti']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        if (!in_array($file_ext, $allowed_types)) {
            echo "<script>alert('Format file yang diterima tidak sesuai');</script>";
            exit();
        }

        //upload dulu foto bukti
        $namabukti = $_FILES["bukti"]["name"];
        $lokasibukti = $_FILES["bukti"]["tmp_name"];
        $namafiks = date("YmdHis").$namabukti;
        move_uploaded_file($lokasibukti, "bukti_pembayaran/$namafiks");

        //simpan pembayaran
        $conn->query("INSERT INTO tb_pembayaran(id_pembelian, nama, bank, jumlah, tanggal, bukti_pembayaran)
        VALUES ('$idpem', '$nama', '$bank', '$jumlah', '$tanggal', '$namafiks')");

        //update status pembayaran
        $conn->query("UPDATE tb_pembelian SET status_pembelian='sudah kirim pembayaran'
        WHERE id_pembelian='$idpem'");

        echo "<script>alert('Terimakasih sudah mengirimkan bukti pembayaran');</script>";
        echo "<script>location='riwayat.php';</script>";
    } ?>

</body>
</html>