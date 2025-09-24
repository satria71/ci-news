<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Transaksi &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?=site_url('atkkeluar/data')?>" class="btn"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>ATK Keluar</h1>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label>No SJ</label>
                <input type="text" class="form-control" name="sj" placeholder="No SJ" id="sj" readonly>
            </div>
            <div class="form-group col-md-4">
                <label>Tanggal</label>
                <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl" placeholder="Tanggal" id="tgl" required>
            </div>
            <div class="form-group col-md-4">
                <label>Cari Karyawan</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nama Karyawan" name="nama_karyawan" id="nama_karyawan" readonly>
                    <input type="hidden" name="nik" id="nik">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="tombolcarikaryawan" title="cari karyawan">
                            <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-outline-success" type="button" id="tomboltambahkaryawan" title="tambah karyawan">
                            <i class="fas fa-plus-square"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>  

        <div class="section-body">
            <div class="card">
                <div class="card-header bg-primary">
                <h4 style="color:white;">Input Data Item Keluar</h4>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Kode Barang</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Input Kode Barang" name="kode_barang" id="kode_barang">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="button" id="tombolcaribarang">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" id="nama_barang" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Harga Keluar</label>
                        <input type="number" class="form-control" name="harga_keluar" placeholder="Harga Keluar" id="harga_keluar" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah">
                    </div>
                    <div class="form-group col-md-1">
                        <label>Aksi</label> 
                        <div class="input-group">
                            <button type="button" class="btn btn-sm btn-icon btn-info waves-effect" title="Simpan Item" id="tombolsimpanitem">
                                <i class="fas fa-save"> </i>
                            </button>&ensp;
                            <button type="button" class="btn btn-sm btn-icon btn-warning waves-effect" title="Reload Data" id="tombolreload">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>  
            </div>
        </div>        
    </section>
<?= $this->endSection()?>