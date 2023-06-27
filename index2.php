<?php
include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
?>

<?php

// session_start();

// if (!isset($_SESSION['admin'])) {
//     header("Location: loginadmin.php");
// }

?>
<!DOCTYPE html>
<html>

<head>
    <title>DPPKB Palembang</title>
    <style type="text/css">
        * {
            font-family: "Trebuchet MS";
            background-color: #4169E1;


        }

        h1 {
            text-transform: uppercase;
            font-family: timesnewroman;
            text-shadow: 2px 2px 2px black;
            color: white;
        }

        table {
            border: solid 3px #6A5ACD;
            border-collapse: collapse;
            border-spacing: 0;
            width: 90%;
            margin: 20px auto 20px auto;

        }

        table thead th {
            background-color: #483D8B;
            border: solid 1px gray;
            color: #336B6B;
            padding: 10px;
            text-align: center;
            color: #DDEFEF;
            text-decoration: none;
        }

        table tbody td {
            background-color: #F5FFFA;
            border: solid 1px gray;
            color: #333;
            padding: 10px;
            text-shadow: 1px 1px 1px #fff;
            text-align: center;
        }

        a {
            background-color: #808080;
            color: #fff;
            padding: 10px;
            text-decoration: none;
            font-size: 13px;
            text-shadow: black;

        }
    </style>
</head>

<body>
    <a href="logout.php">LOGOUT</a>

    <center>
        <h1 style="padding-top: 40px;">Data Pegawai</h1>
        <center>

            <center><a href="tambah_data.php">+ &nbsp; Tambah Data</a>
                <center>
                    <br />
                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>NIP</th>
                                <th>Golongan</th>
                                <th>Gambar</th>
                                <th>Edit</th>
                                <th>Hapus</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
                            $query = "SELECT * FROM data_pegawai ORDER BY id ASC";
                            $result = mysqli_query($koneksi, $query);
                            //mengecek apakah ada error ketika menjalankan query
                            if (!$result) {
                                die("Query Error: " . mysqli_errno($koneksi) .
                                    " - " . mysqli_error($koneksi));
                            }

                            //buat perulangan untuk element tabel dari data mahasiswa
                            $no = 1; //variabel untuk membuat nomor urut
                            // hasil query akan disimpan dalam variabel $data dalam bentuk array
                            // kemudian dicetak dengan perulangan while
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo substr($row['nama_pegawai'], 0, 40); ?></td>
                                    <td><?php echo substr($row['jabatan_pegawai'], 0, 70); ?></td>
                                    <td><?php echo substr($row['nip_pegawai'], 0, 20); ?></td>
                                    <td><?php echo substr($row['golongan'], 0, 20); ?></td>
                                    <td style="text-align: center;"><img src="gambar/<?php echo $row['gambar_pegawai']; ?>" style="width: 120px;"></td>
                                    <td>
                                        <a href="edit_data.php?id=<?php echo $row['id']; ?>">Edit</a>
                                    </td>
                                    <td>
                                        <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>

                            <?php
                                $no++; //untuk nomor urut terus bertambah 1
                            }
                            ?>
                        </tbody>
                    </table>
</body>

</html>