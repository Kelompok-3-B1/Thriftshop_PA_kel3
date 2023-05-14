<?php 
    session_start();

    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level']==""){
        header("location:login.php?pesan=gagal");
    }

    include 'db.php';

    //mendapatkan id pembelian
    $id_pembelian = $_GET['id'];

    //mengambil data pembayaran berdasarkan id pebelian
    $ambil = $conn->query("SELECT * FROM tb_pembayaran WHERE id_pembelian = '$id_pembelian'");
    $detail = $ambil->fetch_assoc();
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
            <h1><a href="halaman_staff.php">THRIFT SHOP</a></h1>
            <ul>
                <li><a href="halaman_staff.php">Dashboard</a></li>
                <li><a href="transaksi.php">Transaksi</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header> 

    <!-- transaksi -->
    <div class="section">
        <div class="container">
            <h2>Detail Penjualan</h2><br>
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
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2023 - THRIFT SHOP.</small>
        </div>
    </footer>
</body>
</html>