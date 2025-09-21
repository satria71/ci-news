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
<?= $this->endSection()?>