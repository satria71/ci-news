<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Laporan ATK &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?=site_url('/laporan/data')?>" class="btn"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Cetak Laporan ATK</h1>
        </div>
        <div class="section-body">
            <div class="card">
                <!-- <div class="card-header">
                    <h4>Pilih laporan yang akan dicetak</h4>
                </div> -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card text-white bg-primary mb-3">
                                <div class="card-header">Pilih Periode</div>
                                <div class="card-body bg-white">
                                    <p class="card-text">
                                        <?= form_open('laporan/cetakatkmasukperiode',['target' => '_blank']) ?>
                                        <div class="form-group">
                                            <label for="">Tanggal Awal</label>
                                            <input type="date" name="tglawal" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal AKhir</label>
                                            <input type="date" name="tglakhir" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-success">
                                                <i class="fas fa-print"></i> Cetak Laporan
                                            </button>
                                        </div>  
                                        <?= form_close() ?>
                                    </p>
                                </div>
                            </div>
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