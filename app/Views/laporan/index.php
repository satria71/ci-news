<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Laporan ATK &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?=site_url('/')?>" class="btn"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Cetak Laporan ATK</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Pilih laporan yang akan dicetak</h4>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-block btn-lg" onclick="window.location=('/laporan/cetakatkmasuk')">
                            <i class="fas fa-file"></i> Cetak Laporan ATK Masuk
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </section>
<?= $this->endSection()?>