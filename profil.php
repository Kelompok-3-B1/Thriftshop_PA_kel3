<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';   
    }

    //jika belum login, maka diarahkan ke halaman login
    if (!isset($_SESSION['admin'])){
        echo "<script>alert('Silahkan Login');</script>";
        echo "<script>location='login.php';</script>";
    }

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
            <h3>Profil Anda</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" readonly value="<?php echo $_SESSION['admin']['nama'] ?>" >
                    <input type="text" name="user" placeholder="Username" class="input-control" readonly value="<?php echo $_SESSION['admin']['username'] ?>" >
                    <input type="email" name="email" placeholder="Email" class="input-control" readonly value="<?php echo $_SESSION['admin']['user_email'] ?>" >
                    <input type="email" name="email" placeholder="Email" class="input-control" readonly value="<?php echo $_SESSION['admin']['user_telp'] ?>" >
                    <input type="email" name="email" placeholder="Email" class="input-control" readonly value="<?php echo $_SESSION['admin']['level'] ?>" >
                    <!-- <input type="submit" name="submit" value="Ubah Profil" class="btn"> -->
                <?php
                    if(isset($_POST['submit'])){

                        $nama = ucwords($_POST['nama']);
                        $user = $_POST['user'];
                        $email = $_POST['email'];

                        $update = mysqli_query($conn, "UPDATE tb_user SET
                                        nama = '".$nama."',
                                        username = '".$user."',
                                        user_email = '".$email."' 
                                        WHERE id_user    = '$id_user' ");
                        if($update){
                            echo '<script>alert("Ubah Data Berhasil")</script>';
                            echo '<script>window.location="profil.php"</script>';
                        }else{
                            echo 'Gagal '.mysqli_error($conn);
                        }
                    }
                ?>
            </div>

            <!-- <h3>Ubah Password</h3>
            <div class="box">
                <form action="" method="POST">
                    <input type="password" name="pass1" placeholder="Password Baru" class="input-control" required>
                    <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class="input-control" required>
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                </form>
                <?php
                    if(isset($_POST['ubah_password'])){

                        $pass1 = ($_POST['pass1']);
                        $pass2 = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("Konfirmasi Password Baru Tidak Sesuai")</script>';
                        }else{

                            $u_pass = mysqli_query($conn, "UPDATE tb_user SET
                                        password ='".$pass1."'
                                        WHERE id_user = '$id_user' ");
                            if($u_pass){
                                echo '<script>alert("Ubah Data Berhasil")</script>';
                                echo '<script>window.location="profil.php"</script>';
                            }else{
                                echo 'Gagal '.mysqli_error($conn);
                            }

                        }
                    }
                ?>
            </div> -->
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
