<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Create Master ATK &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?=site_url('masteratk')?>" class="btn"><i class="fas fa-arrow-left"></i></a>
                </div>
            <h1>Tambah Data Master ATK</h1>
        </div>


        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Data / Master ATK</h4>
                </div>

                <div class="card-body col-md-6">
                    <form action="<?=site_url('masteratk')?>" method="POST" autocomplete="off">
                        <?= csrf_field()?>
                        <div class="form-group">
                            <label>ID Barang</label>
                            <input type="text" name="id_barang_atk" class="form-control" required autofocus>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" name="harga" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="satuan" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Tambah</label>
                            <input type="date" name="tgl_tambah" class="form-control" required>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"> Tambah</i></button>
                            <button type="reset" class="btn btn-secondary"><i class="fas fa-redo"> Reset</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection()?>