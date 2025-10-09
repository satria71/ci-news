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
            <div class="col-lg-12 tampildatatemp">

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

function ambildatabarang(){
    let kode_barang = $('#kode_barang').val();
    if(kode_barang.length == 0){
        swal({
            icon: "error",
            title: "Error",
            text: 'Kode barang belum diisi',
            button: {
                text: "OK",
                className: "btn btn-primary waves-effect"
            }
        });
        kosong();
    }else{
        $.ajax({
            type: "post",
            url: "/atkkeluar/ambildatabarang",
            data: {
                kode_barang : kode_barang
            },
            dataType: "json",
            success: function (response) {
                if(response.sukses){
                    let data = response.sukses;
                    $('#nama_barang').val(data.nama_barang);
                    $('#harga_keluar').val(data.harga);
                    $('#jumlah').focus();
                }

                if(response.error){
                    swal({
                        icon: "error",
                        title: "Error",
                        text: response.error,
                        button: {
                            text: "OK",
                            className: "btn btn-primary waves-effect"
                        }
                    });
                    kosong();
                }
            },
            error: function(xhr,ajaxOptions,thrownError){
                alert(xhr.status+'\n'+thrownError);
            }
        });
    }
}

function tampildatatemp(){
    let no_sj = $('#no_sj').val();
    $.ajax({
        type: "post",
        url: "/atkkeluar/datatemp",
        data: {
            no_sj : no_sj
        },
        dataType: "json",
        beforeSend: function(){
            $('.tampildatatemp').html('<i class="fas fa-spin fa-spinner"></i>');
        },
        success: function (response) {
            if(response.data){
                $('.tampildatatemp').html(response.data);
            }
        },
        error: function(xhr,ajaxOptions,thrownError){
            alert(xhr.status+'\n'+thrownError);
        }
    });
}

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
            tampildatatemp();
        },
        error: function(xhr,ajaxOptions,thrownError){
            alert(xhr.status+'\n'+thrownError);
        }
    });
}

function simpanitem(){
    let sj = $('#no_sj').val();
    let kode_barang = $('#kode_barang').val();
    let nama_barang = $('#nama_barang').val();
    let harga_keluar = $('#harga_keluar').val();
    let jumlah = $('#jumlah').val();
    let nik = $('#nik').val();

    
    if(sj.length == 0 || kode_barang == 0 || harga_keluar == 0 || jumlah == 0 || nik.length == 0){
        swal({
            icon: "error",
            title: "Error",
            text: 'Maaf ada data yang masih kosong',
            button: {
                text: "OK",
                className: "btn btn-primary waves-effect"
            }
        });
    }else{
        $.ajax({
            type: "post",
            url: "/atkkeluar/simpantemp",
            data: {
                sj : sj,
                kode_barang : kode_barang,
                nama_barang : nama_barang,
                harga_keluar : harga_keluar,
                jumlah : jumlah
            },
            dataType: "json",
            success: function (response) {
                if(response.error){
                    swal({
                        icon: "error",
                        title: "Error",
                        text: response.error,
                        button: {
                            text: "OK",
                            className: "btn btn-primary waves-effect"
                        }
                    });
                    kosong();
                }
                if(response.sukses){
                    // alert(response.sukses);
                    tampildatatemp();
                    kosong();
                }
            },
            error: function(xhr,ajaxOptions,thrownError){
                alert(xhr.status+'\n'+thrownError);
            }
        });
    }
}

$(document).ready(function () {
    tampildatatemp();

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

    $('#kode_barang').keydown(function (e) { 
        if(e.keyCode==13){
            e.preventDefault();
            ambildatabarang();
        }
    });

    $('#tombolsimpanitem').click(function (e) { 
        e.preventDefault();
        // alert('ini tombol tambah item');
        simpanitem();
    });

    $('#tombolcaribarang').click(function (e) { 
        e.preventDefault();
        $.ajax({
            url: "/atkkeluar/modalcaribarang",
            dataType: "json",
            success: function (response) {
                if(response.data){
                    $('.viewmodal').html(response.data).show();
                    $('#modalcaribarang').modal('show');
                }
            },
            error: function(xhr,ajaxOptions,thrownError){
                alert(xhr.status+'\n'+thrownError);
            }
        });
    });

    $('#tombolselesaitransaksi').click(function (e) { 
        e.preventDefault();
        swal({
            title: "Selesai Transaksi Input ?",
            text: "Yakin transaksi ini akan disimpan ?",
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
                    text: "Ya, simpan",
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
                    url: "/atkkeluar/selesaitransaksi",
                    data: {
                        no_sj : $('#no_sj').val(),
                        tgl : $('#tgl').val(),
                        nik : $('#nik').val(),
                        total_harga : $('#total_harga').val(),
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.error){
                            swal({
                                icon: "error",
                                title: "Error",
                                text: response.error,
                                button: {
                                    text: "OK",
                                    className: "btn btn-primary waves-effect"
                                }
                            });
                        }

                        if(response.sukses){
                            swal({
                                title: "Cetak Surat Jalan ?",
                                text: response.sukses + " ,cetak surat jalan ?",
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
                                        text: "Ya, cetak",
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
                                    let windowcetak = window.open(response.cetaksj, "Cetak Surat Jalan", "width=1000, height=500");
                                    windowcetak.focus();
                                    window.location.reload();
                                }else{
                                    window.location.reload();
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
    });
});
</script>
<?= $this->endSection()?>