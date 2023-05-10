# Thriftshop_PA_kel3
#
## Anggota
1. Angrayni Melinda S
2. Mufidah Luthfiany
3. Chorine Jessica Utama

### Latar Belakang
Thriftshop merupakan toko yang menjual segala barang thrift. Ada banyak sekali toko-toko dan pasar yang menjual barang antik di seluruh Indonesia. Dan juga, semakin dengan berkembangnya zaman, semakin berkembang pula tren thrift shop ini. Kamu bisa menemukan banyak sekali online shop atau e-commerce yang menjual koleksi-koleksi atau pakaian vintage. 
Namun dalam hal penanganan transaksi serta pencatatan data produk tak jarang ditemukan masih menggunakan cara manual seperti masih menggunakan nota, dan pencariannya masih secara manual. Hal tersebut dapat memperlambat proses transaksi serta memungkinkan terjadinya  kesalahan  data  yang  terjadi  pada  transaksi.  Dengan  melihat  kondisi  permasalahan  ini kami  membuat  sebuah   program yang  dapat  mempermudah  dalam  proses  input  pelanggan,  proses  pembelian serta pembayaran, dan penanganan data produk pada thriftshop

### Tujuan
1.	Untuk mempermudah Pelanggan / user  dalam melakukan pembelian produk dan transaksi pembayaran.
2.	Untuk mempermudah Staff  dalam melakukan proses penanganan transaksi dari pelanggan.
3.	Untuk mempermudah Admin  dalam menambah, menghapus, serta melakukan perubahan data produk dalam thriftshop.

### Manfaat
1.	Memudahkan pelanggan / user dalam membeli produk dan transaksi pembayaran secara online
2.	Memudahkan staff dalam memproses transaksi pembayaraj produk yang dilakukan oleh pelanggan
3.	Mempermudah admin dalam menambah, mengubah, serta mengurangi produk yang terdaftar dalam thriftshop.

