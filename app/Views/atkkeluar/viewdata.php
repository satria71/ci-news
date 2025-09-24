<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Transaksi &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?=site_url('/')?>" class="btn"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Transaksi ATK Keluar</h1>
        </div>


        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Data Transaksi ATK Keluar</h4>
                    <button type="button" class="btn btn-sm btn-primary" onclick="location.href=('/atkkeluar/input')">
                        <i class="fas fa-plus"> Tambah</i>
                    </button>
                </div>
                <div class="card-body table-responsive table-bordered table-hover"> 
                
                </div>
            </div>
        </div>        
    </section>
<?= $this->endSection()?>