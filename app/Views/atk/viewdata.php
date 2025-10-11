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

// let dtIn;

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

    $('#tbtransaksiatk').on('click', '#delete', function () {
        const detail = $(this).data('detail');
        // console.log(detail.id);

        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
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
                    text: "Yes, delete it!",
                    value: true,
                    visible: true,
                    className: "btn btn-primary me-3 waves-effect waves-light",
                    closeModal: true,
                }
            },
            dangerMode: true,
            className: "my-custom-swal"
        }).then(function (willDelete) {
            if (willDelete) {
                $.ajax({
                    url: '/atkmasuk/hapustransaksi',
                    type: 'POST',
                    data: {
                        id: detail.no_sj
                    },
                    dataType: 'json',
                    success: function (res) {
                        if (res.status === 'success') {
                            swal({
                                icon: "success",
                                title: "Berhasil dihapus!",
                                text: res.message,
                                button: {
                                    text: "OK",
                                    className: "btn btn-success waves-effect"
                                }
                            }).then(function (willDelete) {
                                if(willDelete){
                                    window.location.reload();
                                }
                            });
                            
                        } else {
                            swal({
                                icon: "error",
                                title: "Gagal",
                                text: res.message || 'Terjadi kesalahan saat menghapus.',
                                button: {
                                    text: "OK",
                                    className: "btn btn-danger waves-effect"
                                }
                            });
                        }
                    },
                    error: function () {
                        swal({
                            icon: "error",
                            title: "Error",
                            text: "Terjadi kesalahan pada server.",
                            button: {
                                text: "OK",
                                className: "btn btn-danger waves-effect"
                            }
                        });
                    }
                });
            }
        });
    });
});

// function reload_dt() {
//     dtIn.ajax.reload(null, false);
// }
</script>


<?= $this->endSection()?>