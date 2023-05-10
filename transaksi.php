<?php 
    session_start();

    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level']==""){
        header("location:login.php?pesan=gagal");
    }

    include 'db.php';
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
                <li><a href=#>Transaksi</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header> 

    <!-- transaksi -->
    <div class="section">
        <div class="container">
            <h1>Data Pembelian</h1>
            <div class="box">
            <hr>
                <table <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Status Pembelian</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $nomor=1; ?>
                        <?php $ambil = $conn->query("SELECT * FROM tb_pembelian JOIN tb_user ON tb_pembelian.id_user=tb_user.id_user");?>
                        <?php while($data = $ambil->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $data["nama"]; ?></td>
                            <td><?php echo $data["tgl_pembelian"]; ?></td>
                            <td><?php echo $data["status_pembelian"]; ?></td>
                            <td><?php echo $data["total_pembelian"]; ?></td>
                            <td>
                                <a href="detail-pembelian.php?id=<?php echo $data['id_pembelian']; ?>" class= "btn">detail</a>

                                <?php if ($data['status_pembelian'] == "sudah kirim pembayaran"): ?>
                                    <a href="detail-transaksi.php?id=<?php echo $data['id_pembelian']; ?>" class= "btn btn-danger btn-xs">Pembayaran</a>
                                    <?php endif ?>
                            </td>
                        </tr>
                        <?php $nomor++ ?>
                        <?php } ?>
                    </tbody>
                </table><br><br>
            </div>
        </div>
    </div><br>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2023 - THRIFT SHOP.</small>
        </div>
    </footer>
</body>
</html>