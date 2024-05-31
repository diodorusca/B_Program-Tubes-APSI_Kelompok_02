<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="font-family: 'Quicksand', sans-serif; font-weight: bold;">
            Pengajuan Buku
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
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Pengajuan Buku</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title" style="font-family: 'Quicksand', sans-serif; font-weight: bold;">Data Buku
                        </h3>
                    </div>
                    <div class="box-body table-responsive">
                        <form action="pages/function/Pengajuan.php?aksi=kirim" enctype="multipart/form-data" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="pengirim" value="<?= $_SESSION['fullname']; ?>">
                                <div class="form-group">
                                    <label>Nama Penerima <small style="color: red;">* Wajib diisi</small></label>
                                    <select class="form-control" name="namaPenerima">
                                        <option selected disabled>-- Pilih Penerima --</option>
                                        <?php
                                        include "../../config/koneksi.php";

                                        $nama_saya = $_SESSION['fullname'];
                                        $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE fullname != '$nama_saya' AND role = 'Admin'");
                                        while ($data = mysqli_fetch_array($sql)) {
                                            ?>
                                            <option value="<?= $data['fullname']; ?>">[ <?= $data['kode_user']; ?> ]
                                                <?= $data['fullname']; ?> ( <?= $data['role']; ?> )</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Judul Pesan <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="text" name="judulPesan" class="form-control"
                                        placeholder="Masukan Judul Pesan" required>
                                </div>
                                <!-- Tambahkan input tertentu di sini -->
                                <div class="form-group">
                                    <label>Judul Buku <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="text" name="judulBuku" class="form-control" placeholder="Masukan Judul Buku" required>
                                </div>
                                <div class="form-group">
                                    <label>Kategori Buku <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="text" name="kategoriBuku" class="form-control" placeholder="Masukan Kategori Buku ( contoh : ensiklopedia )" required>
                                </div>
                                <div class="form-group">
                                    <label>Penerbit Buku <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="text" name="penerbitBuku" class="form-control" placeholder="Masukan Penerbit Buku" required>
                                </div>
                                <div class="form-group">
                                    <label>Pengarang <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="text" name="pengarang" class="form-control" placeholder="Masukan Pengarang" required>
                                </div>
                                <div class="form-group">
                                    <label>Tahun Terbit <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" min="2000" max="2100" name="tahunTerbit" class="form-control" placeholder="Masukan Tahun Terbit ( contoh : 2003 )" required>
                                </div>
                                <div class="form-group">
                                    <label>ISBN <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" name="isbn" class="form-control" placeholder="Masukan ISBN" required>
                                </div>
                                <div class="form-group">
                                    <label>Tipe Buku <small style="color: red;">* Wajib diisi</small></label>
                                    <select class="form-control" name="tipeBuku" required>
                                        <option selected disabled>-- Pilih Tipe Buku --</option>
                                        <option value="E-book">E-book</option>
                                        <option value="Hardcopy">Hardcopy</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Buku Baik <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" name="jumlahBukuBaik" class="form-control" placeholder="Masukan Jumlah Buku Baik" required>
                                </div>
                                <div class="form-group">
                                    <label>Jumlah Buku Rusak <small style="color: red;">* Wajib diisi</small></label>
                                    <input type="number" name="jumlahBukuRusak" class="form-control" placeholder="Masukan Jumlah Buku Rusak" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-block">Kirim</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script>
    function kirimPesan() {
        $('#modalKirimPesan').modal('show');
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
                text: 'Apakah anda yakin ingin menghapus data administrator ini ?',
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
                        text: 'Data administrator tersebut tetap aman !'
                    })
                }
            });
    })
</script>