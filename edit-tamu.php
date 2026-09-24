<?php
require_once('function.php');

// ambil id_tamu dari URL, contoh: edit-tamu.php?id_tamu=zt001
if (!isset($_GET['id_tamu'])) {
    die("ID Tamu tidak ditemukan!");
}
$id_tamu = $_GET['id_tamu'];

// ambil data tamu berdasarkan id
$tamu = query("SELECT * FROM buku_tamu WHERE id_tamu = '$id_tamu'")[0];

// jika ada tombol update yang diklik
if (isset($_POST['update'])) {
    if (ubah_tamu($_POST) > 0) {
        $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil diubah!</div>';
    } else {
        $alert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data gagal diubah!</div>';
    }
}

include_once('templates/header.php');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Tamu</h1>

    <?php if (isset($alert)) echo $alert; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6>Data Tamu</h6>
        </div>
        <div class="card-body">
            <p>ID Tamu: <strong><?= $tamu['id_tamu'] ?></strong></p>
            <p>Klik tombol di bawah untuk mengubah data.</p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">Edit Data</button>
            <button class="btn btn-secondary" onclick="window.location.href='buku_tamu.php'">Kembali</button>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Tamu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_tamu" value="<?= $tamu['id_tamu'] ?>">

                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= $tamu['tanggal'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Tamu</label>
                        <input type="text" name="nama_tamu" class="form-control" value="<?= $tamu['nama_tamu'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" value="<?= $tamu['alamat'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>No. Telp/HP</label>
                        <input type="text" name="no_hp" class="form-control" value="<?= $tamu['no_hp'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Bertemu Dengan</label>
                        <input type="text" name="bertemu" class="form-control" value="<?= $tamu['bertemu'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Kepentingan</label>
                        <textarea name="kepentingan" class="form-control" required><?= $tamu['kepentingan'] ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include_once('templates/footer.php');
?>