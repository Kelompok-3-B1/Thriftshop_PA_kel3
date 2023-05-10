<?php 
    session_start();

    // echo "<pre>";
    // print_r ($_SESSION['keranjang']);
    // echo "</pre>";    

    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level']==""){
        header("location:login.php?pesan=gagal");
    }

    error_reporting(0);
    include 'db.php';   
    $kontak = mysqli_query($conn, "SELECT user_telp, user_email, user_address FROM tb_user WHERE id_user = 1");
    $a = mysqli_fetch_object($kontak);

    if(empty ($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
        echo "<script>alert('keranjang kosong, pilih produk dahulu');</script>";
        echo "<script>location='halaman_user.php';</script>";
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

    <!-- cart -->
    <div class="section">
        <div class="container">
            <h1>Keranjang Belanja</h1>
            <div class="box">
                <hr>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subharga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor=1; ?>
                        <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
                        <?php
                        $ambilData = $conn->query("SELECT * FROM tb_produk WHERE id_produk= '$id_produk'");
                        $dataProduk = $ambilData->fetch_assoc();
                        $subharga = $dataProduk["harga_produk"] * $jumlah;

                        ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $dataProduk["nama_produk"]; ?></td>
                            <td>Rp. <?php echo number_format($dataProduk["harga_produk"]); ?></td>
                            <td><?php echo $jumlah; ?></td>
                            <td>Rp. <?php echo number_format($subharga); ?></td>
                            <td>
                                <a href="hapus-keranjang.php?id=<?php echo $id_produk ?>" class= "btn">hapus</a>
                            </td>
                        </tr>
                        <?php $nomor++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table><br><br>

                <a href="produk_user.php" class="btn btn-primary">Lanjutkan Belanja</a> <br><br>
                <a href="checkout.php" class="btn btn-primary">Checkout</a>
            </div>
        </div>
    </div><br>
    
    <!-- footer -->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->user_address ?></p>

            <h4>Email</h4>
            <p><?php echo $a->user_email ?></p>

            <h4>No. Hp</h4>
            <p><?php echo $a->user_telp ?></p>

            <small>Copyright &copy; 2023 - THRIFT SHOP.</small>
        </div>
    </div>

</body>
</html>