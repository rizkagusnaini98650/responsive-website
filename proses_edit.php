<?php
// untuk menghubungkan dengan database, panggil file koneksi.php 
include 'koneksi.php';

// membuat variabel untuk menampung data dari form
$id = $_POST['id'];
$nama_pegawai   = $_POST['nama_pegawai'];
$jabatan_pegawai = $_POST['jabatan_pegawai'];
$nip_pegawai    = $_POST['nip_pegawai'];
$golongan = $_POST['golongan'];
$gambar_pegawai = $_FILES['gambar_pegawai']['name'];
//dicek jika ingin mengubah gambar produk
if ($gambar_produk != "") {
  $ekstensi_diperbolehkan = array('png', 'jpg'); //format gambar
  $x = explode('.', $gambar_produk); //memisahkan nama file dengan gambar yang diupload
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar_pegawai']['tmp_name'];
  $angka_acak     = rand(1, 999);
  $nama_gambar_baru = $angka_acak . '-' . $gambar_produk; //menggabungkan angka acak dengan nama file sebenarnya
  if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
    move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru); //file gambar dimasukkan ke folder gambar

    // menjalankan query --> UPDATE sesuai ID pegawai yang produknya ingin kita edit
    $query  = "UPDATE data_pegawai SET nama_pegawai = '$nama_pegawai', jabatan_pegawai = '$jabatan_pegawai', nip_pegawai = '$nip_pegawai', golongan = '$golongan', gambar_pegawai = '$gambar_pegawai'";
    $query .= "WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);
    // periska jika ada query yang error
    if (!$result) {
      die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
    } else {
      //menampilkan alert dan akan dikembalikan ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
    }
  } else {

    //jika file ekstensi tidak jpg dan png maka alert ini yang tampil
    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_data.php';</script>";
  }
} else {
  // jalankan query UPDATE berdasarkan ID yang produknya kita edit
  $query  = "UPDATE data_pegawai SET nama_pegawai = '$nama_pegawai', jabatan_pegawai = '$jabatan_pegawai', nip_pegawai = '$nip_pegawai', golongan = '$golongan' , gambar_pegawai = '$gambar_pegawai' ";
  $query .= "WHERE id = '$id'";
  $result = mysqli_query($koneksi, $query);
  // periska query apakah ada error
  if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
      " - " . mysqli_error($koneksi));
  } else {
    //tampil alert dan akan redirect ke halaman index.php
    //silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil diubah.');window.location='index2.php';</script>";
  }
}
