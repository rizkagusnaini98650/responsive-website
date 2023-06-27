<?php
include 'koneksi.php'; //memanggil koneksi agar dapat terhubung ke database dppkb_plg tabel data_pegawai
$id = $_GET["id"];
//mengambil id yang nanti akan dihapus

//memanggil QUERY delete untuk menghapus data pegawai sesuai ID masing-masing
$query = "DELETE FROM data_pegawai WHERE id='$id' ";
$hasil_query = mysqli_query($koneksi, $query);

//Lihat query jika terdapat error
if (!$hasil_query) {
  die("Gagal menghapus data: " . mysqli_errno($koneksi) .
    " - " . mysqli_error($koneksi));
} else {
  echo "<script>alert('Data berhasil dihapus.');window.location='index2.php';</script>";
}
