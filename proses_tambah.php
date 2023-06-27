<?php
// memanggil file koneksi, agar dapat terhubung  ke koneksi database MySQL
include 'koneksi.php';

// membuat variabel yang dimaksudkan untuk menampung data
$nama_pegawai   = $_POST['nama_pegawai'];
$jabatan_pegawai   = $_POST['jabatan_pegawai'];
$nip_pegawai   = $_POST['nip_pegawai'];
$golongan    = $_POST['golongan'];
$gambar_pegawai = $_FILES['gambar_pegawai']['name'];


//memeriksa  apakah  gambar pegawai sudah ada atau belum?
if ($gambar_pegawai != "") {
  $ekstensi_diperbolehkan = array('png', 'jpg'); // format file gambar 
  $x = explode('.', $gambar_pegawai); //memisahkan nama file 
  $ekstensi = strtolower(end($x));
  $file_tmp = $_FILES['gambar_pegawai']['tmp_name'];
  $angka_acak     = rand(1, 999);
  $nama_gambar_baru = $angka_acak . '-' . $gambar_pegawai; //menggabungkan angka acak dengan nama file sebenarnya
  if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
    move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru); //file gambar dipindahkan ke  file khusus  gambar
    // menjalankan query INSERT untuk menambah data ke database
    $query = "INSERT INTO data_pegawai (nama_pegawai, jabatan_pegawai, nip_pegawai, golongan, gambar_pegawai) VALUES ('$nama_pegawai', '$jabatan_pegawai', '$nip_pegawai', '$golongan', '$nama_gambar_baru')";
    $result = mysqli_query($koneksi, $query);
    // apakah query terdapat error,  sehingga harus diperiksa terlebih dahulu
    if (!$result) {
      die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
        " - " . mysqli_error($koneksi));
    } else {
      //terdapat alert dan akan redirect (dikembalikan) ke halaman index.php
      //silahkan ganti index.php sesuai halaman yang akan dituju
      echo "<script>alert('Data berhasil ditambah.');window.location='index2.php';</script>";
    }
  } else {
    //format harus jpg atau png, bila  tidak akan muncul alert di bawah
    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_data.php';</script>";
  }
} else {
  $query = "INSERT INTO data_pegawai (nama_pegawai, jabatan_pegawai, nip_pegawai, golongan, gambar_pegawai) VALUES ('$nama_pegawai', '$jabatan_pegawai','$nip_pegawai', '$golongan', null)";
  $result = mysqli_query($koneksi, $query);
  // periska query apakah ada error
  if (!$result) {
    die("Query gagal dijalankan: " . mysqli_errno($koneksi) .
      " - " . mysqli_error($koneksi));
  } else {
    //tampil alert dan akan redirect ke halaman index.php
    //silahkan ganti index.php sesuai halaman yang akan dituju
    echo "<script>alert('Data berhasil ditambah.');window.location='index2.php';</script>";
  }
}
