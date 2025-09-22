<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Edit Transaksi ATK &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?=site_url('atkmasuk/data')?>" class="btn"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Edit Transaksi ATK</h1>
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
                            <td rowspan="3" style="vertical-align:middle; tex-align:center; font-weight:bold; font-size:25pt;" id="totalharga">
                                Total harga
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 20%;">Tanggal Surat Jalan</td>
                            <td style="width: 2%;">:</td>
                            <td style="width: 28%;"><?= date('d-m-Y', strtotime($tgl)) ?></td>
                        </tr>                
                    </table>
                    <div class="card">
                        <div class="card-header bg-primary">
                        <h4 style="color:white;">Edit Data</h4>
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
                                <label>Harga</label>
                                <input type="number" class="form-control" name="harga" placeholder="Harga" id="harga" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Harga Beli</label>
                                <input type="number" class="form-control" name="harga_beli" placeholder="Harga Beli" id="harga_beli">
                            </div>
                            <div class="form-group col-md-1">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah">
                            </div>
                            <div class="form-group col-md-1">
                                <label>Aksi</label> 
                                <div class="input-group">
                                    <button type="button" class="btn btn-sm btn-icon btn-info waves-effect" title="Tambah Item" id="tomboltambahitem">
                                        <i class="fas fa-plus-square"> </i>
                                    </button>

                                    <button style="display: none;" type="button" class="btn btn-sm btn-icon btn-primary waves-effect" title="Edit Data" id="tomboledititem">
                                        <i class="fas fa-edit"></i>
                                    </button> &nbsp;

                                    <button style="display: none;" type="button" class="btn btn-sm btn-icon btn-secondary waves-effect" title="Reload Data" id="tombolreload">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>  
                        <input type="hidden" name="iddetailsj" id="iddetailsj">

                        <div class="row" id="tampildatadetail"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modalcaribarang" style="display: none;"></div>

<script>
function datadetail(){
    let sj = $('#sj').val();
    // console.log(sj);

    $.ajax({
        type: "post",
        url: "/atkmasuk/datadetailtransaksi",
        data: {
            sj : sj
        },
        dataType: "json",
        success: function (response) {
            if(response.data){
                $('#tampildatadetail').html(response.data);
                $('#totalharga').html(response.totalharga);
            }
        },
        error: function(xhr,ajaxOptions,thrownError){
            alert(xhr.status+'\n'+thrownError);
        }
    });
}

function kosong(){
    // $('#sj').val('');
    $('#kode_barang').val('');
    $('#nama_barang').val('');
    $('#harga').val('');
    $('#harga_beli').val('');
    $('#jumlah').val('');
    $('#kode_barang').focus();
}

function ambildatabarang(){
    let kode_barang = $('#kode_barang').val();

    $.ajax({
        type: "post",
        url: "/atkmasuk/ambildatabarang",
        data: {
            kode_barang : kode_barang       
        },
        dataType: "json",
        success: function (response) {
            if(response.sukses){
                let data = response.sukses;
                $('#nama_barang').val(data.nama_barang);
                $('#harga').val(data.harga);
                $('#harga_beli').focus();
            }

            if(response.error){
                alert (response.error);
                kosong();
            }
        },
        error: function(xhr,ajaxOptions,thrownError){
            alert(xhr.status+'\n'+thrownError);
        }
    });
}

$(document).ready(function () {
    datadetail();

    $('#tombolreload').click(function (e) { 
        e.preventDefault();
        $('#iddetailsj').val('');
        $(this).hide();
        $('#tomboledititem').hide();
        $('#tomboltambahitem').fadeIn();
        
        kosong();
    });

    $('#tomboltambahitem').click(function (e) { 
        e.preventDefault();
        // alert('ini tombol tambah item');
        let sj = $('#sj').val();
        let kode_barang = $('#kode_barang').val();
        let harga = $('#harga').val();
        let harga_beli = $('#harga_beli').val();
        let jumlah = $('#jumlah').val();
        
        if(sj.length == 0 || kode_barang == 0 || harga_beli == 0 || jumlah == 0){
            swal({
                icon: "error",
                title: "Error",
                text: 'Maaf sj/kode barang/harga beli/jumlah tidak boleh kosong',
                button: {
                    text: "OK",
                    className: "btn btn-primary waves-effect"
                }
            });
        }else{
            $.ajax({
                type: "post",
                url: "/atkmasuk/simpandetailsj",
                data: {
                    sj : sj,
                    kode_barang : kode_barang,
                    harga : harga,
                    harga_beli : harga_beli,
                    jumlah : jumlah
                },
                dataType: "json",
                success: function (response) {
                    if(response.sukses){
                        alert(response.sukses);
                        datadetail();
                        kosong();
                    }
                },
                error: function(xhr,ajaxOptions,thrownError){
                    alert(xhr.status+'\n'+thrownError);
                }
            });
        }
    });

    $('#tomboledititem').click(function (e) { 
        e.preventDefault();
        let sj = $('#sj').val();
        let kode_barang = $('#kode_barang').val();
        let harga = $('#harga').val();
        let harga_beli = $('#harga_beli').val();
        let jumlah = $('#jumlah').val();

        $.ajax({
            type: "post",
            url: "/atkmasuk/updateitemsj",
            data: {
                iddetailsj : $('#iddetailsj').val(),
                sj : sj,
                kode_barang : kode_barang,
                harga : harga,
                harga_beli : harga_beli,
                jumlah : jumlah
            },
            dataType: "json",
            success: function (response) {
                if(response.sukses){
                    alert(response.sukses);
                    datadetail();
                    kosong();
                }
            },
            error: function(xhr,ajaxOptions,thrownError){
                alert(xhr.status+'\n'+thrownError);
            }
        });
    });

    $('#tombolcaribarang').click(function (e) { 
        e.preventDefault();
        $.ajax({
            url: "/atkmasuk/caridatabarang",
            dataType: "json",
            success: function (response) {
                if(response.data){
                    $('.modalcaribarang').html(response.data).show();
                    $('#modalcaribarang').modal('show');
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