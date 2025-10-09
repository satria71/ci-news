<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan ATK Masuk</title>
</head>
<body>
    <table style="width:100%; border-collapse: collapse; text-align: center;" border="1">
        <tr>
            <td>
                <h1>DC MALANG</h1>
            </td>
        </tr>
        <tr>
            <td>
                <h5>Periode : <?= $tglawal ." s/d ". $tglakhir ?></h5>
            </td>
        </tr>
        <table border="1" style="border-collapse:collapse; border:1px; solid #000; text-align:center; width:80%;">
            <thead>
                <tr>
                    <th>No.</td>
                    <th>Surat Jalan</td>
                    <th>Tanggal</th>
                    <th>Total Harga (Rp.)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                $totalseluruhharga = 0;
                foreach($datalaporan->getResultArray() as $row) : 
                    $totalseluruhharga += $row['total_harga'];
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['no_sj']; ?></td>
                    <td><?= $row['tgl']; ?></td>
                    <td><?= number_format($row['total_harga'],0,",","."); ?></td>
                </tr>

                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total seluruh harga</th>
                    <td><?= number_format($totalseluruhharga,0,",","."); ?></td>
                </tr>
            </tfoot>
        </table>
    </table>
</body>
</html>