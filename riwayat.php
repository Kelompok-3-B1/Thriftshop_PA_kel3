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
            <h3>Riwayat Belanja <?php echo $_SESSION['pelanggan']['nama']; ?></h3>
            <div class="box">
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $nomor=1;
                    //mendapatkan id_pelanggan dari login session
                    $id_user = $_SESSION['pelanggan']['id_user'];

                    $data = $conn->query("SELECT * FROM tb_pembelian WHERE id_user='$id_user'");
                    while($print = $data->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $print['tgl_pembelian'] ?></td>
                        <td>
                            <?php echo $print['status_pembelian'] ?>
                            <br>
                            <?php if(!empty($print['resi_pengiriman'])): ?>
                                Resi: <?php echo $print['resi_pengiriman']; ?>
                                <?php endif ?>
                        </td>
                        <td>Rp. <?php echo number_format ($print['total_pembelian']) ?></td>
                        <td>
                            <a href="nota.php?id=<?php echo $print['id_pembelian'] ?>" class="btn">Nota</a>
                            <a href="pembayaran.php?id=<?php echo $print['id_pembelian'] ?>" class="btn">Pembayaran</a>
                        </td>
                    </tr>
                    <?php $nomor++ ?>
                    <?php } ?>
                </tbody>
            </table>
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