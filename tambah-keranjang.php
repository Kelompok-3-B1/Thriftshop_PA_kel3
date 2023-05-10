<?php
session_start();
$id_produk = $_GET['id'];

// jika produk sudah ada di keranjang, jumlahnya +1
if(isset($_SESSION['keranjang'][$id_produk])){
    $_SESSION['keranjang'][$id_produk]+=1;
}

// jika belum ada di keranjang, jumlahnya dianggap 1
else{
    $_SESSION['keranjang'][$id_produk] =1;
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

echo "<script>alert('Produk telah dimasukkan ke keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?>