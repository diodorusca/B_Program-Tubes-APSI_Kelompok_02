<?php
session_start();
include "../../../../config/koneksi.php";
include "PesanRealtime.php";

if ($_GET['aksi'] == "update") {
    $id = $_GET['id_pengajuan'];

    $query_edit = "UPDATE pengajuan SET status = 'Sudah dibaca'";
    $query_edit .= "WHERE id_pengajuan='$id'";
    $sql = mysqli_query($koneksi, $query_edit);

    if ($sql) {
        $_SESSION['berhasil'] = "Status pesan berhasil di update !!";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Status pesan gagal di update !!. Cek QUERY";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} elseif ($_GET['aksi'] == "kirim") {

    if ($_POST['namaPenerima'] == NULL) {
        $_SESSION['gagal'] = "Harap pilih penerima pesan !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {

        include "Pemberitahuan.php";

        // Variable hasil POST
        date_default_timezone_set('Asia/Jakarta');
        $nama_penerima = $_POST['namaPenerima'];
        $pengirim = $_POST['pengirim'];
        $judul_pesan = $_POST['judulPesan'];
        $judul_buku = $_POST['judulBuku'];
        $kategori_buku = $_POST['kategoriBuku'];
        $penerbit_buku = $_POST['penerbitBuku'];
        $pengarang = $_POST['pengarang'];
        $tahun_terbit = $_POST['tahunTerbit'];
        $isbn = $_POST['isbn'];
        $tipe_buku = $_POST['tipeBuku'];
        $jumlah_buku_baik = $_POST['jumlahBukuBaik'];
        $jumlah_buku_rusak = $_POST['jumlahBukuRusak'];
        $status = "Belum dibaca";
        $tanggal_kirim = date('d-m-Y');
        // SQL
        $sql = "INSERT INTO pengajuan(penerima, pengirim, judul_pesan, judul_buku, kategori_buku, penerbit_buku, pengarang, tahun_terbit, isbn, tipe_buku, jumlah_buku_baik, jumlah_buku_rusak, status, tanggal_kirim)
                VALUES('$nama_penerima', '$pengirim', '$judul_pesan', '$judul_buku', '$kategori_buku', '$penerbit_buku', '$pengarang', '$tahun_terbit', '$isbn', '$tipe_buku', '$jumlah_buku_baik', '$jumlah_buku_rusak', '$status', '$tanggal_kirim')";

        $sql .= mysqli_query($koneksi, $sql);
        // Cek SQL
        if ($sql) {
            // Send notif to admin
            InsertPemberitahuanPengajuan();
            //
            $_SESSION['berhasil'] = "Pesan berhasil terkirim !";
            header("location: " . $_SERVER['HTTP_REFERER']);
        } else {
            $_SESSION['gagal'] = "Pesan gagal terkirim !";
            header("location: " . $_SERVER['HTTP_REFERER']);
        }
    }
} elseif ($_GET['aksi'] == "hapus") {
    $id_pengajuan = $_GET['id_pengajuan'];

    $sql = mysqli_query($koneksi, "DELETE FROM pengajuan WHERE id_pengajuan = '$id_pengajuan'");

    if ($sql) {
        $_SESSION['berhasil'] = "Data pesan berhasil di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    } else {
        $_SESSION['gagal'] = "Data pesan gagal di hapus !";
        header("location: " . $_SERVER['HTTP_REFERER']);
    }
} elseif ($_GET['aksi'] == "badgePesan") {
    GetBadgePesan();
} elseif ($_GET['aksi'] == "Pesan") {
    GetPesan();
} elseif ($_GET['aksi'] == "jumlahPesan") {
    GetJumlahPesan();
}
function UpdateDataPesan()
{
    include "../../../../config/koneksi.php";

    $nama_lama = $_SESSION['fullname'];
    $nama_saya = $_POST['Fullname'];

    $query = "UPDATE pengajuan SET pengirim = '$nama_saya'";
    $query .= "WHERE pengirim = '$nama_lama'";

    $sql = mysqli_query($koneksi, $query);

    if ($sql) {
        // Hapus session lama
        unset($_SESSION['fullname']);

        // Mulai session baru
        session_start();
        $_SESSION['fullname'] = $_POST['Fullname'];
    }
}
