
<div class="table-responsive table-bordered">
    <table style="widht:100%; text-align:center;"class="table table-sm table-striped ">
        <thead>
            <tr>
                <th colspan="5"></th>
                <th colspan="2" style="text-align:right;">
                    <?php 
                        $totalharga = 0;
                        foreach ($datatemp as $row) :
                        $totalharga += $row['det_subtotal'];
                        endforeach;
                    ?>
                    <h1>Rp. <?= number_format($totalharga,0,",",".") ?></h1>
                </th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub. Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $nomor = 1;
            foreach ($datatemp as $row) :
            ?>
                <tr>
                    <td><?= $nomor++; ?></td>
                    <td><?= $row['det_kode_barang'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td style="text-align: center;">
                        <?= number_format($row['harga'], 0, ",", ".") ?>
                    </td>
                    <td style="text-align: center;">
                        <?= number_format($row['det_jumlah'], 0, ",", ".") ?>
                    </td>
                    <td style="text-align: center;">
                        <?= number_format($row['det_subtotal'], 0, ",", ".") ?>
                    </td>
                    <input type="hidden" id="total_harga" value="<?= $totalharga; ?>">
                    <td>
                    <button type="button" class="btn btn-sm btn-outline-warning" onclick="edititem('<?= $row['id'] ?>')">
                            <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapusitem('<?= $row['id'] ?>')">
                            <i class="fas fa-trash-alt"></i>
                    </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>
function edititem(id){
    $('#iddetailsj').val(id);

    $.ajax({
        type: "post",
        url: "/atkkeluar/edititem",
        data: {
            iddetailsj : $('#iddetailsj').val()
        },
        dataType: "json",
        success: function (response) {
            if(response.sukses){
                let data = response.sukses;
                $('#kode_barang').val(data.kode_barang);
                $('#nama_barang').val(data.nama_barang);
                $('#harga_keluar').val(data.harga);
                $('#jumlah').val(data.jumlah);

                $('#tombolbatal').fadeIn();
                $('#tomboledititem').fadeIn();
                $('#kode_barang').prop('readonly', true);
                $('#tombolcaribarang').prop('disabled', true);
                $('#tomboltambahitem').fadeOut();
            }
        },
        error: function(xhr,ajaxOptions,thrownError){
            alert(xhr.status+'\n'+thrownError);
        }
    });
}

function batal(){
    $('#tombolbatal').click(function (e) { 
        e.preventDefault();
        kosong();
        tampildatadetail();
        $('#kode_barang').prop('readonly', false);
        $('#tombolcaribarang').prop('disabled', false);
        $('#tomboltambahitem').fadeIn();
        $('#tombolbatal').fadeOut();
        $('#tomboledititem').fadeOut();
    });
}

function hapusitem(id){
    swal({
        title: "Hapus Item",
        text: "Yakin menghapus item ini ?",
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
                url: "/atkkeluar/hapusitemdetail",
                data: {
                    id : id
                },
                dataType: "json",
                success: function (response) {
                    if(response.sukses){
                        tampildatadetail();
                        tampiltotalharga();

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

$(document).ready(function () {
    batal();
});
</script>