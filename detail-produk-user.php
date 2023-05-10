<?php
    error_reporting(0);
    include 'db.php';   
    $kontak = mysqli_query($conn, "SELECT user_telp, user_email, user_address FROM tb_user WHERE id_user = 1");
    $a = mysqli_fetch_object($kontak);

    $produk = mysqli_query($conn, "SELECT * FROM tb_produk WHERE id_produk = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk); 
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

            </ul>
        </div>
    </header> 

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
                <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
                <input type="submit" name="cari" value="Cari Produk">
            </form>
        </div>
    </div>

    <!-- detail produk -->
    <div class="section">
        <div class="container">
            <h3>Detail Produk</h3>
            <div class="box">
                <div class="col-2">
                    <img src="produk/<?php echo $p->img_produk ?>" width="100%"> 
                </div>
                <div class="col-2">
                    <h3><?php echo $p->nama_produk ?></h3>
                    <h4>Rp. <?php echo number_format($p->harga_produk) ?></h4>
                    <p>Deskripsi : <br>
                        <?php echo $p->deskripsi_produk ?>
                    </p>
                    <form method="POST" action="tambah-keranjang.php?id=<?php echo $p->id_produk ?>">
                    <div class="row g-2">
                        <div class="col-9">
                            <button class="btn btn-primary w-100" type="submit">Tambah ke Keranjang</button>
                        </div>
                    </div>
                    </form>
                </div>
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