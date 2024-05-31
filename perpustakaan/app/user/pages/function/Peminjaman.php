<?php
session_start();
include "../../../../config/koneksi.php";

if ($_GET['aksi'] == "pinjam") {
    if (empty($_POST['judulBuku'])) {
        $_SESSION['gagal'] = "Peminjaman buku gagal, Kamu belum memilih buku yang akan dipinjam!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
    
    if (empty($_POST['kondisiBukuSaatDipinjam'])) {
        $_SESSION['gagal'] = "Peminjaman buku gagal, Kamu belum memilih kondisi buku yang akan dipinjam!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    include "Pemberitahuan.php";

    $nama_anggota = $_POST['namaAnggota'];
    $judul_buku = $_POST['judulBuku'];
    $tanggal_peminjaman = $_POST['tanggalPeminjaman'];
    $tenggat_peminjaman = $_POST['tenggatPeminjaman'];
    $kondisi_buku_saat_dipinjam = $_POST['kondisiBukuSaatDipinjam'];

    $query = mysqli_query($koneksi, "SELECT * FROM peminjaman WHERE nama_anggota = '$nama_anggota' AND judul_buku = '$judul_buku' AND tanggal_pengembalian = ''");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $_SESSION['gagal'] = "Peminjaman buku gagal, Kamu telah meminjam buku ini sebelumnya!";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    $sql = "INSERT INTO peminjaman(nama_anggota, judul_buku, tanggal_peminjaman, tenggat_peminjaman, kondisi_buku_saat_dipinjam)
            VALUES('$nama_anggota', '$judul_buku', '$tanggal_peminjaman', '$tenggat_peminjaman', '$kondisi_buku_saat_dipinjam')";

    if (mysqli_query($koneksi, $sql)) {
        // Send notif to admin
        InsertPemberitahuanPeminjaman();
        $_SESSION['berhasil'] = "Peminjaman buku berhasil!";
    } else {
        $_SESSION['gagal'] = "Terjadi masalah dalam pengiriman data peminjaman!";
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} elseif ($_GET['aksi'] == "pengembalian") {
    include "Pemberitahuan.php";

    $judul_buku = $_POST['judulBuku'];
    $tanggal_pengembalian = $_POST['tanggalPengembalian'];
    $kondisi_buku_saat_dikembalikan = $_POST['kondisiBukuSaatDikembalikan'];

    switch ($kondisi_buku_saat_dikembalikan) {
        case 'Baik':
            $denda = "Tidak ada";
            break;
        case 'Rusak':
            $denda = "Rp 20.000";
            break;
        case 'Hilang':
            $denda = "Rp 50.000";
            break;
        default:
            $denda = "Tidak ada";
            break;
    }

    $query = mysqli_query($koneksi, "SELECT id_peminjaman FROM peminjaman WHERE judul_buku = '$judul_buku' AND tanggal_pengembalian = '' LIMIT 1");
    if ($row = mysqli_fetch_assoc($query)) {
        $id_peminjaman = $row['id_peminjaman'];

        $update_query = "UPDATE peminjaman 
                         SET tanggal_pengembalian = '$tanggal_pengembalian', 
                             kondisi_buku_saat_dikembalikan = '$kondisi_buku_saat_dikembalikan', 
                             denda = '$denda'
                         WHERE id_peminjaman = $id_peminjaman";

        if (mysqli_query($koneksi, $update_query)) {
            // Send notif to admin
            InsertPemberitahuanPengembalian();
            $_SESSION['berhasil'] = "Pengembalian buku berhasil!";
        } else {
            $_SESSION['gagal'] = "Pengembalian buku gagal!";
        }
    } else {
        $_SESSION['gagal'] = "Pengembalian buku gagal, tidak ditemukan peminjaman yang sesuai!";
    }
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

function UpdateDataPeminjaman() {
    include "../../../../config/koneksi.php";

    $nama_lama = $_SESSION['fullname'];
    $nama_anggota = $_POST['Fullname'];

    $query1 = mysqli_query($koneksi, "SELECT * FROM user WHERE fullname = '$nama_lama'");
    if ($row = mysqli_fetch_assoc($query1)) {
        $nama_lama = $row['fullname'];

        $query = "UPDATE peminjaman SET nama_anggota = '$nama_anggota' WHERE nama_anggota = '$nama_lama'";
        mysqli_query($koneksi, $query);
    }
}
