<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Edit ATK Keluar &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?=site_url('atkkeluar/viewdata')?>" class="btn"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Transaksi ATK Keluar</h1>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <input type="hidden" id="sj" value="<?= $no_sj ?>">
                            <td style="width: 20%;">No. Surat Jalan</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 28%;"><?= $no_sj ?></td>
                            <td rowspan="4" style="vertical-align:middle; text-align:center; font-weight:bold; font-size:25pt;" id="totalharga">
                                Total Rupiah
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Tanggal Surat Jalan</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 28%;"><?= date('d-m-Y', strtotime($tgl)) ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Nama Karyawan</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 28%;"><?= $nama_karyawan ?></td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Bagian</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 28%;"><?= $bagian ?></td>
                        </tr>                
                    </table>
                </div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header bg-primary">
                <h4 style="color:white;">Edit Data Item Keluar</h4>
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
                    <div class="form-group col-md-2">
                        <label>Harga Keluar</label>
                        <input type="number" class="form-control" name="harga_keluar" placeholder="Harga Keluar" id="harga_keluar" readonly>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="jumlah" id="jumlah">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Aksi</label> 
                        <div class="input-group">
                            <button type="button" class="btn btn-sm btn-icon btn-info waves-effect" title="Simpan Item" id="tombolsimpanitem">
                                <i class="fas fa-plus-square"> </i>
                            </button>&ensp;
                            <!-- <button type="button" class="btn btn-sm btn-icon btn-success waves-effect" title="selesai" id="tombolreload">
                                <i class="fas fa-sync-alt"></i>
                            </button> -->
                            <button type="button" class="btn btn-sm btn-success" id="tombolselesaitransaksi">
                                <i class="fas fa-save"> Selesai</i>
                            </button>
                        </div>
                    </div>
                </div>  
                <!-- <div class="row justify-content-end">
                    <button type="button" class="btn btn-sm btn-success" id="tombolselesaitransaksi">
                        <i class="fas fa-save"> Selesai Transaksi</i>
                    </button>
                </div> -->
            </div>
            <div class="col-lg-12 tampildatadetail">

            </div>
        </div>        
    </section>
<div class="viewmodal" sytel="display: none;"></div>

<script>
function kosong(){
    // $('#sj').val('');
    $('#kode_barang').val('');
    $('#nama_barang').val('');
    $('#harga_keluar').val('');
    $('#jumlah').val('');
    $('#kode_barang').focus();
}

function tampildatadetail(){
    let no_sj = $('#sj').val();
    $.ajax({
        type: "post",
        url: "/atkkeluar/datadetail",
        data: {
            no_sj : no_sj
        },
        dataType: "json",
        beforeSend: function(){
            $('.tampildatadetail').html('<i class="fas fa-spin fa-spinner"></i>');
        },
        success: function (response) {
            if(response.data){
                $('.tampildatadetail').html(response.data);
            }
        },
        error: function(xhr,ajaxOptions,thrownError){
            alert(xhr.status+'\n'+thrownError);
        }
    });
}

function tampiltotalharga(){
    let sj = $('#sj').val();
    // console.log(sj);

    $.ajax({
        type: "post",
        url: "/atkkeluar/totalharga",
        data: {
            no_sj : sj
        },
        dataType: "json",
        success: function (response) {
            $('#totalharga').html(response.totalharga);
            // if(response.data){
            //     // $('#tampildatadetail').html(response.data);
            //     $('#totalharga').html(response.totalharga);
            // }
        },
        error: function(xhr,ajaxOptions,thrownError){
            alert(xhr.status+'\n'+thrownError);
        }
    });
}

$(document).ready(function () {
    tampiltotalharga();
    tampildatadetail();
});
</script>

<?= $this->endSection()?>