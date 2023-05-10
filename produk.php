<?php
    error_reporting(0);
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
            <h1><a href="index.php">THRIFT SHOP</a></h1>
            <ul>
                <li><a href="produk.php">Produk</a></li>
                <li><a href="login.php">Login</a></li>
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

    <!-- new produk -->
    <div class="section">
        <div class="container">
            <h3>Produk</h3>
            <div class="box">
                <?php 
                    if($_GET['search'] != '' || $_GET['kat'] != ''){
                        $where = "AND nama_produk LIKE '%".$_GET['search']."%' AND id_kategori LIKE '%".$_GET['kat']."%' ";
                    }

                    $produk = mysqli_query($conn, "SELECT * FROM tb_produk WHERE status_produk = 1 $where ORDER BY id_produk DESC");
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
        </div>
    </div>

</body>
</html>
