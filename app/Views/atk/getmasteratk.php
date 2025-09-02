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
                    <div class="section-header-button">
                        <a href="<?=site_url('masteratk/add')?>" class="btn btn-primary">Add New</a>
                    </div>
                </div>
                
                <div class="card-body table-responsive">
                    <table class="table table-striped table-md" id="myTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Satuan</th>
                                <th>Tanggal Tambah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($master_atk as $key => $value) : ?>
                            <tr>
                                <td><?=$key + 1?></td>
                                <td><?=$value->nama_barang?></td>
                                <td><?=$value->harga?></td>
                                <td><?=$value->satuan?></td>
                                <td><?=date('d/m/Y',strtotime($value->tgl_tambah))?></td>
                                <td class="text-center" style="width:12%">
                                    <a href="<?=site_url('masteratk/edit/'.$value->id_barang_atk)?>" class="btn btn-warning btn sm"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="<?=site_url('masteratk/'.$value->id_barang_atk)?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger btn sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection()?>