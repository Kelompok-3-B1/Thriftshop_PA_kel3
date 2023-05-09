<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';   
    }

    $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori WHERE id_kategori = '".$_GET['id']."' ");
    if(mysqli_num_rows($kategori) == 0){
        echo '<script>window.location="data-kategori.php"</script>';
    }
    $k = mysqli_fetch_object($kategori);

    $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = '".$_SESSION['id']."' ");
    $d = mysqli_fetch_object($query);
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

    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Edit Data Kategori</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $k-> nama_kategori ?>" required>
                    <input type="submit" name="submit" value="Submit" class="btn">
                </form>
                <?php
                    if(isset($_POST['submit'])){
                        $nama = ucwords($_POST['nama']);

                        $update = mysqli_query($conn, "UPDATE tb_kategori SET
                                                nama_kategori = '".$nama."'
                                                WHERE id_kategori = '".$k->id_kategori."' ");
                        if($update){
                            echo '<script>alert("Edit Data Berhasil")</script>';
                            echo '<script>window.location="data-kategori.php"</script>';
                        }else{
                            echo 'Gagal '.mysqli_error($conn);
                        }
    
                    }
                ?>
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