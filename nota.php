<?php 
    session_start();

    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level']==""){
        header("location:login.php?pesan=gagal");
    }

    include 'db.php';   
    $kontak = mysqli_query($conn, "SELECT user_telp, user_email, user_address FROM tb_user WHERE id_user = 1");
    $a = mysqli_fetch_object($kontak);

    //jika belum login, maka diarahkan ke halaman login
    if (!isset($_SESSION['pelanggan'])){
        echo "<script>alert('Silahkan Login');</script>";
        echo "<script>location='login.php';</script>";
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


    <!-- transaksi -->
    <div class="section">
        <div class="container">
            <h2>Detail Pembelian</h2><br>
            <div class="box">
                <?php
                $data = $conn->query("SELECT * FROM tb_pembelian JOIN tb_user ON tb_pembelian.id_user=tb_user.id_user
                WHERE tb_pembelian.id_pembelian='$_GET[id]'");
                $detail = $data->fetch_assoc();
                ?>

                <div class="row">
                    <div class="col-md-4">
                        <h3>Pembelian</h3>
                        <strong><?php echo $detail['tgl_pembelian'] ?></strong><br>
                        tanggal: <?php echo $detail['tgl_pembelian']; ?> <br>
                        Total: Rp. <?php echo number_format ($detail['total_pembelian']); ?>
                    </div><br>
                    <div class="col-md-4">
                        <h3>Pelanggan</h3>
                        <strong><?php echo $detail['nama']; ?></strong> <br>
                        <p>
                            <?php echo $detail['user_telp']; ?> <br>
                            <?php echo $detail['user_email']; ?> 
                        </p><br>
                    </div>
                    <div class="col-md-4">
                        <h3>Pengiriman</h3>
                        <strong><?php echo $detail['nama_kota'] ?></strong><br>
                        Ongkos Kirim: Rp. <?php echo number_format($detail['tarif']); ?><br>
                        Alamat: <?php echo $detail['alamat_pengiriman']; ?>
                    </div>
                </div><br><br>

                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor=1; ?>
                        <?php $ambilData=$conn->query("SELECT * FROM tb_pembelian_produk WHERE id_pembelian='$_GET[id]'"); ?>
                        <?php while($print=$ambilData->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $print['nama_produk']; ?></td>
                            <td>Rp. <?php echo number_format ($print['harga_produk']); ?></td>
                            <td><?php echo $print['jumlah']; ?></td>
                            <td>Rp. <?php echo number_format ($print['subharga']); ?></td>
                        </tr>
                        <?php $nomor++; ?>
                        <?php } ?>
                    </tbody>
                </table><br><br>

                <div class="row">
                    <div class="col-md-7">
                        <div class="alert alert-info">
                            <p>
                                Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
                                <strong>BANK BCA 6565-123098 AN. Thrift Shop Community</strong>
                            </p>
                        </div>
                    </div>
                </div><br><br>
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