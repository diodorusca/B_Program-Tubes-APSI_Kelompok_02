<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Laporan Pengajuan Buku Baru
            <small>
                <script type='text/javascript'>
                    var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
                    var date = new Date();
                    var day = date.getDate();
                    var month = date.getMonth();
                    var thisDay = date.getDay(),
                        thisDay = myDays[thisDay];
                    var yy = date.getYear();
                    var year = (yy < 1000) ? yy + 1900 : yy;
                    document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
                    //
                </script>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Laporan Pengajuan Buku Baru</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">List
                            Pengajuan Buku</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped table-custom">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengirim</th>
                                    <th>Judul Pesan</th>
                                    <th>Judul Buku</th>
                                    <th>Kategori Buku</th>
                                    <th>Penerbit Buku</th>
                                    <th>Pengarang</th>
                                    <th>Tahun Terbit</th>
                                    <th>ISBN</th>
                                    <th>Tipe Buku</th>
                                    <th>Jumlah Buku Baik</th>
                                    <th>Jumlah Buku Rusak</th>
                                    <th>Status Pesan</th>
                                    <th>Tanggal Kirim</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <?php
                            include "../../config/koneksi.php";

                            $no = 1;
                            $penerima = $_SESSION['fullname'];
                            $query = mysqli_query($koneksi, "SELECT * FROM pengajuan WHERE penerima = '$penerima'");
                            while ($row = mysqli_fetch_assoc($query)) {
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $row['pengirim']; ?></td>
                                        <td><?= $row['judul_pesan']; ?></td>
                                        <td><?= $row['judul_buku']; ?></td>
                                        <td><?= $row['kategori_buku']; ?></td>
                                        <td><?= $row['penerbit_buku']; ?></td>
                                        <td><?= $row['pengarang']; ?></td>
                                        <td><?= $row['tahun_terbit']; ?></td>
                                        <td><?= $row['isbn']; ?></td>
                                        <td><?= $row['tipe_buku']; ?></td>
                                        <td><?= $row['jumlah_buku_baik']; ?></td>
                                        <td><?= $row['jumlah_buku_rusak']; ?></td>
                                        <td><?= $row['status']; ?></td>
                                        <td><?= $row['tanggal_kirim']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['status'] == "Sudah dibaca") {
                                                //
                                                echo "<a href='pages/function/Pengajuan.php?aksi=hapus&id_pengajuan=" . $row['id_pengajuan'] . "' class='btn btn-danger btn-sm btn-del' onclick='hapusAnggota()'><i class='fa fa-trash'></i></a>";
                                            } else {
                                                echo "<a href='pages/function/Pengajuan.php?aksi=update&id_pengajuan=" . $row['id_pengajuan'] . "' class='btn btn-info btn-sm'><i class='fa fa-check'></i></a>";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="modalTambahAnggota">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Tambah Anggota
                </h4>
            </div>
            <form action="pages/function/Anggota.php?aksi=tambah" enctype="multipart/form-data" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Anggota <small style="color: red;">* Otomatis Terisi</small></label>
                        <?php
                        include "../../config/koneksi.php";

                        $query = mysqli_query($koneksi, "SELECT max(kode_user) as kodeTerakhir FROM user");
                        $data = mysqli_fetch_array($query);
                        $kodeTerakhir = $data['kodeTerakhir'];

                        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
                        // dan diubah ke integer dengan (int)
                        $urutan = (int) substr($kodeTerakhir, 3, 3);

                        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
                        $urutan++;

                        // membentuk kode barang baru
                        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
                        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
                        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
                        $huruf = "AP";
                        $Anggota = $huruf . sprintf("%03s", $urutan);
                        ?>
                        <input type="text" class="form-control" value="<?php echo $Anggota ?>" name="kodeAnggota"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label>Nomor Induk Siswa <small style="color: red;">* Wajib diisi</small></label>
                        <input type="number" class="form-control" placeholder="Masukan NIM" name="nim" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Nama Lengkap" name="namaLengkap"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Nama Pengguna <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Nama Pengguna" name="username"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Kata Sandi <small style="color: red;">* Wajib diisi</small></label>
                        <input type="text" class="form-control" placeholder="Masukan Kata Sandi" name="password"
                            required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Angkatan <small style="color: red;">* Wajib diisi</small></label>
                        <select class="form-control" name="kelas">
                            <option disabled selected>-- Harap Pilih Tahun Angkatan --</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat <small style="color: red;">* Wajib diisi</small></label>
                        <textarea class="form-control" style="resize: none; height: 70px;" name="alamat"
                            required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    function tambahAnggota() {
        $('#modalTambahAnggota').modal('show');
    }
</script>
<!-- jQuery 3 -->
<script src="../../assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="../../assets/dist/js/sweetalert.min.js"></script>
<!-- Pesan Berhasil Edit -->
<script>
    <?php
    if (isset($_SESSION['berhasil']) && $_SESSION['berhasil'] <> '') {
        echo "swal({
            icon: 'success',
            title: 'Berhasil',
            text: '$_SESSION[berhasil]'
        })";
    }
    $_SESSION['berhasil'] = '';
    ?>
</script>
<!-- Pesan Gagal Edit -->
<script>
   <?php
   if (isset($_SESSION['gagal']) && $_SESSION['gagal'] <> '') {
       echo "swal({
                icon: 'error',
                title: 'Gagal',
                text: '$_SESSION[gagal]'
              })";
   }
   $_SESSION['gagal'] = '';
   ?>
</script>
<!-- Swal Hapus Data -->
<script>
    $('.btn-del').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')

        swal({
                icon: 'warning',
                title: 'Peringatan',
                text: 'Apakah anda yakin ingin menghapus data anggota ini ?',
                buttons: true,
                dangerMode: true,
                buttons: ['Tidak, Batalkan !', 'Iya, Hapus']
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.location.href = href;
                } else {
                    swal({
                        icon: 'error',
                        title: 'Dibatalkan',
                        text: 'Data anggota tersebut aman !'
                    })
                }
            });
    })
</script>