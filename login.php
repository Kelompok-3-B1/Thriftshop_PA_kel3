<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Thrift Shop</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">    
    <link href="https://fonts.googleapis.com/css2?family=Oxygen&display=swap" rel="stylesheet">
</head>
<body id="bg-login">
   <div class="box-login">
       <h2>Login</h2>
       <?php 
        if(isset($_GET['pesan'])){
            if($_GET['pesan']=="gagal"){
                echo "<div class='alert'>Username dan Password tidak sesuai !</div>";
            }
        }
        ?>
       <form action="cek_login.php" method="POST">
           <input type="text" name="user" placeholder="Username" class="input-control">
           <input type="password" name="pass" placeholder="Password" class="input-control">
           <input type="submit" name="submit" value="Login" class="btn">
       </form>
   </div>     
</body>
</html>
