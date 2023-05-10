<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'db.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['user'];
$password = $_POST['pass'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"SELECT * FROM tb_user WHERE username = '".$username."' AND password = '".$password."'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['level']=="admin"){
 
		// buat session login dan username
		$_SESSION['user'] = $username;
		$_SESSION['level'] = "admin";
		$d = mysqli_fetch_object($login);
			$_SESSION['status_login'] = true;
			$_SESSION['a_global'] = $d;
			$_SESSION['id'] = $d->id_user;
			$_SESSION['admin'] = $data;
		// alihkan ke halaman dashboard admin
		header("location:halaman_admin.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['level']=="staff"){
		// buat session login dan username
		$_SESSION['user'] = $username;
		$_SESSION['level'] = "staff";
		// alihkan ke halaman dashboard pegawai
		header("location:halaman_staff.php");
 
	// cek jika user login sebagai pengurus
	}else if($data['level']=="user"){
		// buat session login dan username
		$_SESSION['user'] = $username;
		$_SESSION['level'] = "user";
		$_SESSION['pelanggan'] = $data;
		// alihkan ke halaman dashboard pengurus
		header("location:halaman_user.php");
 
	}else{
 
		// alihkan ke halaman login kembali
		header("location:login.php?pesan=gagal");
	}	
}else{
	header("location:login.php?pesan=gagal");
}
 
?>
