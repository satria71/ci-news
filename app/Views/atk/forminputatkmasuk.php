<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Create ATK Masuk &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?=site_url('AtkMasuk')?>" class="btn"><i class="fas fa-arrow-left"></i></a>
                </div>
            <h1>Input Data ATK Masuk</h1>
        </div>


        <div class="section-body">
            <!-- <div class="card">
                <div class="card-header"> -->
                    <!-- <h4>Tambah Data / ATK Masuk</h4> -->
                <!-- </div>
                <div class="card-body"> -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>No SJ</label>
                            <input type="text" class="form-control" name="sj" placeholder="No SJ" id="sj" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal</label>
                            <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl" placeholder="Tanggal" id="tgl" required>
                        </div>
                    </div>  
                <!-- </div> -->
                <div class="card">
                    <div class="card-header bg-primary">
                    <h4 style="color:white;">Input Data</h4>
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

                        <div class="form-group col-md-4">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" id="nama_barang" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Harga</label>
                            <input type="number" class="form-control" name="harga" placeholder="Harga" id="harga" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah">
                        </div>
                        <div class="form-group col-md-1">
                            <label>Aksi</label> 
                            <div class="input-group">
                                <button type="button" class="btn btn-sm btn-icon btn-info waves-effect" title="Tambah Item" id="tomboltambahitem">
                                    <i class="fas fa-plus-square"> </i>
                                </button>&ensp;
                                <button type="button" class="btn btn-sm btn-icon btn-warning waves-effect" title="Reload Data" id="tombolreload">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>  
                    <div class="row" id="tampildatatemp"></div>
                </div>
            </div>
        </div>
    </section>

<script>
    function datatemp(){
        let sj = $('#sj').val();

        $.ajax({
            type: "post",
            url: "/atkmasuk/datatemp",
            data: {
                sj : sj
            },
            dataType: "json",
            success: function (response) {
                if(response.data){
                    $('#tampildatatemp').html(response.data);
                }
            },
            error: function(xhr,ajaxOptions,thrownError){
                alert(xhr.status+'\n'+thrownError);
            }
        });
    }

    $(document).ready(function () {
        datatemp();
    });
</script>

<?= $this->endSection()?>