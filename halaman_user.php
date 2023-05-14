<?php 
    session_start();

    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level']==""){
        header("location:login.php?pesan=gagal");
    }

    include 'db.php';   
    $kontak = mysqli_query($conn, "SELECT user_telp, user_email, user_address FROM tb_user WHERE id_user = 1");
    $a = mysqli_fetch_object($kontak);
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

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!-- content -->
    <div class="section">
        <div class="container">
            <div class="box">
                <h4>Halo <b><?php echo $_SESSION['user']; ?>.</h4>
            </div>
        </div>  
    </div>

    <!-- kategori -->
    <div class="section">
        <div class="container">
            <h3>Kategori</h3>
            <div class="box">
                <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY id_kategori DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                ?>
                    <a href="produk.php?kat=<?php echo $k['id_kategori'] ?>">
                        <div class="col-5">
                            <img src="img/kategori.png" width="50px" style="margin-bottom:5px;">
                            <p><?php echo $k['nama_kategori'] ?></p>
                        </div>
                <?php }}else{ ?>
                    <p>Kategori tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- new produk -->
    <div class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php 
                    $produk = mysqli_query($conn, "SELECT * FROM tb_produk WHERE status_produk = 1 ORDER BY id_produk DESC LIMIT 8");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                    <a href="detail-produk.php?id=<?php echo $p['id_produk'] ?>">
                        <div class="col-4">
                            <img src="produk/<?php echo $p['img_produk'] ?>">
                            <p class="nama"><?php echo $p['nama_produk'] ?></p>
                            <p class="harga">Rp. <?php echo number_format($p['harga_produk']) ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Produk tidak ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

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

</body>
</html>