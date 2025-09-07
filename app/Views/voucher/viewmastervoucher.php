<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Master Voucher &mdash; ICS</title>
<?= $this->endSection()?>

<?= $this->section('content') ?>
    <section class="section">
        <div class="section-header">
            <h1>Master Voucher</h1>
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
                    <h4>Master Voucher</h4>
                    <div class="section-header-button">
                        <a href="<?=site_url('voucher/formtambah')?>" class="btn btn-primary">Add New</a>
                    </div>
                </div>
                
                <div class="card-body table-responsive">
                    <table class="table table-striped table-sm" id="myTable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php 
                            $nomor = 1;
                            foreach ($tampildata as $row) : 
                        ?>
                        <tbody>
                            <tr>
                                <td><?=$nomor++; ?></td>
                                <td><?=$row['desc']?></td>
                                <td class="text-center" style="width:12%">
                                    <a href="<?=site_url('voucher/formedit/'.$row['plu'])?>" class="btn btn-info btn sm" title="edit data"><i class="fas fa-edit"></i></a>
                                    <form action="<?=site_url('voucher/hapus/'.$row['plu'])?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger btn sm" title="hapus data">
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