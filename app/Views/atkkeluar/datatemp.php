<table class="table table-sm table-striped table-hover">
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
                <td>
                   <button type="button" class="btn btn-sm btn-outline-danger" onclick="hapusitem('<?= $row['id'] ?>')">
                        <i class="fas fa-trash-alt"></i>
                   </button> 
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<script>
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
                    url: "/atkmasuk/hapus",
                    data: {
                        id : id
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.sukses){
                            datatemp();

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
</script>