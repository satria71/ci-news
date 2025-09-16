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
                <td><?= $row['kode_barang'] ?></td>
                <td><?= $row['nama_barang'] ?></td>
                <td style="text-align: right;">
                    <?= $row['det_jumlah'], 0, ",", "." ?>
                </td>
                <td style="text-align: right;">
                    <?= $row['det_subtotal'], 0, ",", "." ?>
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