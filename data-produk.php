<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';   
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
            <h1><a href="halaman_admin.php">THRIFT SHOP</a></h1>
            <ul>
                <li><a href="halaman_admin.php">Dashboard</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header> 

    <!-- sorting -->
    <div class="sort">
        <div class="container">
        <form action="" method="GET">
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <select name="sort" class="form-control">
                            <option value="">--Select Option--</option>
                            <option value="asc" <?php if(isset($_GET['sort']) && $_GET['sort'] == "asc"){ echo "selected";} ?> >Price: Low to High</option>
                            <option value="desc" <?php if(isset($_GET['sort']) && $_GET['sort'] == "desc"){ echo "selected";} ?> >Price: High to Low</option>
                        </select>
                        <button type="submit" class="btn">Sort</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Data Produk</h3>
            <div class="box">
                <p><a href="tambah-produk.php">Tambah Data</a></p>
                <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>status</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sort = "";
                            if(isset($_GET['sort'])){
                                if($_GET['sort'] == "asc"){
                                    $sort = "ORDER BY harga_produk ASC";
                                }else if($_GET['sort'] == "desc"){
                                    $sort = "ORDER BY harga_produk DESC";
                                }
                            }
                            
                            $produk = mysqli_query($conn, "SELECT * FROM tb_produk LEFT JOIN tb_kategori USING (id_kategori) $sort");
                            $no = 1;
                            if(mysqli_num_rows($produk) > 0){
                            while($row = mysqli_fetch_array($produk)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['nama_kategori'] ?></td>
                            <td><?php echo $row['nama_produk'] ?></td>
                            <td>Rp. <?php echo number_format($row['harga_produk']) ?></td>
                            <td><a href="produk/<?php echo $row['img_produk'] ?>" target="_blank"><img src="produk/<?php echo $row['img_produk'] ?>" width="50px"></a></td>
                            <td><?php echo ($row['status_produk'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
                            <td>
                                <a href="edit-produk.php?id=<?php echo $row['id_produk'] ?>">Edit</a> || <a href="proses-hapus.php?idp=<?php echo $row['id_produk'] ?>" onclick="return confirm('Anda yakin ingin hapus ?')">Hapus</a>
                                
                            </td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="7">Tidak ada data</td>
                            </tr>

                        <?php } ?>
                    </tbody>

                </table>
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
