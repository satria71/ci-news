<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Create ATK Masuk &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="<?=site_url('atkmasuk/data')?>" class="btn"><i class="fas fa-arrow-left"></i></a>
                </div>
            <h1>ATK Masuk</h1>
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
                            <input type="text" class="form-control" name="sj" placeholder="No SJ" id="sj">
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
                                </button>&ensp;
                                <button type="button" class="btn btn-sm btn-icon btn-warning waves-effect" title="Reload Data" id="tombolreload">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>  
                    <div class="row justify-content-end">
                        <button type="button" class="btn btn-sm btn-success" id="tombolselesaitransaksi">
                            <i class="fas fa-save"> Selesai Input</i>
                        </button>
                    </div>
                    <div class="row" id="tampildatatemp"></div>
                </div>
            </div>
        </div>
    </section>
<div class="modalcaribarang" style="display: none;"></div>

<script>
    function datatemp(){
        let sj = $('#sj').val();
        // console.log(sj);

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
        datatemp();

        $('#kode_barang').keydown(function (e) { 
            if(e.keyCode == 13){
                e.preventDefault();
                ambildatabarang();
            }
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
                    url: "/atkmasuk/simpantemp",
                    data: {
                        sj : sj,
                        kode_barang : kode_barang,
                        harga : harga,
                        harga_beli : harga_beli,
                        jumlah : jumlah
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.duplikat){
                            // Jika data sudah ada → tampilkan konfirmasi
                            swal({
                                title: "Data Sudah Ada",
                                text: response.pesan,
                                icon: "warning",
                                buttons: {
                                    cancel: {
                                        text: "Batal",
                                        visible: true,
                                        className: "btn btn-danger"
                                    },
                                    confirm: {
                                        text: "Update Data",
                                        visible: true,
                                        className: "btn btn-primary"
                                    }
                                }
                            }).then((willUpdate) => {
                                if (willUpdate) {
                                    // Kirim request update
                                    $.ajax({
                                        type: "post",
                                        url: "/atkmasuk/updateTemp",
                                        data: {
                                            sj: sj,
                                            kode_barang: kode_barang,
                                            harga: harga,
                                            harga_beli: harga_beli,
                                            jumlah: jumlah
                                        },
                                        dataType: "json",
                                        success: function (res) {
                                            swal({
                                                icon: "success",
                                                title: "Berhasil",
                                                text: res.sukses,
                                                button: {
                                                    text: "OK",
                                                    className: "btn btn-primary"
                                                }
                                            });
                                            datatemp();
                                            kosong();
                                        }
                                    });
                                }
                            });
                        }

                        if(response.sukses){
                            // Jika data baru berhasil ditambahkan
                            swal({
                                icon: "success",
                                title: "Berhasil",
                                text: response.sukses,
                                button: {
                                    text: "OK",
                                    className: "btn btn-primary"
                                }
                            });
                            datatemp();
                            kosong();
                        }
                    },
                    error: function(xhr,ajaxOptions,thrownError){
                        alert(xhr.status+'\n'+thrownError);
                    }
                });
            }
        });

        $('#tombolreload').click(function (e) { 
            e.preventDefault();
            datatemp();
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

    $('#tombolselesaitransaksi').click(function (e) { 
        e.preventDefault();
        let sj = $('#sj').val();
        
        if(sj.length == 0){
            swal({
                icon: "warning",
                title: "Pesan",
                text: 'Maaf No SJ Tidak Boleh Kosong',
                button: {
                    text: "OK",
                    className: "btn btn-primary waves-effect"
                }
            });
        }else{
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
                        url: "/atkmasuk/selesaitransaksi",
                        data: {
                            sj : sj,
                            tgl : $('#tgl').val()
                        },
                        dataType: "json",
                        success: function (response) {
                            if(response.error){
                                swal({
                                    icon: "error",
                                    title: "Error !",
                                    text: response.error,
                                    button: {
                                        text: "OK",
                                        className: "btn btn-success waves-effect"
                                    }
                                });
                            }

                            if(response.sukses){
                                swal({
                                    icon: "success",
                                    title: "Sukses !",
                                    text: response.sukses,
                                    button: {
                                        text: "OK",
                                        className: "btn btn-success waves-effect"
                                    }
                                }).then(function(isConfirmed){
                                    if(isConfirmed){
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
        }
    });
</script>

<?= $this->endSection()?>