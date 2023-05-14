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
            <h1>Data Pembayaran</h1>
            <div class="box">
                <table border="1" cellspacing="0" class="table">
                        <tr>
                            <th>Nama</th>
                            <td><?php echo $detail['nama'] ?></td>
                        </tr>
                        <tr>
                            <th>Bank</th>
                            <td><?php echo $detail['bank'] ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td><?php echo number_format ($detail['jumlah']) ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?php echo $detail['tanggal'] ?></td>
                        </tr>
                </table><br><br>
            <div class="col-md-6">
                <img src="../bukti_pembayaran/<?php echo $detail['bukti_pembayaran'] ?>" alt=""  class="img-responsive"> 
            </div>

            <form method="POST">
                <div class="form-group">
                    <label>No Resi Pengiriman</label>
                    <input type="text" class="form-control" name="resi" required>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status" required>
                        <option value="">Pilih Status</option>
                        <option value="lunas">Lunas</option>
                        <option value="barang dikirim">Barang Dikirim</option>
                        <option value="batal">Batal</option>
                    </select>
                </div>
                <button class="btn" name="proses">Proses</button>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['proses'])){
        $resi = $_POST['resi'];
        $status = $_POST['status'];
        $conn->query("UPDATE tb_pembelian SET resi_pengiriman = '$resi', status_pembelian = '$status' WHERE id_pembelian='$id_pembelian'");

        echo "<script>alert('data pembelian terupdate');</script>";
        echo "<script>location='transaksi.php';</script>";
    } ?>

    <!-- footer -->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2023 - THRIFT SHOP.</small>
        </div>
    </footer>
</body>
</html>