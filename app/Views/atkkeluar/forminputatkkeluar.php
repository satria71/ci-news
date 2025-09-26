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
            <div class="form-group col-md-3">
                <label>No SJ</label>
                <input type="text" class="form-control" name="sj" value="<?= $no_sj ?>" placeholder="No SJ" id="no_sj" readonly>
            </div>
            <div class="form-group col-md-2">
                <label>Tanggal</label>
                <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="tgl" placeholder="Tanggal" id="tgl" required>
            </div>
            <div class="form-group col-md-2">
                <label>NIK</label>
                <input type="text" class="form-control" name="NIK" placeholder="NIK" id="nik" readonly>
            </div>
            <div class="form-group col-md-3">
                <label>Cari Karyawan</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Nama Karyawan" name="nama_karyawan" id="nama_karyawan" readonly>
                    <input type="hidden" name="id" id="id">
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
            <div class="form-group col-md-2">
                <label>Bagian</label>
                <input type="text" class="form-control" name="bagian" placeholder="Bagian" id="bagian" readonly>
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
<div class="viewmodal" sytel="display: none;"></div>

<script>
function buatnosjdariinputan(){
    let tanggal = $('#tgl').val();

    $.ajax({
        type: "post",
        url: "/atkkeluar/buatnosjinputan",
        data: {
            tanggal : tanggal
        },
        dataType: "json",
        success: function (response) {
            $('#no_sj').val(response.nosj);
        },
        error: function(xhr,ajaxOptions,thrownError){
            alert(xhr.status+'\n'+thrownError);
        }
    });
}

$(document).ready(function () {
    $('#tgl').change(function (e) { 
        buatnosjdariinputan();
        
    });

    $('#tomboltambahkaryawan').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/karyawan/formtambah",
            dataType: "json",
            success: function (response) {
                if(response.data){
                    $('.viewmodal').html(response.data).show();
                    $('#modaltambahkaryawan').modal('show');
                }
            },
            error: function(xhr,ajaxOptions,thrownError){
                alert(xhr.status+'\n'+thrownError);
            }
        });
        
    });

    $('#tombolcarikaryawan').click(function (e) { 
        e.preventDefault();
        $.ajax({
            type: "post",
            url: "/karyawan/modaldatakaryawan",
            dataType: "json",
            success: function (response) {
                if(response.data){
                    $('.viewmodal').html(response.data).show();
                    $('#modaldatakaryawan').modal('show');
                }
            },
            error: function(xhr,ajaxOptions,thrownError){
                alert(xhr.status+'\n'+thrownError);
            }
        });
    });
});
</script>
<?= $this->endSection()?>