#
# TOTURIAL PENGGUNAAN WEB
## 1.	Halaman Utama
![Screenshot (3)](https://github.com/Chorine88/Posttest2_Web/assets/120235513/456e3f32-350b-40be-9712-e026fcaa36cd)
Saat user mengakses website, maka tampilan utamanya akan seperti pada gambar di atas. Pada bagian nav bar terdapat menu produk dan juga login yang dapat diakses oleh user. Terdapat pula fitur searching yang dapat memudahkan user dalam mencari produk yang terdapat pada website. Selain fitur searching, website ini juga memiliki fitur yang kategori, dimana user dapat melihat produk berdasarkan kategori yang diinginkan.<br>
#
![Screenshot (4)](https://github.com/Chorine88/Posttest2_Web/assets/120235513/49054d03-a0b4-4094-a5d3-d50913cb2fd9)
Pada bagian bawah fitur kategori terdapat konten utama dari halaman ini, yaitu produk. User dapat mengklik masing-masing produk yang tertera kemudian website ini akan menampilkan informasi mengenai detail produk yang dipilih oleh user.
#
![Screenshot (5)](https://github.com/Chorine88/Posttest2_Web/assets/120235513/15ae29e6-b11f-45fd-8b91-c62e34df50fb)
Gambar di atas merupakan contoh tampilan ketika user ingin menampilkan detail produk.
#


## 2.	Halaman Login
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/834d51fc-cad8-480b-b37c-fa34bf81106e)
Tampilan halaman login yang terdapat pada website ini dapat dilihat seperti pada gambar di atas. Ketika user melakukan login, sistem akan membaca level/role yang dimiliki oleh user untuk kemudian diarahkan ke halaman masing-masing role.

### A.	Halaman Admin
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/acec0f7b-7dd0-4ebd-9e53-a8ebf47e6cf7)
Jika user memiliki role/level "admin" maka akan di arahkan ke halaman admin. Untuk tampilan utama dari halaman admin akan menampilkan dashboard Admin. Seorang Admin memiliki hak/privilege untuk mengelola kategori produk dan juga produk (CRUD). Pada halaman Admin terdapat menu Profil, Data Kategori, dan Data Produk.

<br>
### Menu Profil
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/11e9400a-eab4-4c6c-a45c-1821c9b925c1)
Pada halaman profil, website akan menampilkan identitas akun yang dimiliki oleh user (yang digunakan untuk login).
<br>
### Data Kategori
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/cd2ec12f-f1d3-4e3a-98e7-c18b93e1e00b)
Halaman Data Kategori menampilkan data kategori yang terdapat pada website ini. Pada halaman ini Admin dapat menambahkan data, mengubah serta menghapus data.
<br>
### Tambah Data Kategori
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/27a3852e-53f9-4cd4-ba95-3998a499b7bd)
Ketika Admin memilih opsi tambah data, maka tampilannya akan seperti pada gambar di atas. Admin diminta untuk memasukkan Nama Kategori baru, kemudian datanya akan disimpan ke dalam database.
<br>
### Edit Data Kategori
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/e9e67ada-7245-46ef-b2be-7e2654ead286)
Ketika Admin memilih opsi edit data, maka tampilannya akan seperti pada gambar di atas. Terdapat sebuah form yang menampilkan nama kategori yang dipilih user untuk kemudian diubah datanya.
<br>
### Data Produk
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/14b3a947-52ff-4474-b847-f7731273cc13)
Pada halaman Data Produk akan ditampilkan informasi mengenai data produk yang terdapat pada website ini. Sama seperti pada menu Data Kategori, Admin juga dapat menambah, mengubah, dan menghapus data. Terdapat pula fitur sorting yang berfungsi untuk menampilkan harga terendah ke tertinggi begitu juga sebaliknya.
<br>
### Tambah Data Produk
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/90668ec1-43f5-42c6-9551-7c3c0f0975c1)
Ketika Admin memilih menu Tambah data maka tampilannya akan seperti gambar di atas. Admin akan diminta untuk mengisi form yang berisikan kategori, nama produk, harga, foto produk, deskripsi produk, serta status produk.
<br>
### Edit Data Produk
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/e7bd91c6-d6bb-46b2-ab51-c1440fca1974)
Tampilan dari menu Edit Data Produk sama saja seperti pada menu Tambah Data Produk, namun pada menu ini formnya sudah terisi sesuai dengan detail data dari produk yang ingin diubah oleh Admin.
<br>

### B.	Halaman Staff
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/5495aa24-a16b-4efe-9eee-e33511ad6a8c)
Jika user memiliki role/level "staff" maka akan di arahkan ke halaman staff. Untuk tampilan utama dari halaman staff akan menampilkan dashboard Staff. Seorang Staff memiliki hak untuk mengelola transaksi yang terdapat pada online store ini. Pada halaman Staff terdapat menu Transaksi.
<br>
### Transaksi
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/1abb1c6f-c070-4227-ad4f-1774b41d4d0a)
Pada Halaman Transaksi terdapat riwayat pembelian yang dilakukan oleh user. Pada kolom data pembelian tersebut terdapat dua aksi yang dapat dilakukan oleh Staff, yaitu untuk melihat detail pembelian dan juga pembayaran apabila status pembelian user bernilai "sudah kirim pembayaran".
<br>
### Detail Pembelian
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/e8e975cb-eed8-47f2-927b-86f0caa4fa63)
Seorang Staff dapat melihat detail pembelian yang dilakukan oleh customer. Pada detail pembelian terdapat informasi mengenai data pembelian, pelanggan, pengiriman, serta produk yang dibeli.
### Pembayaran
![image](https://github.com/Kelompok-3-B1/Thriftshop_PA_kel3/assets/93468350/8c4fcc45-18a1-4588-b281-7dbc534999c3)
Pada halaman data pembayaran terdapat informasi mengenai data transaksi customer yang berisi nama customer, bank, jumlah, dan tanggal. Pada halaman ini Staff diminta untuk memberikan Nomor resi pengiriman, dan status (status pembelian).



### C.	Halaman User
