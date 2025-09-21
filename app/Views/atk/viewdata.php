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
            <h1>Transaksi ATK Masuk</h1>
        </div>


        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Data Transaksi ATK Masuk</h4>
                    <button type="button" class="btn btn-sm btn-primary" onclick="location.href=('/atkmasuk/index')">
                        <i class="fas fa-plus"> Tambah</i>
                    </button>
                </div>
                <div class="card-body table-responsive table-bordered table-hover"> 
                    <table class="table table-striped table-sm" id="tbtransaksiatk">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Surat Jalan</th>
                                <th>Tanggal Datang</th>
                                <th>Jumlah Item</th>
                                <th>Total Harga (Rp)</th>
                                <th style="text-align: center;">Aksi</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
                <!-- <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari Berdasarkan Faktur" name="cari" autofocus="true">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit" name="tombolcari">
                                <i class="fas fa-search"></i>    
                            </button>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>        
    </section>

    <div class="viewmodal" style="display: none;"></div>

<script>
function detailitem(no_sj){
    $.ajax({
        type: "post",
        url: "/atkmasuk/detailitem",
        data: {
            no_sj : no_sj
        },
        dataType: "json",
        success: function (response) {
            if(response.data){
                $('.viewmodal').html(response.data).show();
                $('#modalitem').modal('show');
            }
        },
        error: function(xhr,ajaxOptions,thrownError){
            alert(xhr.status+'\n'+thrownError);
        }
    });
}

function edittransaksi(no_sj){
    window.location.href = ('/atkmasuk/edittransaksi/') + no_sj;
}

$(document).ready(function () {
    let dtIn = $("#tbtransaksiatk").DataTable({
        ajax: {
            url: '/atkmasuk/dt_transaksiatk',
            method: 'POST',
            headers: {
                [$('meta[name="csrf-header"]').attr('content')]:
                    $('meta[name="csrf-token"]').attr('content')
            },
            dataSrc: function (json) {
                return json.data;
            },
            error: function () {
                alert('Terjadi kesalahan pada server');
            }
        }
    });


});
</script>


<?= $this->endSection()?>