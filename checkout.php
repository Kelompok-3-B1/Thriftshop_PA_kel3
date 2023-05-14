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

    if(empty ($_SESSION['keranjang']) OR !isset($_SESSION['keranjang'])){
        echo "<script>alert('Tidak ada data pemesanan');</script>";
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

    <!-- checkout -->
    <div class="section">
        <div class="container">
            <h1>Keranjang Belanja</h1>
            <div class="box">
            <hr>
            <table border="1" cellspacing="0" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $totalbelanja = 0; ?>
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
                    </tr>
                    <?php $nomor++; ?>
                    <?php $totalbelanja+=$subharga; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">Total Belanja</th>
                        <th>Rp. <?php echo number_format($totalbelanja) ?></th>
            </table><br><br>

            <form method="POST">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['nama'] ?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['user_telp'] ?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" readonly value="<?php echo $_SESSION['pelanggan']['user_email'] ?>" class="form-control">
                    </div>
                </div>
                <div class="col-md-4">
                    <select class="form-group" name="id_ongkir" required>
                        <option value="">Pilih Ongkos Kirim</option>
                        <?php
                        $ongkir = $conn->query("SELECT * FROM tb_ongkir");
                        while($perongkir = $ongkir->fetch_assoc()){
                        ?>
                        <option value="<?php echo $perongkir['id_ongkir'] ?>">
                            <?php echo $perongkir['nama_kota'] ?> -
                            Rp. <?php echo number_format ($perongkir['tarif']) ?>
                        </option>
                        <?php } ?>
                        </select>
                </div><br>
                <div class="form-group">
                    <label>Alamat Lengkap Pengiriman</label><br>
                    <textarea class="form-control" name="alamat_pengiriman" placeholder="masukkan alamat lengkap pengiriman" required></textarea>
                </div><br>
                <button class="btn btn-primary" name="checkout">Order</button>
            </div>
            </form><br><br>

            <?php
            if (isset($_POST['checkout'])){
                $id_pelanggan = $_SESSION['pelanggan']['id_user'];
                $id_ongkir = $_POST['id_ongkir'];
                $tgl_pembelian = date('Y-m-d');
                $alamat_pengiriman = $_POST['alamat_pengiriman'];

                $transaksi = $conn->query("SELECT * FROM tb_ongkir WHERE id_ongkir = '$id_ongkir'");
                $arrayongkir = $transaksi->fetch_assoc();
                $nama_kota = $arrayongkir['nama_kota'];
                $tarif = $arrayongkir['tarif'];

                $total_pembelian = $totalbelanja + $tarif;

                //menyimpan data ke tabel pembelian
                $conn->query("INSERT INTO tb_pembelian (
                    id_user, id_ongkir, tgl_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman)
                    VALUES ('$id_pelanggan', '$id_ongkir', '$tgl_pembelian', '$total_pembelian', '$nama_kota', '$tarif', '$alamat_pengiriman')");
            
                //mendapatkan id pembelian
                $id_pembelian_produk = $conn->insert_id;

                foreach ($_SESSION['keranjang'] as $id_produk => $jumlah){
                    //mendapatkan data produk berdasarkan id_produk
                    $ambil=$conn->query("SELECT * FROM tb_produk WHERE id_produk='$id_produk'");
                    $perproduk = $ambil->fetch_assoc();

                    $nama = $perproduk['nama_produk'];
                    $harga = $perproduk['harga_produk'];

                    $subharga = $perproduk['harga_produk']*$jumlah;
                    $conn->query("INSERT INTO tb_pembelian_produk (id_pembelian, id_produk, nama_produk, harga_produk, subharga, jumlah)
                    VALUES ('$id_pembelian_produk', '$id_produk', '$nama', '$harga', '$subharga', '$jumlah') ");
                }

                //mengosongkan keranjang belanja
                unset ($_SESSION['keranjang']);

                //tampilan dialihkan ke halaman nota
                echo "<script>alert('Pembelian Sukses');</script>";
                echo "<script>location='nota.php?id=$id_pembelian_produk';</script>";
            }?>
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