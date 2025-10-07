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
                    <div class="row">
                        <div class="col">
                            <label>Filter Data</label>
                        </div>
                        <div class="col">
                            <input type="date" name="tglawal" id="tglawal" class="form-control">
                        </div>
                        <div class="col">
                            <input type="date" name="tglakhir" id="tglakhir" class="form-control">
                        </div>
                        <div class="col">
                            <button type="button" name="tomboltampil" id="tomboltampil" class="btn btn-block btn-primary">Tampilkan</button>
                        </div>
                    </div><br>
                    <table class="table table-bordered table-striped table-sm" id="dataatkkeluar">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Surat Jalan</th>
                                <th>Tanggal</th>
                                <th>Nama Karyawan</th>
                                <th>Bagian</th>
                                <th>Total Harga (Rp)</th>
                                <th>Action</th>
                            </tr>
                        </thead> 
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </section>
<script>
function listdataatkkeluar(){
    var table = $('#dataatkkeluar').DataTable({
        destroy : true,
        "processing" : true,
        "serverSide" : true,
        "order" : [],
        "ajax" : {
            "url" : "/atkkeluar/listdata",
            "type" : "POST",
            "data" : {
                tglawal : $('#tglawal').val(),
                tglakhir : $('#tglakhir').val(),
            }
        },
        "columnDefs" : [{
            "targets" : [0,6],
            "orderable" : false,
        },],
    });
}

function cetak(no_sj){
    // window.location.href=('/atkkeluar/cetaksj/') + no_sj;
    let windowcetak = window.open('/atkkeluar/cetaksj/' + no_sj, "Cetak Surat Jalan", "width=1000, height=500");
    windowcetak.focus();
    // window.location.reload();
}

function hapus(no_sj){
    swal({
        title: "Hapus Transaksi",
        text: "Yakin menghapus transaksi ini ?",
        icon: "warning",
        buttons: {
            cancel: {
                text: "Cancel",
                value: null,
                visible: true,
                className: "btn btn-outline-secondary waves-effect",
                closeModal: true,
            },
            confirm: {
                text: "Ya, hapus!",
                value: true,
                visible: true,
                className: "btn btn-primary me-3 waves-effect waves-light",
                closeModal: true,
            }
        },
        dangerMode: true,
        className: "my-custom-swal"
    }).then(function(isConfirmed){
        if(isConfirmed){
            $.ajax({
                type: "post",
                url: "/atkkeluar/hapustransaksi",
                data: {
                    no_sj : no_sj
                },
                dataType: "json",
                success: function (response) {
                    if(response.sukses){
                        listdataatkkeluar();

                        swal({
                            icon: "success",
                            title: "Berhasil!",
                            text: response.sukses,
                            button: {
                                text: "OK",
                                className: "btn btn-success waves-effect"
                            }
                        });
                    }
                },
                error: function(xhr,ajaxOptions,thrownError){
                    alert(xhr.status+'\n'+thrownError);
                }
            });
        }
    });  
}

function edit(no_sj){
    window.location.href = ('/atkkeluar/edit/') + no_sj;
}

$(document).ready(function () {
    listdataatkkeluar();

    $('#tomboltampil').click(function (e) { 
        e.preventDefault();
        listdataatkkeluar();
    });
});
</script>

<?= $this->endSection()?>