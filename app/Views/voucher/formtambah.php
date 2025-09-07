<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Create Data Master Voucer &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?=site_url('voucher')?>" class="btn"><i class="fas fa-arrow-left"></i></a>
                </div>
            <h1>Tambah Data Master Voucher</h1>
        </div>


        <div class="section-body">
            <?= form_open('voucher/simpandata') ?>
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Data / Master Voucher</h4>
                </div>

                <?= session()->getFlashdata('error'); ?>

                <div class="card-body col-md-6">
                    <?= csrf_field()?>
                    <div class="form-group">
                        <label>PLU Barang</label>
                        <input type="text" name="plu" class="form-control" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control">
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"> Tambah</i></button>
                        <button type="reset" class="btn btn-secondary"><i class="fas fa-redo"> Reset</i></button>
                    </div>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </section>
<?= $this->endSection()?>