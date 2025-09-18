<table class="table table-sm table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $nomor = 1;
            foreach($tampildata as $row) :
        ?> 
            <tr>
                <td><?= $nomor++; ?></td>
                <td><?= $row['kode_barang']; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td><?= number_format($row['harga'], 0, ",",".") ?></td>
                <td><?= number_format($row['stok'], 0, ",",".") ?></td>
                <td>
                    <button type="button" class="btn btn-sm btn-info" onclick="pilih('<?= $row['kode_barang'] ?>')">
                        <i class="fas fa-hand-pointer"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
    </tbody>
</table>

<script>
    function pilih(kode){
        $('#kode_barang').val(kode);
        $('#modalcaribarang').on('hidden.bs.modal', function (event) {
            ambildatabarang();
        })

        $('#modalcaribarang').modal('hide');
    }
</script>