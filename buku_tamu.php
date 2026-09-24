<?php
require_once('function.php');
include_once('templates/header.php');
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Buku Tamu</h1>
<?php
     if (isset($_POST['simpan'])) {
    if (tambah_tamu($_POST) > 0) {
        echo "<script>alert('Data berhasil ditambahkan!'); document.location.href='buku_tamu.php';</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan!'); document.location.href='buku_tamu.php';</script>";
    }
}
?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Data Tamu</span>
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Tamu</th>
                            <th>Alamat</th>
                            <th>No. Telp/HP</th>
                            <th>Bertemu Dengan</th>
                            <th>Kepentingan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //penomoran auto increment
                        $no = 1;
                        //query menampilkan data tamu
                        $buku_tamu = query("SELECT * FROM buku_tamu");
                        foreach ($buku_tamu as $tamu): ?>

                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $tamu['tanggal']; ?></td>
                                <td><?php echo $tamu['nama_tamu']; ?></td>
                                <td><?php echo $tamu['alamat']; ?></td>
                                <td><?php echo $tamu['no_hp']; ?></td>
                                <td><?php echo $tamu['bertemu']; ?></td>
                                <td><?php echo $tamu['kepentingan']; ?></td>
                                <td>
                                    <a class="btn btn-success" href="edit-tamu.php?id_tamu=<?=$tamu['id_tamu']?>">Ubah</a>
                                    <a class="btn btn-danger" href="hapus-tamu.php?id_tamu=<?=$tamu['id_tamu']?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
// mengambil data barang dari tabel dengan kode terbesar
$query = mysqli_query($koneksi, "SELECT max(id_tamu) as kodeTerbesar FROM buku_tamu");
$data = mysqli_fetch_array($query);
$kodeTamu = $data['kodeTerbesar'];

// mengambil angka dari kode barang terbesar, menggunakan fungsi substr dan diubah ke integer dengan (int)
$urutan = (int) substr($kodeTamu, 2, 3);

// nomor yang diambil akan ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membuat kode barang baru
// string sprintf("%03s", $urutan); berfungsi untuk membuat string menjadi 3 karakter

// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya zt
$huruf = "zt";
$kodeTamu = $huruf . sprintf("%03s", $urutan);
?>
<!-- Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Data Tamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Tamu</label>
                        <input type="text" name="nama_tamu" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No. Telp/HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Bertemu Dengan</label>
                        <input type="text" name="bertemu" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Kepentingan</label>
                        <textarea name="kepentingan" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<?php
include_once('templates/footer.php');
?>