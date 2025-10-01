<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Master ATK &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <h1>Master ATK</h1>
        </div>

        <?php if(session()->getFlashdata('success')):?>
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">x</button>
                    <b>Success !</b>
                    <?=session()->getFlashdata('success')?>
                </div>
            </div>
        <?php endif;?>

        <?php if(session()->getFlashdata('error')):?>
            <div class="alert alert-danger alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">x</button>
                    <b>Error !</b>
                    <?=session()->getFlashdata('error')?>
                </div>
            </div>
        <?php endif;?>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Data ATK</h4>
                    <button type="button" class="btn btn-sm btn-primary" id="btnAdd">
                        <i class="fas fa-plus"> Tambah</i>
                    </button>

                    <!-- <div class="section-header-button" id="btnAdd">
                        <a href="" class="btn btn-primary">Add New</a>
                    </div> -->

                </div>
                
                <div class="card-body table-responsive table-bordered"> 
                    <table class="table table-striped table-sm" id="tbMain">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Pkm</th>
                                <th>Harga</th>
                                <th>Satuan</th>
                                <th>Tanggal Tambah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>
            </div>
        </div>
    </section>

        <div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modaltitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="formData">
                        <div class="modal-header">
                            <h5 id="modaltitle"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group mb-2">
                                <label>Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control" id="kode_barang">
                            </div>
                            <div class="form-group mb-2">
                                <label>Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" id="nama_barang">
                            </div>
                            <div class="form-group mb-2">
                                <label>Stok</label>
                                <input type="number" name="stok" class="form-control" id="stok">
                            </div>
                            <div class="form-group mb-2">
                                <label>Pkm</label>
                                <input type="number" name="pkm" class="form-control" id="pkm">
                            </div>
                            <div class="form-group mb-2">
                                <label>Harga</label>
                                <input type="number" name="harga" class="form-control" id="harga">
                            </div>
                            <div class="form-group mb-2">
                                <label>Satuan</label>
                                <input type="text" name="satuan" class="form-control" id="satuan">
                            </div>
                            <!-- <div class="form-group mb-2">
                                <label>Tanggal Tambah</label>
                                <input type="date" name="tgl_tambah" class="form-control" id="tgl_tambah">
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btnSave">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
<script>
let dtIn;

$(document).ready(function () {
    //view data table
    dtIn = $("#tbMain").DataTable({
        ajax: {
            url: 'masteratk/dt_masteratk',
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

    //delete
    $('#tbMain').on('click', '#delete', function () {
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
                    url: 'masteratk/delete',
                    type: 'POST',
                    data: {
                        id: detail.id
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
                            });
                            reload_dt();
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

    // Tambah Data
    $('#btnAdd').on('click', function () {
        $('#modaltitle').text('Tambah Data');
        $('#formData')[0].reset();   // kosongkan semua input
        $('#id').val(''); // pastikan ID kosong
        $('#modalForm').modal('show');
    });

    $('#tbMain').on('click', '#edit', function () {
        let detail = $(this).data('detail');

        $('#modaltitle').text('Edit Data');
        $('#id').val(detail.id);
        $('#kode_barang').val(detail.kode_barang);
        $('#nama_barang').val(detail.nama_barang);
        $('#stok').val(detail.stok);
        $('#pkm').val(detail.pkm);
        $('#harga').val(detail.harga);
        $('#satuan').val(detail.satuan);
        $('#tgl_tambah').val(detail.tgl_tambah);
        

        $('#modalForm').modal('show');
    });

    $('#formData').on('submit', function (e) {
        e.preventDefault();

        let formData = $(this).serialize();
        console.log("FormData:", formData);

        $.ajax({
            url: "masteratk/save",  // satu endpoint
            type: "POST",
            data: formData,
            dataType: "json",
            success: function (res) {
                if (res.status === 'success') {
                    $('#modalForm').modal('hide');
                    swal({
                        icon: "success",
                        title: "Berhasil",
                        text: res.message,
                        button: {
                            text: "OK",
                            className: "btn btn-success waves-effect"
                        }
                    });
                    $('#tbMain').DataTable().ajax.reload();
                } else {
                    swal({
                        icon: "error",
                        title: "Gagal",
                        text: res.message || 'Terjadi kesalahan saat menambahkan data.',
                        button: {
                            text: "OK",
                            className: "btn btn-danger waves-effect"
                        }
                    });
                }
            },
            error: function (xhr) {
                notyf.error("Terjadi kesalahan server");
            }
        });
    });

});

function reload_dt() {
    dtIn.ajax.reload(null, false);
}
</script>
<?= $this->endSection()?>